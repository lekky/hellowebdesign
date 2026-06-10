# Shared frontend via PHP partials — design

**Date:** 2026-06-10
**Goal:** Remove the ~74% CSS duplication and the duplicated header/footer/`<head>`
markup across the three pages, so a change like the recent stretched-image fix is
made **once**, not three times.

## Context / problem

The site is three standalone pages, each with its own inline `<style>`, inline JS,
and copy-pasted header/footer markup:

- `index.html` (homepage, ~956 lines)
- `social-media-management/index.html` (~380 lines)
- `wedding-websites/index.html` (~387 lines)

Measured duplication: **92 of ~124 unique CSS lines (~74%) are byte-identical**
across all three pages (design tokens, reset, header/nav, `.btn`, footer). The
footer and header markup are likewise near-duplicated. This caused the image-fix
PR (#26) to touch all three files, and the green button-hover only reached the
homepage because the subpages carry their own `.btn-line:hover`.

Constraints:
- **No build step** (per CLAUDE.md). A `<link>` / PHP `include` is not a build.
- Host runs **PHP** (the contact form `send.php` works) → PHP includes are viable.
- Deploy syncs the whole repo root to `/public_html` over FTPS; `.php` files and
  new assets deploy automatically. Removed files are pruned by the sync.
- Clean URLs must stay: `/`, `/social-media-management/`, `/wedding-websites/`.

## Chosen approach: shared `assets/site.css` + `assets/site.js` + PHP partials

Convert the three pages from `.html` to `.php` and factor the common parts into
includes. `index.php` still serves at `/`, and `<subdir>/index.php` still serves
at `/<subdir>/`, so URLs are unchanged.

### New shared files

```
partials/
  head.php     # common <head>: fonts, favicon, GA, base meta; per-page SEO via vars;
               # reCAPTCHA gated behind $needsRecaptcha
  header.php   # shared header shell + brand/logo + mobile-nav; per-page nav via $navItems
  footer.php   # ONE unified footer (social icons + absolute links on every page)
assets/
  site.css     # the shared ~74% (tokens, reset, header, .btn, footer)
  site.js      # shared behaviour: reveal-on-scroll, mobile-nav toggle, back-to-top
```

Includes resolve via `$_SERVER['DOCUMENT_ROOT'].'/partials/<name>.php'` so they work
from any directory depth. CSS/JS referenced with absolute paths
(`/assets/site.css`, `/assets/site.js`).

### Page shape after refactor

Each `index.php` becomes:

```php
<?php
  $title       = '...';
  $desc        = '...';
  $canonical   = 'https://hellowebdesign.co.uk/...';
  $ogImage     = 'https://hellowebdesign.co.uk/assets/og-image.jpg';
  $jsonLd      = '...';            // page-specific structured data (raw JSON string)
  $needsRecaptcha = false;         // homepage sets true
  $navItems    = [ ['/#work','Work'], ... ];   // page-specific nav
  $ctaHref     = '#contact';       // or '/#contact' on subpages
  include $_SERVER['DOCUMENT_ROOT'].'/partials/head.php';
?>
  <?php include $_SERVER['DOCUMENT_ROOT'].'/partials/header.php'; ?>
  <!-- page-specific <style> + content + page-specific inline JS -->
<?php include $_SERVER['DOCUMENT_ROOT'].'/partials/footer.php'; ?>
```

### Design decisions (locked)

1. **CSS split** — shared base (~74%) → `assets/site.css`; each page keeps its own
   ~26% (`.case-grid`, `.feat-grid`, `.cta-band`, `.quote`, hero sizing) inline.
2. **JS split** — genuinely shared behaviour (reveal-on-scroll IntersectionObserver,
   mobile-nav toggle, back-to-top, WhatsApp/float) → `assets/site.js`. Homepage-only
   behaviour (project modal, "show all projects" toggle, package prefill, privacy
   modal) stays inline on the homepage.
3. **Footer unified** — one `footer.php` for all pages: social icons appear on every
   page (subpages gain them), and every footer link is absolute (`/`, `/#work`,
   `/#services`, `/#packages`, `/social-media-management/`, `/wedding-websites/`) so
   the same markup works from any page.
4. **Header shared** — `header.php` renders the shared shell (brand/logo + mobile-nav
   toggle); each page passes `$navItems` (and `$ctaHref`) for its own nav links.
5. **`<head>` shared, per-page SEO preserved** — fonts, favicon, **GA (on every page)**,
   and base meta live in `head.php`. Per-page `title`, meta description, canonical, OG
   tags and JSON-LD are passed in as variables so SEO is unchanged. **reCAPTCHA is
   gated behind `$needsRecaptcha`** and only the homepage (the only page with a
   `<form>`) sets it true — avoids loading an unused script + badge on the subpages.

### Things that must NOT regress (verification checklist)

- All three pages render identically to now (visual diff of hero/about/cards/footer).
- Every image still correct aspect ratio; footer logo correct (re-measure).
- GA (`G-5GF9NH7X8G`) gtag loader + config present on all three pages.
- reCAPTCHA present on homepage, absent on subpages; contact form still submits.
- Per-page `<title>`, meta description, canonical, OG/Twitter tags, JSON-LD intact.
- Favicon links + fonts present on all pages.
- Nav links + mobile nav work on each page; footer links resolve correctly.
- Old `.html` files removed so the server serves the new `.php` at the same URLs.

## Verification method

Run a local PHP server (`php -S`) over the repo, render all three pages with the
browser tool, measure images + footer, and diff the rendered `<head>`/footer/nav
against the current live pages before opening a PR. Ship as its own PR; do not merge
without explicit go-ahead (deploy = live).

## Out of scope

- The page-specific CSS/JS is left inline (only the shared portion is extracted).
- No visual/design changes beyond the footer unification noted above.
- No content/copy changes.
