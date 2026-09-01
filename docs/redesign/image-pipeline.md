# Image pipeline — responsive WebP / AVIF / JPEG variants

Rollout 1 of the redesign performance work. `assets/` held 13.9 MB of PNG
photography; `couple.png` alone was 4.7 MB at 2399 px wide and is the homepage
LCP image in a ~520 px column. This pipeline produces resized, compressed
variants next to each original so the markup phase can switch to
`<picture>` + `srcset`. **The original PNGs stay in place** until every page
has been migrated.

## What gets produced

For each photo `assets/<name>.png` (everything except `logo`, `logo-dark`,
favicons and `og-image.jpg`):

| Output | Widths | Encoder / quality |
|---|---|---|
| `assets/<name>-<w>.webp` | 480, 800, 1200 | Chromium canvas `toDataURL('image/webp', 0.78)` |
| `assets/<name>-<w>.avif` | 480, 800, 1200 | `@jsquash/avif` (libaom WASM), `quality: 60, speed: 6`, 4:2:0 |
| `assets/<name>-<w>.jpg`  | 1200 only | Chromium canvas `toDataURL('image/jpeg', 0.80)` |

Rules:

- **Never upscale.** A target width larger than the source is skipped.
- **Sources narrower than 1200 px** additionally get a variant at their native
  width (e.g. `proj-farmers-1000.*`, `proj-flightsim-612.*`, `working-1140.*`)
  and the JPEG fallback is emitted at that width instead of 1200, so the
  `<img>` fallback never has to reach for the multi-megabyte PNG.
- Aspect ratio is preserved; height = `round(srcH * w / srcW)`.
- Any source with an alpha channel is flattened onto `#ffffff` for the JPEG
  (none of the current 12 have alpha).
- Every output is re-loaded in Chromium after writing and its
  `naturalWidth × naturalHeight` must match the requested size, otherwise the
  run aborts.

The manifest `assets/images.json` maps each base name to its real source size
and the widths that exist:

```json
"couple": { "w": 2399, "h": 1800, "webp": [480, 800, 1200], "avif": [480, 800, 1200], "jpg": 1200 }
```

`jpg` is the single width the JPEG fallback exists at (1200, or the native
width for narrower sources).

## Why Chromium and not ffmpeg / ImageMagick

The environment has no ImageMagick, PIL or sharp. The bundled ffmpeg
(`/opt/pw-browsers/ffmpeg-1011/ffmpeg-linux`, a Playwright build) is compiled
with `--disable-everything` and only enables `mjpeg`/`vp8` decoding and
`png`/`vp8` encoding — it **cannot even decode PNG**, let alone write WebP,
AVIF or JPEG. So the pipeline drives headless Chromium through Playwright:

1. Node reads the PNG and hands it to the page as a `data:` URL.
2. The page decodes it in an `<img>`, draws it onto a canvas at each target
   width with `imageSmoothingQuality = 'high'`, and exports WebP and JPEG via
   `canvas.toDataURL()`.
3. The page also returns the canvas' raw RGBA (`getImageData`) for each width;
   Node feeds that to `@jsquash/avif`, a pure-WASM libaom build, for AVIF.
   (Chromium can decode AVIF but `toDataURL('image/avif')` silently falls
   back to PNG, hence the separate encoder.)
4. Node re-loads every written file in the same page to verify it decodes at
   the expected size, then writes `assets/images.json`.

`@jsquash/avif`'s emscripten glue tries to `fetch()` its `.wasm` from a
`file://` URL, which Node refuses; the script works around this by reading the
`.wasm` from disk and passing a pre-compiled `WebAssembly.Module` to `init()`.

## Re-running (for new or replaced photos)

```sh
# one-off: install the AVIF encoder next to the script (node_modules is git-ignored)
cd docs/redesign/image-pipeline && npm install --no-audit --no-fund && cd -

# all photos
node docs/redesign/image-pipeline/build-images.mjs assets

# just some (base names, no extension)
node docs/redesign/image-pipeline/build-images.mjs assets couple proj-bbm
```

Requirements:

- Node 22+ (top-level `await`, `WebAssembly.compile`).
- Playwright with a Chromium build. The script resolves `playwright` from a
  local install first, then `$PLAYWRIGHT_PKG`, then the global
  `/opt/node22/lib/node_modules/playwright/index.mjs` used in the Claude Code
  environment (`PLAYWRIGHT_BROWSERS_PATH=/opt/pw-browsers`). Elsewhere run
  `npm i playwright && npx playwright install chromium` in the pipeline dir.
- If `@jsquash/avif` is not installed the script prints a warning, skips AVIF
  and records `"avif": []` in the manifest; WebP and JPEG are still produced.

To add a new photo: drop `assets/<name>.png` in, run the script with that
name, commit the PNG, the generated variants and the updated `images.json`.
Widths, qualities and the exclusion list are constants at the top of
`build-images.mjs`. The output is deterministic — re-running over unchanged
sources produces byte-identical files.

## Results of the first run (2026-09-01)

Tooling: Playwright 1.56.1 / Chromium 1194, `@jsquash/avif` 2.1.1, Node 22.22.2.

| Source | Dimensions | PNG bytes | Variants | Total variant bytes | Largest WebP / AVIF / JPEG |
|---|---|---:|---:|---:|---|
| couple.png | 2399x1800 | 4,692,465 | 7 | 468,197 | 1200px: 97,484 / 80,776 / 163,569 |
| desk.png | 1800x1013 | 1,287,279 | 7 | 194,683 | 1200px: 36,272 / 27,660 / 73,972 |
| proj-bbm.png | 1795x1049 | 1,402,028 | 7 | 450,016 | 1200px: 94,174 / 82,069 / 138,913 |
| proj-farmers.png | 1000x515 | 752,250 | 7 | 314,487 | 1000px: 60,108 / 54,023 / 93,434 |
| proj-fennec.png | 1000x633 | 716,901 | 7 | 267,461 | 1000px: 51,016 / 42,396 / 86,429 |
| proj-flightsim.png | 612x400 | 306,681 | 5 | 127,441 | 612px: 28,056 / 23,942 / 41,572 |
| proj-flok.png | 1733x1049 | 929,016 | 7 | 290,473 | 1200px: 59,394 / 45,424 / 100,862 |
| proj-hs-building.png | 1590x861 | 768,653 | 7 | 217,910 | 1200px: 42,922 / 34,787 / 74,088 |
| proj-miners.png | 1000x633 | 613,805 | 7 | 239,573 | 1000px: 44,076 / 39,066 / 80,524 |
| proj-nailhead.png | 1000x515 | 346,509 | 7 | 203,554 | 1000px: 38,940 / 35,363 / 62,894 |
| proj-savethedate.png | 1000x633 | 492,778 | 7 | 139,061 | 1000px: 24,358 / 17,408 / 50,838 |
| working.png | 1140x1600 | 1,637,314 | 7 | 452,157 | 1140px: 80,784 / 62,990 / 172,473 |
| **Total** | | **13,945,679** | **82** | **3,365,013** | |

"Total variant bytes" is the sum of *all* variants for that photo; a browser
only fetches one. The homepage LCP image goes from 4,692,465 B (`couple.png`)
to 47,602 B (`couple-800.webp`) or 40,780 B (`couple-800.avif`) in its ~520 px
column at 1.5× DPR.

Sources narrower than 1200 px (so no `-1200` variant exists): `proj-farmers`,
`proj-fennec`, `proj-miners`, `proj-nailhead`, `proj-savethedate` (1000 px),
`working` (1140 px), `proj-flightsim` (612 px — also no 800). These are the
originals' real resolution; replacing the source PNGs with larger exports would
let the pipeline fill in the missing widths on the next run.

Per-file output:

| File | Size (px) | Bytes |
|---|---|---:|
| couple-480.webp | 480×360 | 20,644 |
| couple-480.avif | 480×360 | 17,342 |
| couple-800.webp | 800×600 | 47,602 |
| couple-800.avif | 800×600 | 40,780 |
| couple-1200.webp | 1200×900 | 97,484 |
| couple-1200.avif | 1200×900 | 80,776 |
| couple-1200.jpg | 1200×900 | 163,569 |
| desk-480.webp | 480×270 | 11,644 |
| desk-480.avif | 480×270 | 9,745 |
| desk-800.webp | 800×450 | 19,912 |
| desk-800.avif | 800×450 | 15,478 |
| desk-1200.webp | 1200×675 | 36,272 |
| desk-1200.avif | 1200×675 | 27,660 |
| desk-1200.jpg | 1200×675 | 73,972 |
| proj-bbm-480.webp | 480×281 | 23,784 |
| proj-bbm-480.avif | 480×281 | 21,567 |
| proj-bbm-800.webp | 800×468 | 47,710 |
| proj-bbm-800.avif | 800×468 | 41,799 |
| proj-bbm-1200.webp | 1200×701 | 94,174 |
| proj-bbm-1200.avif | 1200×701 | 82,069 |
| proj-bbm-1200.jpg | 1200×701 | 138,913 |
| proj-farmers-480.webp | 480×247 | 17,676 |
| proj-farmers-480.avif | 480×247 | 15,489 |
| proj-farmers-800.webp | 800×412 | 39,436 |
| proj-farmers-800.avif | 800×412 | 34,321 |
| proj-farmers-1000.webp | 1000×515 | 60,108 |
| proj-farmers-1000.avif | 1000×515 | 54,023 |
| proj-farmers-1000.jpg | 1000×515 | 93,434 |
| proj-fennec-480.webp | 480×304 | 15,034 |
| proj-fennec-480.avif | 480×304 | 12,520 |
| proj-fennec-800.webp | 800×506 | 33,388 |
| proj-fennec-800.avif | 800×506 | 26,678 |
| proj-fennec-1000.webp | 1000×633 | 51,016 |
| proj-fennec-1000.avif | 1000×633 | 42,396 |
| proj-fennec-1000.jpg | 1000×633 | 86,429 |
| proj-flightsim-480.webp | 480×314 | 18,296 |
| proj-flightsim-480.avif | 480×314 | 15,575 |
| proj-flightsim-612.webp | 612×400 | 28,056 |
| proj-flightsim-612.avif | 612×400 | 23,942 |
| proj-flightsim-612.jpg | 612×400 | 41,572 |
| proj-flok-480.webp | 480×291 | 16,088 |
| proj-flok-480.avif | 480×291 | 13,077 |
| proj-flok-800.webp | 800×484 | 30,188 |
| proj-flok-800.avif | 800×484 | 25,440 |
| proj-flok-1200.webp | 1200×726 | 59,394 |
| proj-flok-1200.avif | 1200×726 | 45,424 |
| proj-flok-1200.jpg | 1200×726 | 100,862 |
| proj-hs-building-480.webp | 480×260 | 12,204 |
| proj-hs-building-480.avif | 480×260 | 9,200 |
| proj-hs-building-800.webp | 800×433 | 25,718 |
| proj-hs-building-800.avif | 800×433 | 18,991 |
| proj-hs-building-1200.webp | 1200×650 | 42,922 |
| proj-hs-building-1200.avif | 1200×650 | 34,787 |
| proj-hs-building-1200.jpg | 1200×650 | 74,088 |
| proj-miners-480.webp | 480×304 | 12,634 |
| proj-miners-480.avif | 480×304 | 11,039 |
| proj-miners-800.webp | 800×506 | 28,130 |
| proj-miners-800.avif | 800×506 | 24,104 |
| proj-miners-1000.webp | 1000×633 | 44,076 |
| proj-miners-1000.avif | 1000×633 | 39,066 |
| proj-miners-1000.jpg | 1000×633 | 80,524 |
| proj-nailhead-480.webp | 480×247 | 10,398 |
| proj-nailhead-480.avif | 480×247 | 9,179 |
| proj-nailhead-800.webp | 800×412 | 24,554 |
| proj-nailhead-800.avif | 800×412 | 22,226 |
| proj-nailhead-1000.webp | 1000×515 | 38,940 |
| proj-nailhead-1000.avif | 1000×515 | 35,363 |
| proj-nailhead-1000.jpg | 1000×515 | 62,894 |
| proj-savethedate-480.webp | 480×304 | 9,308 |
| proj-savethedate-480.avif | 480×304 | 7,126 |
| proj-savethedate-800.webp | 800×506 | 17,240 |
| proj-savethedate-800.avif | 800×506 | 12,783 |
| proj-savethedate-1000.webp | 1000×633 | 24,358 |
| proj-savethedate-1000.avif | 1000×633 | 17,408 |
| proj-savethedate-1000.jpg | 1000×633 | 50,838 |
| working-480.webp | 480×674 | 25,666 |
| working-480.avif | 480×674 | 20,391 |
| working-800.webp | 800×1123 | 50,402 |
| working-800.avif | 800×1123 | 39,451 |
| working-1140.webp | 1140×1600 | 80,784 |
| working-1140.avif | 1140×1600 | 62,990 |
| working-1140.jpg | 1140×1600 | 172,473 |

## Next phase (not done here)

Markup: swap each `<img src="assets/<name>.png">` for a `<picture>` with an
AVIF `<source>`, a WebP `<source>` (both with `srcset` built from
`images.json` and a `sizes` attribute matching the column), and the `-1200.jpg`
(or native-width `.jpg`) as the `<img src>` fallback, with explicit
`width`/`height` from the manifest to avoid layout shift. Once no page
references a photo PNG directly, the originals can be removed from `assets/`.
