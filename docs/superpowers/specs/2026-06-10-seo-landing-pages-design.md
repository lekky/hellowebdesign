# Design: SEO landing pages (web-design-manchester, small-business-websites)

**Date:** 2026-06-10
**Status:** Approved (design), pending implementation plan

## Goal

Add two new SEO landing pages targeting commercial-intent searches the homepage
and existing service pages don't capture. Each page must be genuinely
differentiated in angle, content, and proof to avoid doorway-page / duplicate-content
penalties — not a find-and-replace on the existing pages or homepage.

Target keywords:
- `/web-design-manchester/` → "web design manchester", "website designer manchester" (local/commercial intent)
- `/small-business-websites/` → "small business website design uk", "affordable website small business" (audience + price intent)

## Constraints / context

- Static PHP site, no build step. New pages mirror the existing landing-page pattern
  in `social-media-management/index.php` and `wedding-websites/index.php`.
- Shared partials: `partials/head.php` (meta/OG/Twitter/GA4/JSON-LD slot via `$jsonLd`),
  `partials/nav.php`, `partials/footer.php`. Shared `assets/site.css` + `assets/site.js`.
- Page file lives at `<slug>/index.php`; clean URL `https://hellowebdesign.co.uk/<slug>/`.
- All copy reuses the studio's existing warm, plain-spoken voice.
- **No invented clients, quotes, prices, or claims** — only reuse facts already on the
  live homepage (`index.php`).

### Reusable real assets (from index.php)
- Projects (images in `assets/`): Nailhead Properties (Manchester), Manchester Flight Sim
  Centre (Salford), HS Building Services (Greater Manchester), The Farmers Arms (Burscough
  pub), The Miners Arms (village pub), FLÓK, Fennec, Bolton Builders Merchants, Save the Date.
- Testimonials: Anoush S (Local Pub Owner); Mick H (Local Building Merchant); Hassan OE (Wedding).
- Pricing: Starter Site from £499; Business / E-commerce / Wedding custom-quoted. "Price we quote
  is the price you pay — no hidden fees."
- "Why us": deal with us directly; no hidden fees; we run a small business too; 20+ yrs big-brand experience.
- Contact prefill values (must match the `select[name=interested_package]` options in index.php):
  `Business Website (multi page)`, `Starter Website (one page)`.

## Page structure (both pages, mirroring existing landing pages)

PHP head vars block → `include partials/head.php` → per-page inline `<style>` (copied from an
existing landing page, trimmed to sections used) → `include partials/nav.php` → Hero →
content sections → FAQ → CTA band → `include partials/footer.php` → WhatsApp float button.

Each page sets: `$title`, `$desc`, `$twitterDesc` (only if it differs from `$desc`),
`$canonical`, `$needsRecaptcha = false`, `$navItems`, `$ctaHref`, and `$jsonLd` containing
three blocks: `Service` (+ `areaServed`, and `Offer` for page 2), `BreadcrumbList`, `FAQPage`.
The `FAQPage` JSON-LD questions/answers must match the on-page FAQ copy verbatim.

### Page 1 — /web-design-manchester/ (local intent)
- Title: `Web Design Manchester | Local Website Designers - HelloWebDesign`
- H1: "Web design in Manchester, from two people who actually pick up the phone."
- Hero image: `assets/proj-nailhead.png` (Manchester client).
- "Why local" section: 4 feat items — meet in person / know the area / deal direct /
  20+ yrs big-brand experience now focused locally.
- Local work grid: 3 Greater-Manchester projects — Nailhead (Manchester), Manchester Flight
  Sim Centre (Salford), HS Building Services (Greater Manchester), each with image + caption.
- Testimonial: Anoush S (Local Pub Owner).
- FAQ (~3): "Do you meet in person?" / "Which areas do you cover?" / "How much does a website cost?"
- JSON-LD `Service.areaServed`: Greater Manchester, UK.
- CTA prefill: `Business Website (multi page)`.

### Page 2 — /small-business-websites/ (audience + price intent)
- Title: `Small Business Websites - From £499 | HelloWebDesign`
- H1: "Small business websites that win you customers — from £499."
- Hero image: `assets/couple.png` (the team).
- "What you get" section: 4 feat items — one clear price / fast turnaround / you own it / no jargon.
- Packages: Starter (From £499) + Business (custom-quoted) cards, mirroring homepage `#packages`
  card styling; price-transparent.
- Proof: Farmers Arms + Miners Arms (small local businesses) + Anoush S quote.
- FAQ (~4): "How much does a small business website cost?" / "How long does it take?" /
  "Is one page enough?" / "Are there ongoing costs?"
- JSON-LD `Service` + `Offer` (price 499 GBP) + BreadcrumbList + FAQPage.
- CTA prefill: `Starter Website (one page)`.

## Other changes
- `sitemap.xml`: add both URLs, `lastmod 2026-06-10`, `changefreq monthly`, `priority 0.8`.
- Each page's nav: Home + on-page anchors (e.g. `#why`, `#work`/`#packages`, `#faq`).
- No homepage changes required (the existing pages were linked from index.php; decide during
  planning whether to add footer/nav links to the two new pages — optional, low risk).

## Out of scope (YAGNI)
- Per-page OG images (still falls back to shared og-image.jpg — separate task).
- A blog or blog infrastructure (explicitly deferred earlier in this conversation).
- The other two originally-proposed pages (/web-design-urmston/, /website-and-social-media/).

## Success criteria
- Both pages render via the shared partials with valid HTML and the three JSON-LD blocks
  parsing (verify in browser + a structured-data check).
- FAQ on-page copy matches FAQPage JSON-LD verbatim.
- Distinct titles/descriptions/H1s; no large blocks of text duplicated between the two pages
  or with the homepage.
- Both URLs present in sitemap.xml.
- Prefill CTAs land on `/#contact` and select the correct `interested_package` option.
