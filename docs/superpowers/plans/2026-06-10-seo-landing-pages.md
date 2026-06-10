# SEO Landing Pages Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Add two differentiated, SEO-optimised landing pages — `/web-design-manchester/` (local intent) and `/small-business-websites/` (price/audience intent) — mirroring the existing landing-page pattern, link them from the homepage, and add them to the sitemap.

**Architecture:** Each page is a single `<slug>/index.php` that sets PHP head vars, includes the shared `partials/head.php` / `partials/nav.php` / `partials/footer.php`, carries a per-page inline `<style>` block copied from an existing landing page, and renders Hero → content → FAQ → CTA. SEO comes from unique title/desc/canonical + three JSON-LD blocks (Service / BreadcrumbList / FAQPage) per page. No build step.

**Tech Stack:** Plain PHP includes, HTML, `assets/site.css` + `assets/site.js`. Local verification via PHP's built-in server (`php -S`) + Claude preview tools. No unit-test framework exists; verification is render + structured-data validation + visual check.

**Reference files (read before starting):**
- `social-media-management/index.php` — closest structural template (Hero / feat-grid / case-study / FAQ / CTA band + inline `<style>`).
- `wedding-websites/index.php` — second template example.
- `partials/head.php` — required vars: `$title`, `$desc`, `$canonical`; optional `$twitterDesc`, `$ogImage`, `$jsonLd`, `$needsRecaptcha`, `$navItems`, `$ctaHref`.
- `index.php` — source of truth for real copy/pricing/testimonials and the package-card CSS (`#packages` inline styles) needed for Task 2.

**Source-of-truth facts (do NOT invent beyond these):**
- Pricing: Starter from £499; Business/E-commerce/Wedding custom-quoted; "the price we quote is the price you pay — no hidden fees."
- Testimonial (Anoush S): *"Really impressed with the whole process. They took the time to understand what we needed and delivered a site we're genuinely proud of. Couldn't recommend them enough."* — **Anoush S, Local Pub Owner**.
- Prefill select options that MUST match `index.php` `select[name=interested_package]`: `Business Website (multi page)`, `Starter Website (one page)`.
- Real GM-area projects + images: Nailhead Properties (Manchester, `assets/proj-nailhead.png`), Manchester Flight Sim Centre (Salford, `assets/proj-flightsim.png`), HS Building Services (Greater Manchester, `assets/proj-hs-building.png`), The Farmers Arms (`assets/proj-farmers.png`), The Miners Arms (`assets/proj-miners.png`).
- Team photo: `assets/couple.png`.

---

## File Structure

- **Create** `web-design-manchester/index.php` — local-intent landing page.
- **Create** `small-business-websites/index.php` — price/audience-intent landing page.
- **Modify** `sitemap.xml` — add both URLs.
- **Modify** `index.php` — add two "Learn more →" internal links in the matching package cards.

---

## Task 0: Start the local PHP server (one-time setup)

**Files:** none.

- [ ] **Step 1: Start PHP's built-in server at the repo root**

Run (background): `php -S localhost:8000`
Expected: `PHP <ver> Development Server (http://localhost:8000) started`. The partials use `$_SERVER['DOCUMENT_ROOT']`, which `php -S` sets to the serving root, so includes resolve.

- [ ] **Step 2: Sanity-check an existing page renders**

Run: `curl -s -o NUL -w "%{http_code}" http://localhost:8000/social-media-management/`
Expected: `200`.

---

## Task 1: /web-design-manchester/ (local intent)

**Files:**
- Create: `web-design-manchester/index.php`
- Reference: `social-media-management/index.php` (copy structure + inline `<style>`)

- [ ] **Step 1: Create the file with head vars + JSON-LD**

Create `web-design-manchester/index.php` starting with this PHP block (then the head include):

```php
<?php
  $title       = 'Web Design Manchester | Local Website Designers - HelloWebDesign';
  $desc        = 'Local Manchester web design from a husband-and-wife studio in Urmston. We meet you in person, build the site ourselves and you deal with us directly - no account managers. Sites from £499.';
  $twitterDesc = 'Local Manchester web design from a husband-and-wife studio. We meet you in person and you deal with us directly. Sites from £499.';
  $canonical   = 'https://hellowebdesign.co.uk/web-design-manchester/';
  $needsRecaptcha = false;
  $navItems    = [
    ['/',         'Home'],
    ['#why',      'Why local'],
    ['#work',     'Our work'],
    ['#faq',      'FAQs'],
  ];
  $ctaHref     = '/?prefill=Business%20Website%20(multi%20page)#contact';
  $jsonLd      = <<<'JSONLD'
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "Web Design Manchester",
  "serviceType": "Web design",
  "description": "Local website design for small businesses across Greater Manchester - built in person by a husband-and-wife studio in Urmston. Sites from £499.",
  "url": "https://hellowebdesign.co.uk/web-design-manchester/",
  "areaServed": { "@type": "Place", "name": "Greater Manchester, UK" },
  "provider": {
    "@type": "ProfessionalService",
    "name": "HelloWebDesign",
    "url": "https://hellowebdesign.co.uk/",
    "telephone": "+447763648866",
    "address": {
      "@type": "PostalAddress",
      "addressLocality": "Urmston",
      "addressRegion": "Greater Manchester",
      "addressCountry": "GB"
    }
  }
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Home", "item": "https://hellowebdesign.co.uk/" },
    { "@type": "ListItem", "position": 2, "name": "Web Design Manchester", "item": "https://hellowebdesign.co.uk/web-design-manchester/" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Do you meet clients in person around Manchester?",
      "acceptedAnswer": { "@type": "Answer", "text": "Yes. We're based in Urmston and happily meet small businesses across Greater Manchester in person to talk through the project - it's how we get the detail right." }
    },
    {
      "@type": "Question",
      "name": "Which areas do you cover?",
      "acceptedAnswer": { "@type": "Answer", "text": "We work with businesses right across Greater Manchester - Manchester, Salford, Trafford, Urmston, Bolton and the surrounding towns - and remotely further afield when it suits." }
    },
    {
      "@type": "Question",
      "name": "How much does a website cost?",
      "acceptedAnswer": { "@type": "Answer", "text": "Starter sites begin at £499. Multi-page business sites are custom-quoted around what you actually need. The price we quote is the price you pay - no hidden fees." }
    }
  ]
}
</script>
JSONLD;
?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/partials/head.php'; ?>
```

- [ ] **Step 2: Copy the inline `<style>` block from the template**

From `social-media-management/index.php`, copy the entire inline `<style>…</style>` block (the hero / eyebrow / lead / feat-grid / case-grid / chips / quote / cta-band rules) verbatim into this file immediately after the head include. These classes are reused as-is; the `case-grid` rules are reused for the work grid. No new CSS is required for this page.

- [ ] **Step 3: Add the nav include + Hero**

After the `<style>` block:

```php
<?php include $_SERVER['DOCUMENT_ROOT'].'/partials/nav.php'; ?>
<!-- HERO -->
<header class="hero">
  <div class="wrap hero-grid">
    <div>
      <span class="eyebrow">Web Design · Manchester</span>
      <h1>Web design in Manchester, from two people who actually <em>pick up the phone</em>.</h1>
      <p class="lead">We're a husband-and-wife studio in Urmston building websites for small businesses across Greater Manchester. You deal with us directly - the people doing the work - and we'll happily meet you in person to get it right.</p>
      <div class="hero-cta">
        <a href="/?prefill=Business%20Website%20(multi%20page)#contact" class="btn btn-fill">Start a chat &rarr;</a>
        <a href="#work" class="btn btn-line">See our work</a>
      </div>
    </div>
    <div class="hero-photo">
      <img src="/assets/proj-nailhead.png" width="1000" height="633" fetchpriority="high" alt="Nailhead Properties website designed by HelloWebDesign in Manchester" />
    </div>
  </div>
</header>
```

> Note: confirm the real pixel dimensions of `assets/proj-nailhead.png` and set `width`/`height` to match (avoids layout shift). The values above are the homepage's; adjust if different.

- [ ] **Step 4: Add the "Why local" section**

```php
<!-- WHY LOCAL -->
<section id="why" class="alt">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Why local</span>
      <h2>A local studio, not a faceless agency</h2>
      <p>Big-brand experience, focused entirely on helping small businesses near us grow.</p>
    </div>
    <div class="feat-grid">
      <div class="feat-item"><span class="n">01</span><div><h3>We meet you in person</h3><p>Based in Urmston, we'll come and see you across Greater Manchester. It's easier to build the right thing when we've sat down together.</p></div></div>
      <div class="feat-item"><span class="n">02</span><div><h3>You deal with us directly</h3><p>No account managers, no juniors. You speak to the two people actually designing and building your site, every time.</p></div></div>
      <div class="feat-item"><span class="n">03</span><div><h3>We understand small business</h3><p>We run one ourselves, so we know the budgets and priorities - and what actually brings in customers.</p></div></div>
      <div class="feat-item"><span class="n">04</span><div><h3>Big-brand experience</h3><p>20+ years working with household names, now focused entirely on local businesses around Manchester.</p></div></div>
    </div>
  </div>
</section>
```

- [ ] **Step 5: Add the local work grid**

```php
<!-- LOCAL WORK -->
<section id="work">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Our work</span>
      <h2>Recent websites for Greater Manchester businesses</h2>
    </div>
    <div class="feat-grid">
      <div class="feat-item"><div><img src="/assets/proj-nailhead.png" width="1000" height="633" loading="lazy" decoding="async" alt="Nailhead Properties website - property investment, Manchester" style="border-radius:12px;width:100%;height:auto;margin-bottom:14px" /><h3>Nailhead Properties</h3><p>Property investment &middot; Manchester</p></div></div>
      <div class="feat-item"><div><img src="/assets/proj-flightsim.png" width="1000" height="633" loading="lazy" decoding="async" alt="Manchester Flight Sim Centre booking website, Salford" style="border-radius:12px;width:100%;height:auto;margin-bottom:14px" /><h3>Manchester Flight Sim Centre</h3><p>Booking &amp; web app &middot; Salford</p></div></div>
      <div class="feat-item"><div><img src="/assets/proj-hs-building.png" width="1000" height="633" loading="lazy" decoding="async" alt="HS Building Services website, Greater Manchester" style="border-radius:12px;width:100%;height:auto;margin-bottom:14px" /><h3>HS Building Services</h3><p>Builders &middot; Greater Manchester</p></div></div>
    </div>
  </div>
</section>
```

> Note: confirm each image's real dimensions and adjust `width`/`height` to match.

- [ ] **Step 6: Add the testimonial + FAQ + CTA band**

```php
<!-- TESTIMONIAL -->
<section class="alt">
  <div class="wrap" style="max-width:760px">
    <div class="quote">
      <div class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
      <p>"Really impressed with the whole process. They took the time to understand what we needed and delivered a site we're genuinely proud of. Couldn't recommend them enough."</p>
      <div class="who"><strong>Anoush S</strong>Local Pub Owner</div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section id="faq">
  <div class="wrap">
    <div class="sec-head" style="margin-left:auto;margin-right:auto;text-align:center">
      <span class="eyebrow">FAQs</span>
      <h2>Questions, answered</h2>
    </div>
    <div class="faq">
      <div class="faq-item">
        <button class="faq-q" aria-expanded="false">Do you meet clients in person around Manchester?<span class="pm"></span></button>
        <div class="faq-a"><div class="faq-a-inner"><p>Yes. We're based in Urmston and happily meet small businesses across Greater Manchester in person to talk through the project - it's how we get the detail right.</p></div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q" aria-expanded="false">Which areas do you cover?<span class="pm"></span></button>
        <div class="faq-a"><div class="faq-a-inner"><p>We work with businesses right across Greater Manchester - Manchester, Salford, Trafford, Urmston, Bolton and the surrounding towns - and remotely further afield when it suits.</p></div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q" aria-expanded="false">How much does a website cost?<span class="pm"></span></button>
        <div class="faq-a"><div class="faq-a-inner"><p>Starter sites begin at &pound;499. Multi-page business sites are custom-quoted around what you actually need. The price we quote is the price you pay - no hidden fees.</p></div></div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-band">
  <div class="wrap">
    <span class="eyebrow" style="color:var(--teal)">Ready when you are</span>
    <h2>Let's build your Manchester business a website</h2>
    <p>Drop us a message and we'll reply within 24 hours. No pressure, no hard sell - just a friendly chat about what you need.</p>
    <a href="/?prefill=Business%20Website%20(multi%20page)#contact" class="btn btn-fill">Get in touch &rarr;</a>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'].'/partials/footer.php'; ?>
```

Then copy the WhatsApp float `<a class="wa" …>` markup from the bottom of `social-media-management/index.php` verbatim as the final element (update the prefilled message text to mention a website).

- [ ] **Step 7: Verify the FAQ on-page copy matches the FAQPage JSON-LD verbatim**

Compare the three on-page FAQ answers (Step 6) against the three `acceptedAnswer.text` values (Step 1). They must match word-for-word (ignoring HTML entities vs unicode). Fix any drift.

- [ ] **Step 8: Render & verify the page**

Run: `curl -s -o NUL -w "%{http_code}" http://localhost:8000/web-design-manchester/`
Expected: `200`.

Then with preview tools: navigate to `http://localhost:8000/web-design-manchester/`, check `preview_console_logs` has no errors, `preview_snapshot` shows the H1 and all sections, click a FAQ item to confirm the accordion (`site.js`) works, and `preview_screenshot` desktop + mobile (`preview_resize` 390px) for proof.

- [ ] **Step 9: Validate the JSON-LD parses**

Run: `php -r "foreach (json_decode(file_get_contents('php://stdin')) as $b){} echo 'ok';" < NUL` is not reliable here; instead extract each `<script type="application/ld+json">` block and validate, e.g.:
Run: `curl -s http://localhost:8000/web-design-manchester/ | php -r '$h=stream_get_contents(STDIN); preg_match_all("/<script type=\"application\/ld\+json\">(.*?)<\/script>/s",$h,$m); foreach($m[1] as $j){ json_decode($j); echo json_last_error()===0?"OK\n":"BAD: ".json_last_error_msg()."\n"; }'`
Expected: three `OK` lines.

- [ ] **Step 10: Commit**

```bash
git add web-design-manchester/index.php
git commit -m "Add /web-design-manchester/ local-intent SEO landing page"
```

---

## Task 2: /small-business-websites/ (price + audience intent)

**Files:**
- Create: `small-business-websites/index.php`
- Reference: `social-media-management/index.php` (structure + inline `<style>`), `index.php` (`#packages` card CSS + markup)

- [ ] **Step 1: Create the file with head vars + JSON-LD**

Create `small-business-websites/index.php` starting with:

```php
<?php
  $title       = 'Small Business Websites - From £499 | HelloWebDesign';
  $desc        = 'Affordable, professional websites for small businesses - from £499. One clear price, fast turnaround and you deal directly with the husband-and-wife team who build it.';
  $twitterDesc = 'Affordable, professional websites for small businesses from £499. One clear price, fast turnaround, you deal directly with the team.';
  $canonical   = 'https://hellowebdesign.co.uk/small-business-websites/';
  $needsRecaptcha = false;
  $navItems    = [
    ['/',          'Home'],
    ['#included',  'What you get'],
    ['#packages',  'Packages'],
    ['#faq',       'FAQs'],
  ];
  $ctaHref     = '/?prefill=Starter%20Website%20(one%20page)#contact';
  $jsonLd      = <<<'JSONLD'
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "Small Business Websites",
  "serviceType": "Website design for small businesses",
  "description": "Affordable, professional websites for small businesses - one clear price, fast turnaround, built by a husband-and-wife studio. From £499.",
  "url": "https://hellowebdesign.co.uk/small-business-websites/",
  "areaServed": { "@type": "Place", "name": "United Kingdom" },
  "offers": {
    "@type": "Offer",
    "price": "499",
    "priceCurrency": "GBP",
    "description": "Starter small business websites from £499"
  },
  "provider": {
    "@type": "ProfessionalService",
    "name": "HelloWebDesign",
    "url": "https://hellowebdesign.co.uk/",
    "telephone": "+447763648866",
    "address": {
      "@type": "PostalAddress",
      "addressLocality": "Urmston",
      "addressRegion": "Greater Manchester",
      "addressCountry": "GB"
    }
  }
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    { "@type": "ListItem", "position": 1, "name": "Home", "item": "https://hellowebdesign.co.uk/" },
    { "@type": "ListItem", "position": 2, "name": "Small Business Websites", "item": "https://hellowebdesign.co.uk/small-business-websites/" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "How much does a small business website cost?",
      "acceptedAnswer": { "@type": "Answer", "text": "Starter sites begin at £499 for a one-page site. Multi-page business sites are custom-quoted around what you need. The price we quote is the price you pay - no hidden fees." }
    },
    {
      "@type": "Question",
      "name": "How long does it take?",
      "acceptedAnswer": { "@type": "Answer", "text": "A starter site is usually live within a couple of weeks once we have your content. Larger sites depend on scope - we'll give you a clear timeline before we start." }
    },
    {
      "@type": "Question",
      "name": "Is a one-page website enough for my business?",
      "acceptedAnswer": { "@type": "Answer", "text": "For many small businesses, yes - a single well-built page covering who you are, what you offer and how to get in touch does the job. If you outgrow it, we can expand it later." }
    },
    {
      "@type": "Question",
      "name": "Are there ongoing costs?",
      "acceptedAnswer": { "@type": "Answer", "text": "Only the essentials like hosting and your domain, which we'll explain up front. There are no surprise fees - the price we quote is the price you pay." }
    }
  ]
}
</script>
JSONLD;
?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/partials/head.php'; ?>
```

> Note: the `£` sequences above are literal in the JSON-LD heredoc (valid JSON unicode for £). In the PHP `$title`/`$desc`/`$twitterDesc` **string literals**, replace `£` with an actual `£` character (single-quoted PHP strings don't decode `\u`). Use `£` directly in those three vars.

- [ ] **Step 2: Copy the inline `<style>` block + add package-card CSS**

Copy the inline `<style>…</style>` block from `social-media-management/index.php`. Then, from `index.php`, copy the `#packages` / `.pkg` / `.pkg-name` / `.pkg-sub` / `.price` card rules into the same `<style>` block so the packages section renders correctly. Keep only the rules the page uses.

- [ ] **Step 3: Add nav include + Hero**

```php
<?php include $_SERVER['DOCUMENT_ROOT'].'/partials/nav.php'; ?>
<!-- HERO -->
<header class="hero">
  <div class="wrap hero-grid">
    <div>
      <span class="eyebrow">Small Business Websites</span>
      <h1>Small business websites that win you customers &mdash; <em>from &pound;499</em>.</h1>
      <p class="lead">One clear price, a fast turnaround and a site you actually own. Built by a husband-and-wife studio who run a small business too - so we get the budgets and the priorities.</p>
      <div class="hero-cta">
        <a href="/?prefill=Starter%20Website%20(one%20page)#contact" class="btn btn-fill">Start a chat &rarr;</a>
        <a href="#packages" class="btn btn-line">See packages</a>
      </div>
    </div>
    <div class="hero-photo">
      <img src="/assets/couple.png" width="1000" height="1000" fetchpriority="high" alt="Hanna and Rachid, the husband-and-wife team behind HelloWebDesign" />
    </div>
  </div>
</header>
```

> Note: confirm `assets/couple.png` real dimensions and set `width`/`height` to match.

- [ ] **Step 4: Add the "What you get" section**

```php
<!-- WHAT YOU GET -->
<section id="included" class="alt">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">What you get</span>
      <h2>Everything a small business actually needs</h2>
      <p>No bloat, no jargon - just a site that makes you look the part and brings in enquiries.</p>
    </div>
    <div class="feat-grid">
      <div class="feat-item"><span class="n">01</span><div><h3>One clear price</h3><p>You know the cost up front. The price we quote is the price you pay - no hidden fees, no surprise invoices.</p></div></div>
      <div class="feat-item"><span class="n">02</span><div><h3>Fast turnaround</h3><p>A starter site is usually live within a couple of weeks once we have your content. Get online while it matters.</p></div></div>
      <div class="feat-item"><span class="n">03</span><div><h3>You own it</h3><p>It's your site and your domain. No lock-in, no holding your business to ransom.</p></div></div>
      <div class="feat-item"><span class="n">04</span><div><h3>No jargon</h3><p>We explain things in plain English and deal with you directly - the people actually building the site.</p></div></div>
    </div>
  </div>
</section>
```

- [ ] **Step 5: Add the Packages section (price transparency)**

Reuse the package-card markup pattern from `index.php` `#packages`. Render two cards:

```php
<!-- PACKAGES -->
<section id="packages">
  <div class="wrap">
    <div class="sec-head" style="margin-left:auto;margin-right:auto;text-align:center">
      <span class="eyebrow">Packages</span>
      <h2>Simple, honest pricing</h2>
      <p>Start small and grow when you're ready.</p>
    </div>
    <div class="pkg-grid">
      <div class="pkg">
        <div class="pkg-name">Starter Site</div><div class="pkg-sub">One-page, get online fast</div><div class="price">From &pound;499</div>
        <a href="/?prefill=Starter%20Website%20(one%20page)#contact" class="btn btn-fill" data-prefill="Starter Website (one page)">Get in touch</a>
      </div>
      <div class="pkg">
        <div class="pkg-name">Business Site</div><div class="pkg-sub">Multi-page, room to grow</div><div class="price">Custom quote</div>
        <a href="/?prefill=Business%20Website%20(multi%20page)#contact" class="btn btn-line" data-prefill="Business Website (multi page)">Get in touch</a>
      </div>
    </div>
  </div>
</section>
```

> Note: match the exact wrapper class used by `index.php` for the cards (e.g. `.pkg-grid` vs the actual class name there). Read `index.php` `#packages` markup and mirror its container/class names so the copied CSS applies.

- [ ] **Step 6: Add proof (two small-business clients) + testimonial**

```php
<!-- PROOF -->
<section class="alt">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Recent work</span>
      <h2>Small businesses we've helped get online</h2>
    </div>
    <div class="feat-grid">
      <div class="feat-item"><div><img src="/assets/proj-farmers.png" width="1000" height="633" loading="lazy" decoding="async" alt="The Farmers Arms pub website by HelloWebDesign" style="border-radius:12px;width:100%;height:auto;margin-bottom:14px" /><h3>The Farmers Arms</h3><p>Country pub website</p></div></div>
      <div class="feat-item"><div><img src="/assets/proj-miners.png" width="1000" height="633" loading="lazy" decoding="async" alt="The Miners Arms pub website by HelloWebDesign" style="border-radius:12px;width:100%;height:auto;margin-bottom:14px" /><h3>The Miners Arms</h3><p>Village pub website</p></div></div>
    </div>
    <div class="quote" style="max-width:760px;margin:28px auto 0">
      <div class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
      <p>"Really impressed with the whole process. They took the time to understand what we needed and delivered a site we're genuinely proud of. Couldn't recommend them enough."</p>
      <div class="who"><strong>Anoush S</strong>Local Pub Owner</div>
    </div>
  </div>
</section>
```

> Note: confirm `proj-farmers.png` / `proj-miners.png` real dimensions and adjust `width`/`height`.

- [ ] **Step 7: Add FAQ + CTA band**

```php
<!-- FAQ -->
<section id="faq">
  <div class="wrap">
    <div class="sec-head" style="margin-left:auto;margin-right:auto;text-align:center">
      <span class="eyebrow">FAQs</span>
      <h2>Questions, answered</h2>
    </div>
    <div class="faq">
      <div class="faq-item">
        <button class="faq-q" aria-expanded="false">How much does a small business website cost?<span class="pm"></span></button>
        <div class="faq-a"><div class="faq-a-inner"><p>Starter sites begin at &pound;499 for a one-page site. Multi-page business sites are custom-quoted around what you need. The price we quote is the price you pay - no hidden fees.</p></div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q" aria-expanded="false">How long does it take?<span class="pm"></span></button>
        <div class="faq-a"><div class="faq-a-inner"><p>A starter site is usually live within a couple of weeks once we have your content. Larger sites depend on scope - we'll give you a clear timeline before we start.</p></div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q" aria-expanded="false">Is a one-page website enough for my business?<span class="pm"></span></button>
        <div class="faq-a"><div class="faq-a-inner"><p>For many small businesses, yes - a single well-built page covering who you are, what you offer and how to get in touch does the job. If you outgrow it, we can expand it later.</p></div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q" aria-expanded="false">Are there ongoing costs?<span class="pm"></span></button>
        <div class="faq-a"><div class="faq-a-inner"><p>Only the essentials like hosting and your domain, which we'll explain up front. There are no surprise fees - the price we quote is the price you pay.</p></div></div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-band">
  <div class="wrap">
    <span class="eyebrow" style="color:var(--teal)">Ready when you are</span>
    <h2>Let's get your business online</h2>
    <p>Drop us a message and we'll reply within 24 hours. No pressure, no hard sell - just a friendly chat about what you need.</p>
    <a href="/?prefill=Starter%20Website%20(one%20page)#contact" class="btn btn-fill">Get in touch &rarr;</a>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'].'/partials/footer.php'; ?>
```

Then append the WhatsApp float `<a class="wa" …>` markup (as in Task 1 Step 6), with a website-themed prefilled message.

- [ ] **Step 8: Verify FAQ on-page copy matches FAQPage JSON-LD verbatim** (same check as Task 1 Step 7, for all four Q&As).

- [ ] **Step 9: Render & verify**

Run: `curl -s -o NUL -w "%{http_code}" http://localhost:8000/small-business-websites/`
Expected: `200`.
Then preview tools: navigate, check console for errors, `preview_snapshot` for all sections incl. the two package cards rendering with correct styling, click a FAQ item, `preview_screenshot` desktop + mobile.

- [ ] **Step 10: Validate JSON-LD parses** (same curl+php one-liner as Task 1 Step 9, with the small-business URL). Expected: three `OK` lines.

- [ ] **Step 11: Commit**

```bash
git add small-business-websites/index.php
git commit -m "Add /small-business-websites/ price-intent SEO landing page"
```

---

## Task 3: Homepage internal links

**Files:**
- Modify: `index.php`

- [ ] **Step 1: Link the Manchester page from the Custom Websites service card**

In `index.php`, find the "Custom Websites" service block (around line 365, `<h3>Custom Websites</h3>`). Add a "Learn more →" link in the same inline style as the existing social-media link (`index.php:376`):

```html
<a href="/web-design-manchester/" style="color:var(--teal-deep);font-weight:600;white-space:nowrap">Web design in Manchester &rarr;</a>
```
Place it at the end of that card's `<p>`, matching the pattern at `index.php:376`.

- [ ] **Step 2: Link the small-business page from the Starter Site package card**

Find the Starter Site package card (around `index.php:414`, `<div class="pkg-name">Starter Site</div>`). Add, matching the wedding link pattern at `index.php:431`:

```html
<a href="/small-business-websites/" style="font-size:13.5px;color:var(--teal-deep);font-weight:600;margin-bottom:14px;display:inline-block">More about small business websites &rarr;</a>
```

- [ ] **Step 3: Verify the homepage still renders and links resolve**

Run: `curl -s -o NUL -w "%{http_code}" http://localhost:8000/`
Expected: `200`.
With preview tools: navigate to `http://localhost:8000/`, `preview_click` each new link, confirm it lands on the right page (`preview_snapshot` shows the correct H1).

- [ ] **Step 4: Commit**

```bash
git add index.php
git commit -m "Link new web-design-manchester and small-business-websites pages from homepage"
```

---

## Task 4: Sitemap

**Files:**
- Modify: `sitemap.xml`

- [ ] **Step 1: Add both URLs**

Add two `<url>` entries before `</urlset>`, mirroring the existing entries:

```xml
  <url>
    <loc>https://hellowebdesign.co.uk/web-design-manchester/</loc>
    <lastmod>2026-06-10</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>https://hellowebdesign.co.uk/small-business-websites/</loc>
    <lastmod>2026-06-10</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
```

- [ ] **Step 2: Verify the XML is well-formed**

Run: `php -r "echo simplexml_load_file('sitemap.xml') ? 'OK' : 'BAD';"`
Expected: `OK`.

- [ ] **Step 3: Commit**

```bash
git add sitemap.xml
git commit -m "Add new landing pages to sitemap.xml"
```

---

## Task 5: Final verification & PR

**Files:** none (verification + PR only).

- [ ] **Step 1: Full render pass**

Confirm all of these return `200`:
`curl -s -o NUL -w "%{http_code}\n" http://localhost:8000/web-design-manchester/`
`curl -s -o NUL -w "%{http_code}\n" http://localhost:8000/small-business-websites/`
`curl -s -o NUL -w "%{http_code}\n" http://localhost:8000/`

- [ ] **Step 2: Differentiation check**

Confirm the two new pages share no large duplicated copy block with each other or with the homepage hero (distinct H1, lead, section copy). Eyeball the rendered snapshots.

- [ ] **Step 3: Push the branch and open a PR — then STOP**

```bash
git push -u origin feat/seo-landing-pages
gh pr create --title "Add two SEO landing pages (web-design-manchester, small-business-websites)" --body "<summary + screenshots>"
```

Per CLAUDE.md: **do NOT merge.** Open the PR and wait for the user's explicit go-ahead for this specific PR before squash-merging (which deploys live).

---

## Self-Review (completed during planning)

- **Spec coverage:** Page 1 (Task 1), Page 2 (Task 2), homepage links (Task 3), sitemap (Task 4), final verification + PR-not-merge (Task 5). All spec sections covered.
- **Placeholders:** Full copy + full JSON-LD provided for both pages; no TBDs. Image `width`/`height` are flagged as "confirm real dimensions" — a deliberate, actionable verification step, not a content placeholder.
- **Consistency:** Prefill values (`Business Website (multi page)`, `Starter Website (one page)`) match `index.php`'s select options. FAQ on-page copy is duplicated verbatim into FAQPage JSON-LD with an explicit match-check step in each page task. Nav anchors (`#why`/`#work`/`#faq`, `#included`/`#packages`/`#faq`) match the section IDs used in each page.
- **Known follow-up (out of scope):** per-page OG images still fall back to shared `og-image.jpg`.
