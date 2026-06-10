# Shared Frontend via PHP Partials — Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** De-duplicate the ~74% shared CSS and the header/footer/`<head>` markup across the three pages by extracting `assets/site.css`, `assets/site.js`, and PHP partials (`head.php`, `nav.php`, `footer.php`), converting the pages to `.php`.

**Architecture:** Each page becomes a thin `.php` file that sets a few SEO/nav variables, `include`s the shared `head.php` (which opens the document, loads fonts/GA/favicon/`site.css` and emits per-page SEO), `include`s `nav.php` (shared nav bar, per-page links via `$navItems`), keeps its own hero + page-specific `<style>`/inline JS, and `include`s `footer.php`. Shared behaviour (nav-shadow, mobile menu, FAQ accordion) lives in `assets/site.js`.

**Tech Stack:** Static HTML/CSS/JS + PHP includes (no build step). Host already runs PHP (`send.php`). Deploy = FTPS sync of repo root to `/public_html`.

**Branch:** `refactor/shared-frontend` (already created; spec + `docs/` deploy-exclude already committed there).

**Verification model:** This is a behaviour-preserving refactor, so "tests" = (a) `grep` assertions on generated HTML and (b) rendering each page in a local PHP server and comparing against the current live pages (images, footer, nav, `<head>`, GA, reCAPTCHA, forms). The live site (`https://hellowebdesign.co.uk/...`) is the baseline.

---

## File Structure

**Create:**
- `partials/head.php` — opens `<!DOCTYPE>…<body>`; fonts, favicon, GA (all pages), `site.css`; per-page title/desc/canonical/OG/Twitter/JSON-LD via vars; reCAPTCHA gated by `$needsRecaptcha`.
- `partials/nav.php` — shared `<nav id="nav">` (brand + mobile toggle); per-page links via `$navItems`, `$ctaHref`, `$ctaLabel`.
- `partials/footer.php` — one unified `<footer>` (social icons + absolute links on every page).
- `assets/site.css` — shared base CSS (~92 lines common to all three pages).
- `assets/site.js` — shared JS: nav-shadow-on-scroll, mobile menu, FAQ accordion (null-guarded, loaded `defer`).

**Modify (convert):**
- `index.html` → `index.php`
- `social-media-management/index.html` → `social-media-management/index.php`
- `wedding-websites/index.html` → `wedding-websites/index.php`

**Delete:** the three `.html` files (so the server serves the new `.php` at the same URLs).

---

## Task 0: Preflight — local PHP runner

**Files:** none (environment check)

- [ ] **Step 1: Confirm PHP CLI is available**

Run: `php -v`
Expected: prints a PHP version (7.x/8.x).
If MISSING on Windows: use Docker as the local runner in all later verification steps instead of `php -S`:
`docker run --rm -p 8920:8920 -v "${PWD}:/app" -w /app php:8.3-cli php -S 0.0.0.0:8920`
(If neither PHP nor Docker is available, STOP and tell the user — local verification of PHP output is required before any PR.)

- [ ] **Step 2: Record the baseline**

The current live pages are the visual/behaviour baseline:
- `https://hellowebdesign.co.uk/`
- `https://hellowebdesign.co.uk/social-media-management/`
- `https://hellowebdesign.co.uk/wedding-websites/`
No commit.

---

## Task 1: Extract shared CSS → `assets/site.css`

**Files:**
- Create: `assets/site.css`
- Reference: `index.html` `<style>` (lines 42–346), `social-media-management/index.html` `<style>` (41–173), `wedding-websites/index.html` `<style>` (similar)

- [ ] **Step 1: Compute the shared CSS lines (identical across all three pages)**

```bash
cd <repo>
awk '/<style>/{f=1;next}/<\/style>/{f=0}f' index.html                          > /tmp/css_home.txt
awk '/<style>/{f=1;next}/<\/style>/{f=0}f' social-media-management/index.html   > /tmp/css_social.txt
awk '/<style>/{f=1;next}/<\/style>/{f=0}f' wedding-websites/index.html          > /tmp/css_wed.txt
# lines present in ALL THREE, preserving homepage order:
grep -Fxf /tmp/css_social.txt /tmp/css_home.txt | grep -Fxf /tmp/css_wed.txt   > /tmp/css_shared.txt
wc -l /tmp/css_shared.txt
```
Expected: ~92 lines.

- [ ] **Step 2: Write `assets/site.css`**

Put a header comment then the shared lines:
```bash
{ echo "/* Shared base styles for HelloWebDesign — tokens, reset, header/nav, .btn, footer."; \
  echo "   Page-specific CSS stays inline in each page's <style>. */"; \
  cat /tmp/css_shared.txt; } > assets/site.css
```

- [ ] **Step 3: Sanity-check the shared file contains the expected anchors**

Run: `grep -cE -- '--teal-ink|\.btn\{|\.btn-line:hover|\.foot-brand img|\.brand img|^\s*\*\{|:root\{' assets/site.css`
Expected: ≥ 6 (design tokens, reset, buttons, footer/header logo rules all present).

- [ ] **Step 4: Commit**

```bash
git add assets/site.css
git commit -m "Add shared assets/site.css (extracted base styles)"
```

---

## Task 2: Create `assets/site.js` (shared behaviour)

**Files:**
- Create: `assets/site.js`
- Reference: subpage inline JS (`social-media-management/index.html` lines 352–377) — the canonical shared trio.

- [ ] **Step 1: Write `assets/site.js`**

```js
/* Shared behaviour for all pages: nav shadow, mobile menu, FAQ accordion.
   Loaded with `defer`, so the DOM is ready. Null-guarded so it is safe on any page. */
(() => {
  // nav shadow on scroll
  const nav = document.getElementById('nav');
  if (nav) {
    addEventListener('scroll', () => nav.classList.toggle('scrolled', scrollY > 12), { passive: true });
  }

  // mobile menu
  const navToggle = document.getElementById('navToggle');
  const navLinks  = document.getElementById('navLinks');
  if (navToggle && navLinks) {
    navToggle.addEventListener('click', () => { navLinks.classList.toggle('open'); navToggle.classList.toggle('open'); });
    navLinks.querySelectorAll('a').forEach(a => a.addEventListener('click', () => { navLinks.classList.remove('open'); navToggle.classList.remove('open'); }));
  }

  // FAQ accordion (only one open at a time)
  document.querySelectorAll('.faq-q').forEach((q) => {
    q.addEventListener('click', () => {
      const item = q.closest('.faq-item');
      const wasOpen = item.classList.contains('open');
      document.querySelectorAll('.faq-item.open').forEach((o) => {
        o.classList.remove('open');
        o.querySelector('.faq-q').setAttribute('aria-expanded', 'false');
      });
      if (!wasOpen) { item.classList.add('open'); q.setAttribute('aria-expanded', 'true'); }
    });
  });
})();
```
(The IIFE wrapper avoids any global redeclaration collision with page-inline scripts.)

- [ ] **Step 2: Commit**

```bash
git add assets/site.js
git commit -m "Add shared assets/site.js (nav, mobile menu, FAQ)"
```

---

## Task 3: Create `partials/head.php`

**Files:**
- Create: `partials/head.php`
- Reference: `index.html` head (lines 3–41), social head (3–40).

- [ ] **Step 1: Write `partials/head.php`**

```php
<?php
  /* Required vars (set before include): $title, $desc, $canonical
     Optional: $ogImage (default og-image.jpg), $twitterDesc (default $desc),
               $jsonLd (raw <script type="application/ld+json">…</script> markup),
               $needsRecaptcha (bool, default false) */
  $ogImage        = $ogImage        ?? 'https://hellowebdesign.co.uk/assets/og-image.jpg';
  $twitterDesc    = $twitterDesc    ?? $desc;
  $needsRecaptcha = $needsRecaptcha ?? false;
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?= $title ?></title>
<meta name="description" content="<?= $desc ?>" />
<link rel="canonical" href="<?= $canonical ?>" />
<link rel="icon" href="/favicon.ico" sizes="any" />
<link rel="icon" type="image/png" sizes="96x96" href="/assets/favicon-96x96.png" />
<link rel="icon" type="image/svg+xml" href="/assets/favicon.svg" />
<link rel="apple-touch-icon" sizes="180x180" href="/assets/apple-touch-icon.png" />
<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:site_name" content="HelloWebDesign" />
<meta property="og:title" content="<?= $title ?>" />
<meta property="og:description" content="<?= $desc ?>" />
<meta property="og:url" content="<?= $canonical ?>" />
<meta property="og:image" content="<?= $ogImage ?>" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />
<meta property="og:image:alt" content="Hanna and Rachid, the husband-and-wife team behind HelloWebDesign" />
<meta property="og:locale" content="en_GB" />
<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="<?= $title ?>" />
<meta name="twitter:description" content="<?= $twitterDesc ?>" />
<meta name="twitter:image" content="<?= $ogImage ?>" />
<meta name="twitter:image:alt" content="Hanna and Rachid, the husband-and-wife team behind HelloWebDesign" />
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,400;0,6..72,500;0,6..72,600;1,6..72,400;1,6..72,500&family=Hanken+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="/assets/site.css" />
<script defer src="/assets/site.js"></script>
<?php if ($needsRecaptcha): ?>
<script async defer src="https://www.google.com/recaptcha/api.js?render=6LcixXcsAAAAACLNjsk91s8-RTpuoOeqsnGOqRuH"></script>
<?php endif; ?>
<!-- Google Analytics (GA4) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-5GF9NH7X8G"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-5GF9NH7X8G');
</script>
<?php if (!empty($jsonLd)) echo $jsonLd, "\n"; ?>
</head>
<body>
```

- [ ] **Step 2: Commit**

```bash
git add partials/head.php
git commit -m "Add partials/head.php (shared <head>, per-page SEO via vars)"
```

---

## Task 4: Create `partials/nav.php`

**Files:**
- Create: `partials/nav.php`
- Reference: homepage nav (lines 417–429), social nav (233–245).

- [ ] **Step 1: Write `partials/nav.php`**

```php
<?php
  /* $navItems: array of [href, label] for the main links.
     Optional: $ctaHref (default '/#contact'), $ctaLabel (default 'Get in touch'). */
  $ctaHref  = $ctaHref  ?? '/#contact';
  $ctaLabel = $ctaLabel ?? 'Get in touch';
?>
<nav id="nav">
  <div class="wrap nav-in">
    <a href="/" class="brand"><picture><source media="(max-width:880px)" srcset="/assets/logo-dark.png" /><img src="/assets/logo.png" width="677" height="369" alt="HelloWebDesign - web design and social media studio in Urmston, Manchester" /></picture></a>
    <div class="nav-links" id="navLinks">
<?php foreach ($navItems as [$href, $label]): ?>
      <a href="<?= $href ?>"><?= $label ?></a>
<?php endforeach; ?>
      <a href="<?= $ctaHref ?>" class="nav-cta"><?= $ctaLabel ?></a>
    </div>
    <button class="nav-toggle" id="navToggle" aria-label="Open menu"><span></span><span></span><span></span></button>
  </div>
</nav>
```

- [ ] **Step 2: Commit**

```bash
git add partials/nav.php
git commit -m "Add partials/nav.php (shared nav bar, per-page links)"
```

---

## Task 5: Create `partials/footer.php` (unified)

**Files:**
- Create: `partials/footer.php`
- Reference: homepage footer (lines 672–~700) for the Instagram/Facebook SVG path data — **copy the two `<svg>…</svg>` blocks verbatim from `index.html`'s `.foot-social`** (long `path d="…"` strings).

- [ ] **Step 1: Write `partials/footer.php`**

```php
<footer>
  <div class="wrap">
    <div class="foot-top">
      <div class="foot-brand">
        <img src="/assets/logo-dark.png" width="677" height="369" loading="lazy" decoding="async" alt="HelloWebDesign" />
        <p style="font-size:14px;margin-top:6px">A husband-and-wife creative studio helping local businesses build their online presence. Based in Greater Manchester.</p>
        <div class="foot-social">
          <a href="https://www.instagram.com/hellowebdesignco/" target="_blank" rel="noopener" aria-label="Instagram"><svg viewBox="0 0 24 24"><!-- PASTE Instagram path d from index.html verbatim --></svg></a>
          <a href="https://www.facebook.com/hello.web.design.uk/" target="_blank" rel="noopener" aria-label="Facebook"><svg viewBox="0 0 24 24"><!-- PASTE Facebook path d from index.html verbatim --></svg></a>
        </div>
      </div>
      <div class="foot-cols">
        <div><h4>Explore</h4><a href="/">Home</a><a href="/#work">Work</a><a href="/#services">Services</a><a href="/#packages">Packages</a><a href="/social-media-management/">Social Media</a><a href="/wedding-websites/">Wedding Websites</a></div>
        <div><h4>Get in touch</h4><a href="mailto:contact@hellowebdesign.co.uk">Email us</a><a href="tel:07763648866">Hanna 07763 648866</a><a href="tel:07816130955">Rachid 07816 130955</a><a href="/#contact">Urmston, Manchester</a></div>
      </div>
    </div>
    <div class="foot-bot"><span>© 2026 HelloWebDesign. All rights reserved.</span><a href="/#privacy" id="privacyLink">Privacy Policy</a></div>
  </div>
</footer>
```
> Note: `id="privacyLink"` is kept so the homepage's existing modal JS still intercepts it; on the subpages (no such JS) it falls back to navigating to `/#privacy`, matching current behaviour. The two SVG path-`d` strings MUST be pasted verbatim from `index.html` — do not hand-type them.

- [ ] **Step 2: Commit**

```bash
git add partials/footer.php
git commit -m "Add partials/footer.php (unified footer with social icons)"
```

---

## Task 6: Convert the homepage `index.html` → `index.php`

**Files:**
- Create: `index.php`
- Delete: `index.html`
- Reference: `index.html` — head (3–41), JSON-LD (347–413), nav (417–429), hero through footer (431–739), inline JS (740–953).

- [ ] **Step 1: Build `index.php` skeleton (vars + includes)**

Create `index.php` starting with:
```php
<?php
  $title       = 'HelloWebDesign - Web Design & Social Media in Urmston';
  $desc        = 'Husband-and-wife web design and social media studio in Urmston, helping small businesses across Manchester get online - personal, jargon-free, within a week.';
  $canonical   = 'https://hellowebdesign.co.uk/';
  $needsRecaptcha = true;                 // homepage has the contact form
  $navItems    = [
    ['/#about',    'About'],
    ['/#work',     'Work'],
    ['/#services', 'Services'],
    ['/#packages', 'Packages'],
  ];
  $ctaHref     = '/#contact';
  $jsonLd      = <<<'JSONLD'
<!-- PASTE both <script type="application/ld+json">…</script> blocks from index.html lines 347–413 VERBATIM -->
JSONLD;
  include $_SERVER['DOCUMENT_ROOT'].'/partials/head.php';
  include $_SERVER['DOCUMENT_ROOT'].'/partials/nav.php';
?>
```
Use `&` (not `&amp;`) inside the PHP `$title` string — `head.php` prints it inside `<title>`, and the original `<title>` used `&amp;`; PHP `<?= ?>` does NOT escape, so write the title with a literal `&` to render identically. (OG/Twitter title meta also get this value; `&` in an attribute is acceptable and matches the rendered DOM.)

- [ ] **Step 2: Append the page body (hero → footer boundary)**

After the includes, paste the homepage content **from the hero opening to just before `<footer>`** — i.e. `index.html` lines **431–671** (the `<!-- HERO --> <header class="hero">…</header>` through all sections, ending right before `<footer>`). Keep the page-specific `<style>`…`</style>` too: move the homepage's **page-specific** CSS (everything in the old `<style>` that is NOT in `assets/site.css`) into a `<style>` block placed at the top of the body content.

To compute the page-specific CSS:
```bash
awk '/<style>/{f=1;next}/<\/style>/{f=0}f' index.html > /tmp/css_home.txt
grep -Fxvf /tmp/css_shared.txt /tmp/css_home.txt > /tmp/css_home_only.txt
wc -l /tmp/css_home_only.txt   # expect ~ (305-92) ≈ 213 lines
```
Wrap `/tmp/css_home_only.txt` in `<style>`…`</style>` and place it immediately after the nav include (before the hero), so page CSS still loads after `site.css` (cascade preserved).

- [ ] **Step 3: Add the footer include + page-specific JS**

After the page content, add:
```php
<?php include $_SERVER['DOCUMENT_ROOT'].'/partials/footer.php'; ?>
```
Then the homepage's page-specific `<script>`. Take `index.html` lines 740–953 and **remove the shared trio now living in `site.js`**:
- Delete the `const nav = …` nav-shadow block, BUT keep back-to-top. Replace lines 742–748 with:
```js
  const toTop = document.getElementById('toTop');
  addEventListener('scroll', () => toTop.classList.toggle('show', scrollY > 500), { passive: true });
  toTop.addEventListener('click', () => scrollTo({ top: 0, behavior: 'smooth' }));
```
- Delete the `// mobile menu` block (lines 750–753).
- Delete the `// FAQ accordion` block (whichever lines it occupies in the homepage script).
- Keep everything else (reveal, work toggle, count-up, projects/modal, prefill, contact form + reCAPTCHA, privacy modal).

> **Critical:** `site.js` declares globals `nav`, `navToggle`, `navLinks`. The homepage inline script must NOT also declare `const nav/navToggle/navLinks` (global redeclaration = `SyntaxError`, whole script dies). After the deletions above, confirm none remain:
> `grep -nE 'const (nav|navToggle|navLinks)\b' index.php` → expect **0 matches**.

- [ ] **Step 4: Delete the old HTML and remove its leading `<!DOCTYPE>`/`<html>`**

`index.php` must NOT contain its own `<!DOCTYPE html>`/`<html>`/`<head>`/`<body>` (head.php owns them) and must NOT contain the old `<nav id="nav">`/`<footer>` (partials own them).
```bash
git rm index.html
grep -nE '<!DOCTYPE|<html|^<head>|^<body>' index.php   # expect 0 matches
```

- [ ] **Step 5: Verify rendered output locally**

Start the runner: `php -S localhost:8920` (or the Docker fallback). Then:
```bash
curl -s http://localhost:8920/ > /tmp/home.html
# GA on page:
grep -c 'G-5GF9NH7X8G' /tmp/home.html            # expect 2
# reCAPTCHA present (homepage):
grep -c 'recaptcha/api.js' /tmp/home.html         # expect 1
# site.css + site.js linked:
grep -cE '/assets/site\.(css|js)' /tmp/home.html  # expect 2
# title/canonical/OG intact:
grep -c 'rel="canonical" href="https://hellowebdesign.co.uk/"' /tmp/home.html  # expect 1
# both JSON-LD blocks:
grep -c 'application/ld+json' /tmp/home.html      # expect 2
# nav + footer present once each:
grep -c '<nav id="nav"' /tmp/home.html            # expect 1
grep -c '<footer' /tmp/home.html                  # expect 1
```
Then render in the browser tool (`http://localhost:8920/`): check **0 console errors**, measure `.frame`/`.main`/`.inset`/`.foot-brand img` ratios match the live values (504×629 / 484×645 / 223×167 / 84×46), test the mobile-nav toggle, the project modal, the "show all projects" toggle, the FAQ accordion, the back-to-top button, and submit-validate the contact form (reCAPTCHA token populates).

- [ ] **Step 6: Commit**

```bash
git add index.php
git commit -m "Convert homepage to index.php using shared partials"
```

---

## Task 7: Convert `social-media-management/index.html` → `index.php`

**Files:**
- Create: `social-media-management/index.php`
- Delete: `social-media-management/index.html`
- Reference: social head (3–40), its JSON-LD block(s), nav (233–245), body (247–351), inline JS (352–377).

- [ ] **Step 1: Build the skeleton**

```php
<?php
  $title       = 'Social Media Management in Manchester | HelloWebDesign';
  $desc        = 'Hands-on social media management for Manchester businesses - content creation, on-site filming, scheduling and community management from a husband-and-wife studio in Urmston.';
  $twitterDesc = 'Hands-on social media management for Manchester businesses - content creation, on-site filming, scheduling and community management.';
  $canonical   = 'https://hellowebdesign.co.uk/social-media-management/';
  $needsRecaptcha = false;
  $navItems    = [
    ['/',          'Home'],
    ['#included',  "What's included"],
    ['#case-study','Case study'],
    ['#faq',       'FAQs'],
  ];
  $ctaHref     = '/?prefill=Social%20Media%20Management#contact';
  $jsonLd      = <<<'JSONLD'
<!-- PASTE the social page's existing <script type="application/ld+json">…</script> block(s) VERBATIM -->
JSONLD;
  include $_SERVER['DOCUMENT_ROOT'].'/partials/head.php';
  include $_SERVER['DOCUMENT_ROOT'].'/partials/nav.php';
?>
```
> `$twitterDesc` is set because this page's `twitter:description` differs from its `description` (must not regress).

- [ ] **Step 2: Page-specific CSS + body**

Compute page-only CSS and append body 247–333 (hero through just before `<footer>`):
```bash
awk '/<style>/{f=1;next}/<\/style>/{f=0}f' social-media-management/index.html > /tmp/css_s.txt
grep -Fxvf /tmp/css_shared.txt /tmp/css_s.txt > /tmp/css_s_only.txt
wc -l /tmp/css_s_only.txt   # expect ~41
```
Wrap in `<style>` after the nav include; then paste social body lines 247–333.

- [ ] **Step 3: Footer include (no page-specific JS needed — all 3 behaviours are in site.js)**

```php
<?php include $_SERVER['DOCUMENT_ROOT'].'/partials/footer.php'; ?>
```
The social page's old inline `<script>` (352–377) is fully covered by `site.js`; do NOT re-add it.

- [ ] **Step 4: Delete old html, assert no document/partials duplication**

```bash
git rm social-media-management/index.html
grep -nE '<!DOCTYPE|<html|^<head>|^<body>|<nav id="nav"|<footer' social-media-management/index.php  # expect 0
```

- [ ] **Step 5: Verify locally**

```bash
curl -s http://localhost:8920/social-media-management/ > /tmp/social.html
grep -c 'G-5GF9NH7X8G' /tmp/social.html             # expect 2  (GA on this page)
grep -c 'recaptcha/api.js' /tmp/social.html          # expect 0  (no form here)
grep -cE '/assets/site\.(css|js)' /tmp/social.html   # expect 2
grep -c 'social-media-management/' /tmp/social.html  # canonical etc present
grep -c '<footer' /tmp/social.html                   # expect 1
```
Render `http://localhost:8920/social-media-management/`: 0 console errors; hero `desk.png` correct 4:3; `.case-grid`/footer logo correct; **footer now shows social icons**; mobile nav + FAQ work; nav links resolve (`#included` scrolls within page, "Home" → `/`, "Get in touch" → prefill).

- [ ] **Step 6: Commit**

```bash
git add social-media-management/index.php
git commit -m "Convert social-media-management page to PHP partials"
```

---

## Task 8: Convert `wedding-websites/index.html` → `index.php`

**Files:**
- Create: `wedding-websites/index.php`
- Delete: `wedding-websites/index.html`
- Reference: wedding head, JSON-LD, nav, body, inline JS (mirror of the social page).

- [ ] **Step 1: Read the wedding page's current head + nav to capture exact values**

Run: `sed -n '3,45p;233,265p' wedding-websites/index.html` (adjust line numbers to the file).
Capture verbatim: `<title>`, `description`, (any) `twitter:description`, `canonical`, the nav link list + CTA href, and the JSON-LD block(s).

- [ ] **Step 2: Build the skeleton** (same shape as Task 7, with the wedding values)

```php
<?php
  $title       = '<!-- wedding <title> verbatim -->';
  $desc        = '<!-- wedding description verbatim -->';
  // set $twitterDesc ONLY if the page's twitter:description differs from $desc
  $canonical   = 'https://hellowebdesign.co.uk/wedding-websites/';
  $needsRecaptcha = false;
  $navItems    = [ /* wedding nav links as [href,label], e.g. ['/','Home'], ['#included',...], ['#example',...], ['#faq','FAQs'] */ ];
  $ctaHref     = '<!-- wedding CTA href verbatim (likely /?prefill=Wedding%20Website#contact) -->';
  $jsonLd      = <<<'JSONLD'
<!-- PASTE wedding JSON-LD block(s) VERBATIM -->
JSONLD;
  include $_SERVER['DOCUMENT_ROOT'].'/partials/head.php';
  include $_SERVER['DOCUMENT_ROOT'].'/partials/nav.php';
?>
```

- [ ] **Step 3: Page-specific CSS + body + footer include** (same method as Task 7)

```bash
awk '/<style>/{f=1;next}/<\/style>/{f=0}f' wedding-websites/index.html > /tmp/css_w.txt
grep -Fxvf /tmp/css_shared.txt /tmp/css_w.txt > /tmp/css_w_only.txt
```
Wrap page-only CSS in `<style>` after nav; paste wedding body (hero → before `<footer>`); add footer include. No page-specific JS (covered by site.js).

- [ ] **Step 4: Delete old html, assert clean**

```bash
git rm wedding-websites/index.html
grep -nE '<!DOCTYPE|<html|^<head>|^<body>|<nav id="nav"|<footer' wedding-websites/index.php  # expect 0
```

- [ ] **Step 5: Verify locally**

```bash
curl -s http://localhost:8920/wedding-websites/ > /tmp/wed.html
grep -c 'G-5GF9NH7X8G' /tmp/wed.html            # expect 2
grep -c 'recaptcha/api.js' /tmp/wed.html         # expect 0
grep -cE '/assets/site\.(css|js)' /tmp/wed.html  # expect 2
grep -c '<footer' /tmp/wed.html                  # expect 1
```
Render `http://localhost:8920/wedding-websites/`: 0 console errors; hero `save-the-date.png` correct ratio; `.case-grid`/footer logo correct; footer shows social icons; mobile nav + FAQ work.

- [ ] **Step 6: Commit**

```bash
git add wedding-websites/index.php
git commit -m "Convert wedding-websites page to PHP partials"
```

---

## Task 9: Cross-page regression sweep + duplication proof

**Files:** none (verification) — then a final commit if any fixups were needed.

- [ ] **Step 1: Prove the duplication is gone**

```bash
# CSS now exists once:
grep -c 'aspect-ratio:4/5' assets/site.css index.php   # token rule lives in site.css, not pages
# the previously-3x-duplicated footer markup now exists 0 times in pages, 1 time in the partial:
grep -rl 'foot-social' partials/ | wc -l               # expect 1 (footer.php)
grep -rl '<nav id="nav"' partials/ | wc -l             # expect 1 (nav.php)
grep -rlE 'foot-social|<nav id="nav"' index.php social-media-management/index.php wedding-websites/index.php | wc -l  # expect 0
```

- [ ] **Step 2: Confirm GA on ALL pages and reCAPTCHA only on homepage** (the user's explicit requirement)

```bash
for p in / /social-media-management/ /wedding-websites/; do
  echo -n "$p GA="; curl -s "http://localhost:8920$p" | grep -c 'G-5GF9NH7X8G'
  echo -n "$p reCAPTCHA="; curl -s "http://localhost:8920$p" | grep -c 'recaptcha/api.js'
done
```
Expected: GA=2 on all three; reCAPTCHA=1 on `/`, 0 on the subpages.

- [ ] **Step 3: Side-by-side visual check vs live**

For each of the three pages, render local (`http://localhost:8920…`) and the live URL, and confirm the hero, about/case images, cards, nav, and footer look identical (apart from the intended footer-icon addition on subpages). Re-measure all images (no stretching). Confirm 0 console errors on every page.

- [ ] **Step 4: (If any fixups were made) commit**

```bash
git add -A && git commit -m "Fixups from cross-page regression sweep"
```

---

## Task 10: Open the PR (do NOT merge)

**Files:** none

- [ ] **Step 1: Push and open the PR**

```bash
git push -u origin refactor/shared-frontend
gh pr create --base main --head refactor/shared-frontend \
  --title "Refactor: shared CSS/JS + PHP partials (head/nav/footer) across all pages" \
  --body "<summary of the change, the GA-on-all / reCAPTCHA-homepage-only guarantee, the unified footer, and the local verification performed>"
```

- [ ] **Step 2: STOP**

Per `CLAUDE.md`: do not squash-merge until the user gives explicit go-ahead for this PR (merge = live deploy). After approval: squash-merge, watch the Actions run, then verify all three live URLs render correctly (images, footer icons, GA on all, contact form on homepage).

---

## Self-Review (completed during planning)

- **Spec coverage:** site.css (Task 1), site.js (Task 2), head.php/nav.php/footer.php (Tasks 3–5), page conversions (6–8), GA-on-all + reCAPTCHA-homepage-only (head.php `$needsRecaptcha`; verified Task 9 Step 2), unified footer (Task 5; subpage icons verified Tasks 7–8), per-page SEO preserved (`$title/$desc/$canonical/$twitterDesc/$jsonLd`), URLs unchanged (`.php` directory-index). ✓
- **Placeholder scan:** the only "paste verbatim" markers are deliberate references to existing exact content (JSON-LD blocks, the two footer SVG paths, wedding head values) that must not be hand-retyped — each names the exact source location. ✓
- **Hazard captured:** global `const nav/navToggle/navLinks` redeclaration between `site.js` and homepage inline JS (Task 6 Step 3, with a grep gate). ✓
- **Type/interface consistency:** `$navItems` is `[[href,label],…]` in head/nav and every page; `$jsonLd` is raw `<script>` markup echoed verbatim by head.php; `$needsRecaptcha` bool consistent. ✓
