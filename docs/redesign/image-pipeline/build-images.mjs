#!/usr/bin/env node
// Image pipeline for hellowebdesign.co.uk — see docs/redesign/image-pipeline.md
//
// Usage:  node docs/redesign/image-pipeline/build-images.mjs assets [name ...]
//   With no names, every *.png in <assets-dir> except the exclusion list is processed.
//   Names are base names without extension, e.g. `couple proj-bbm`.
//
// Pipeline: Chromium (Playwright) decodes each PNG, resizes it on a canvas
// (imageSmoothingQuality = "high"), exports WebP (q 0.78) + JPEG (q 0.80), and
// hands the raw RGBA pixels back so @jsquash/avif (WASM libaom) can encode AVIF.
// Every output is then re-loaded in Chromium and its naturalWidth/naturalHeight
// checked before the manifest (assets/images.json) is written.

import { readFileSync, writeFileSync, readdirSync, existsSync } from 'node:fs';
import { join, resolve, dirname } from 'node:path';
import { fileURLToPath } from 'node:url';
import { createRequire } from 'node:module';

const HERE = dirname(fileURLToPath(import.meta.url));
const require = createRequire(import.meta.url);

// Playwright: a local install next to this script wins; otherwise fall back to
// $PLAYWRIGHT_PKG or the global install used in the Claude Code environment.
const PW_PKG = (() => {
  try { return require.resolve('playwright'); } catch {}
  return process.env.PLAYWRIGHT_PKG || '/opt/node22/lib/node_modules/playwright/index.mjs';
})();
const { chromium } = await import(PW_PKG);

// @jsquash/avif (WASM libaom) is expected in ./node_modules (see package.json).
const AVIF_PKG = (() => {
  try { return join(dirname(require.resolve('@jsquash/avif/package.json')), 'encode.js'); } catch {}
  return process.env.AVIF_PKG || '';
})();

const WIDTHS = [480, 800, 1200];
const WEBP_Q = 0.78;
const JPEG_Q = 0.80;
const JPEG_W = 1200;
const AVIF_OPTS = { quality: 60, speed: 6 }; // libaom cq-level ≈ 25, 4:2:0
const JPEG_BG = '#ffffff';                    // flattened under any alpha for JPEG
const EXCLUDE = new Set(['logo', 'logo-dark', 'favicon-96x96', 'apple-touch-icon']);

const assetsDir = resolve(process.argv[2] || 'assets');
let names = process.argv.slice(3);
if (!names.length) {
  names = readdirSync(assetsDir)
    .filter((f) => f.endsWith('.png') && !EXCLUDE.has(f.slice(0, -4)))
    .map((f) => f.slice(0, -4))
    .sort();
}

let avifEncode = null;
if (AVIF_PKG && existsSync(AVIF_PKG)) {
  // Node's fetch() cannot load file:// URLs, so hand the encoder a pre-compiled
  // WebAssembly.Module instead of letting the emscripten glue fetch the .wasm.
  const mod = await import(AVIF_PKG);
  const wasm = readFileSync(join(dirname(AVIF_PKG), 'codec/enc/avif_enc.wasm'));
  await mod.init(await WebAssembly.compile(wasm));
  avifEncode = mod.default;
} else {
  console.warn('AVIF encoder (@jsquash/avif) not installed - skipping AVIF');
}

const b64 = (buf) => buf.toString('base64');
const fromDataUrl = (u) => Buffer.from(u.slice(u.indexOf(',') + 1), 'base64');

const browser = await chromium.launch();
const page = await browser.newPage();

// Runs inside Chromium. Returns encoded WebP/JPEG data URLs plus raw RGBA for AVIF.
const render = async (pngDataUrl, widths, opts) =>
  page.evaluate(
    async ({ src, widths, opts }) => {
      const img = new Image();
      img.src = src;
      await img.decode();
      const sw = img.naturalWidth;
      const sh = img.naturalHeight;

      const toB64 = (u8) =>
        new Promise((res) => {
          const fr = new FileReader();
          fr.onload = () => res(fr.result.slice(fr.result.indexOf(',') + 1));
          fr.readAsDataURL(new Blob([u8]));
        });

      // alpha check on the full-size bitmap
      const probe = document.createElement('canvas');
      probe.width = sw;
      probe.height = sh;
      const pctx = probe.getContext('2d', { willReadFrequently: true });
      pctx.drawImage(img, 0, 0);
      const px = pctx.getImageData(0, 0, sw, sh).data;
      let hasAlpha = false;
      for (let i = 3; i < px.length; i += 4) {
        if (px[i] !== 255) { hasAlpha = true; break; }
      }

      // Never upscale. If the source is narrower than the largest target, add a
      // variant at its native width so the JPEG fallback keeps full resolution.
      const ws = widths.filter((w) => w <= sw);
      if (sw < opts.jpegW && !ws.includes(sw)) ws.push(sw);
      const jpegW = Math.max(...ws);
      const out = { sw, sh, hasAlpha, variants: [] };
      for (const w of ws) {
        const h = Math.round((sh * w) / sw);
        const c = document.createElement('canvas');
        c.width = w;
        c.height = h;
        const ctx = c.getContext('2d', { willReadFrequently: true });
        ctx.imageSmoothingEnabled = true;
        ctx.imageSmoothingQuality = 'high';
        ctx.drawImage(img, 0, 0, w, h);
        const v = { w, h };
        v.webp = c.toDataURL('image/webp', opts.webpQ);
        v.rgba = await toB64(ctx.getImageData(0, 0, w, h).data);
        if (w === jpegW) {
          if (hasAlpha) {
            const f = document.createElement('canvas');
            f.width = w;
            f.height = h;
            const fctx = f.getContext('2d');
            fctx.fillStyle = opts.jpegBg;
            fctx.fillRect(0, 0, w, h);
            fctx.imageSmoothingQuality = 'high';
            fctx.drawImage(c, 0, 0);
            v.jpg = f.toDataURL('image/jpeg', opts.jpegQ);
          } else {
            v.jpg = c.toDataURL('image/jpeg', opts.jpegQ);
          }
        }
        out.variants.push(v);
      }
      return out;
    },
    { src: pngDataUrl, widths, opts },
  );

// Re-load an encoded file in Chromium and report its decoded size.
const verify = async (mime, buf) =>
  page.evaluate(async (src) => {
    const img = new Image();
    img.src = src;
    try { await img.decode(); } catch (e) { return { ok: false, err: String(e) }; }
    return { ok: true, w: img.naturalWidth, h: img.naturalHeight };
  }, `data:${mime};base64,${b64(buf)}`);

const manifest = existsSync(join(assetsDir, 'images.json'))
  ? JSON.parse(readFileSync(join(assetsDir, 'images.json'), 'utf8'))
  : {};
const report = [];

for (const name of names) {
  const srcPath = join(assetsDir, `${name}.png`);
  const srcBuf = readFileSync(srcPath);
  const r = await render(`data:image/png;base64,${b64(srcBuf)}`, WIDTHS, {
    webpQ: WEBP_Q, jpegQ: JPEG_Q, jpegW: JPEG_W, jpegBg: JPEG_BG,
  });
  const entry = { w: r.sw, h: r.sh, webp: [], avif: [], jpg: null };
  const rows = [];
  let after = 0;

  const emit = async (file, mime, buf, expectW, expectH) => {
    const outPath = join(assetsDir, file);
    writeFileSync(outPath, buf);
    const v = await verify(mime, buf);
    if (!v.ok || v.w !== expectW || v.h !== expectH) {
      throw new Error(`verification failed for ${file}: ${JSON.stringify(v)} expected ${expectW}x${expectH}`);
    }
    after += buf.length;
    rows.push({ file, w: v.w, h: v.h, bytes: buf.length });
  };

  for (const v of r.variants) {
    await emit(`${name}-${v.w}.webp`, 'image/webp', fromDataUrl(v.webp), v.w, v.h);
    entry.webp.push(v.w);
    if (avifEncode) {
      const rgba = Buffer.from(v.rgba, 'base64');
      const ab = await avifEncode(
        { data: new Uint8ClampedArray(rgba.buffer, rgba.byteOffset, rgba.length), width: v.w, height: v.h },
        AVIF_OPTS,
      );
      await emit(`${name}-${v.w}.avif`, 'image/avif', Buffer.from(ab), v.w, v.h);
      entry.avif.push(v.w);
    }
    if (v.jpg) {
      await emit(`${name}-${v.w}.jpg`, 'image/jpeg', fromDataUrl(v.jpg), v.w, v.h);
      entry.jpg = v.w;
    }
  }
  if (r.sw < JPEG_W) {
    console.warn(`${name}: source is only ${r.sw}px wide - native-width variant emitted, JPEG fallback at ${entry.jpg}px`);
  }

  manifest[name] = entry;
  report.push({ name, src: `${r.sw}x${r.sh}`, srcBytes: srcBuf.length, hasAlpha: r.hasAlpha, after, rows });
  console.log(`${name}: ${r.sw}x${r.sh} ${srcBuf.length} B${r.hasAlpha ? ' (alpha)' : ''} -> ${rows.length} files, ${after} B`);
  for (const row of rows) console.log(`   ${row.file.padEnd(28)} ${String(row.w).padStart(5)}x${String(row.h).padEnd(5)} ${String(row.bytes).padStart(8)} B`);
}

await browser.close();

const sorted = Object.fromEntries(Object.keys(manifest).sort().map((k) => [k, manifest[k]]));
writeFileSync(join(assetsDir, 'images.json'), JSON.stringify(sorted, null, 2) + '\n');
console.log('wrote', join(assetsDir, 'images.json'));
