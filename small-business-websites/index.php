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
<style>
.btn-line:hover{background:var(--charcoal);color:var(--paper)}
/* HERO */
  .hero{padding:70px 0 90px}
.hero h1{font-size:clamp(40px,5.4vw,66px);margin:18px 0 24px}
.hero p.lead{font-size:19px;color:var(--muted);max-width:44ch;margin-bottom:32px}
.hero-photo img{width:100%;height:auto;border-radius:14px;aspect-ratio:4/3;object-fit:cover;box-shadow:0 30px 60px -28px rgba(23,63,58,.45)}
.alt{background:var(--paper-2)}
/* feature grid */
  .feat-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:40px 56px}
.feat-item{display:flex;gap:20px}
.feat-item .n{font-family:var(--serif);font-size:30px;color:var(--teal-deep);font-style:italic;line-height:1;flex-shrink:0}
.feat-item h3{font-size:21px;margin-bottom:8px}
.feat-item p{color:var(--muted);font-size:15.5px}
@media(max-width:720px){.feat-grid{grid-template-columns:1fr}}
/* case study */
  .case-grid{display:grid;grid-template-columns:1.05fr .95fr;gap:56px;align-items:center}
.case-grid img{width:100%;height:auto;border-radius:14px;border:1.5px solid #d6ccb6;box-shadow:0 24px 44px -28px rgba(0,0,0,.45)}
.case-body h2{font-size:clamp(28px,3.6vw,42px);margin:14px 0 18px}
.case-body p{color:#46433c;font-size:16.5px;margin-bottom:16px}
.chips{display:flex;gap:8px;flex-wrap:wrap;margin:20px 0 26px}
.chips span{background:var(--paper);border:1px solid var(--line);border-radius:999px;padding:7px 15px;font-size:13px;font-weight:500;color:var(--teal-ink)}
.quote{background:#fff;border:1px solid var(--line);border-radius:14px;padding:26px;margin-top:8px}
.quote .stars{color:var(--teal);letter-spacing:3px;margin-bottom:12px;font-size:14px}
.quote p{font-family:var(--serif);font-size:18px;font-style:italic;line-height:1.45;color:#2e2b25;margin-bottom:14px}
@media(max-width:880px){.case-grid{grid-template-columns:1fr;gap:36px}}
/* CTA band */
  .cta-band{background:var(--charcoal-3);color:var(--paper);text-align:center}
.cta-band h2{color:var(--paper);font-size:clamp(30px,4vw,46px);margin:14px 0 18px}
.cta-band p{color:#b7b2a6;max-width:46ch;margin:0 auto 30px;font-size:17px}
.cta-band .btn-fill{background:var(--teal);color:#0c2a26}
.cta-band .btn-fill:hover{background:#fff;color:#0c2a26}
.foot-top{display:flex;justify-content:space-between;gap:40px;flex-wrap:wrap;padding-bottom:34px;border-top:1px solid #36393e;border-bottom:1px solid #36393e;padding-top:34px}
/* packages (ported from homepage) */
.pkg-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:18px;max-width:680px;margin:0 auto}
.pkg{background:#fff;border:1px solid var(--line);border-radius:16px;padding:28px 24px;display:flex;flex-direction:column;transition:transform .25s,box-shadow .25s}
.pkg:hover{transform:translateY(-5px);box-shadow:0 26px 50px -32px rgba(0,0,0,.35)}
.pkg.feat{background:var(--charcoal);color:var(--paper);border-color:var(--charcoal);position:relative}
.pkg .pkg-name{font-family:var(--serif);font-size:22px;margin-bottom:4px}
.pkg .pkg-sub{font-size:13px;color:var(--muted);margin-bottom:18px}
.pkg.feat .pkg-sub{color:#aecfca}
.pkg .price{font-family:var(--serif);font-size:34px;color:var(--teal-deep);margin-bottom:18px}
.pkg.feat .price{color:var(--teal)}
.pkg ul{list-style:none;display:flex;flex-direction:column;gap:10px;margin-bottom:24px;flex:1}
.pkg li{font-size:14px;display:flex;gap:9px;color:#46433c}
.pkg.feat li{color:#dce7e4}
.pkg li::before{content:"";width:16px;height:16px;border-radius:50%;background:var(--teal);flex-shrink:0;margin-top:3px;
    -webkit-mask:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='black' d='M9 16.2 4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4z'/%3E%3C/svg%3E") center/12px no-repeat;
    mask:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='black' d='M9 16.2 4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4z'/%3E%3C/svg%3E") center/12px no-repeat}
.pkg .btn{justify-content:center;font-size:14px;padding:12px}
.pkg.feat .btn-fill{background:var(--teal);color:#0c2a26}
.pkg.feat .btn-fill:hover{background:#fff;color:#0c2a26}
.feat-badge{position:absolute;top:-12px;left:50%;transform:translateX(-50%);background:var(--teal);color:#0c2a26;font-size:11px;font-weight:700;letter-spacing:.12em;text-transform:uppercase;padding:5px 13px;border-radius:999px;white-space:nowrap}
/* work cards (same as web-design-manchester) */
.work-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:24px;max-width:760px;margin:8px auto 0}
.work-card img{width:100%;aspect-ratio:16/10;object-fit:cover;border-radius:12px;display:block;margin-bottom:12px}
.work-card h3{font-size:18px;margin-bottom:2px}
.work-card p{color:var(--muted);font-size:14px}
@media(max-width:560px){.pkg-grid{grid-template-columns:1fr}.work-grid{grid-template-columns:1fr}}
</style>
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
      <img src="/assets/couple.png" width="2399" height="1800" fetchpriority="high" alt="Hanna and Rachid, the husband-and-wife team behind HelloWebDesign" />
    </div>
  </div>
</header>

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
        <ul><li>Single-page design</li><li>Mobile responsive</li><li>Contact form included</li><li>Live within a couple of weeks</li></ul>
        <a href="/?prefill=Starter%20Website%20(one%20page)#contact" class="btn btn-line" data-prefill="Starter Website (one page)">Get in touch</a>
      </div>
      <div class="pkg feat">
        <span class="feat-badge">Most popular</span><div class="pkg-name">Business Site</div><div class="pkg-sub">Multi-page, room to grow</div><div class="price">Custom</div>
        <ul><li>Multi-page website</li><li>Custom design</li><li>Advanced SEO setup</li><li>Google integration</li></ul>
        <a href="/?prefill=Business%20Website%20(multi%20page)#contact" class="btn btn-fill" data-prefill="Business Website (multi page)">Start your project</a>
      </div>
    </div>
  </div>
</section>

<!-- PROOF -->
<section class="alt">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Recent work</span>
      <h2>Small businesses we've helped get online</h2>
    </div>
    <div class="work-grid">
      <div class="work-card"><img src="/assets/proj-farmers.png" width="1000" height="515" loading="lazy" decoding="async" alt="The Farmers Arms pub website by HelloWebDesign" /><h3>The Farmers Arms</h3><p>Country pub website</p></div>
      <div class="work-card"><img src="/assets/proj-miners.png" width="1000" height="633" loading="lazy" decoding="async" alt="The Miners Arms pub website by HelloWebDesign" /><h3>The Miners Arms</h3><p>Village pub website</p></div>
    </div>
    <div class="quote" style="max-width:760px;margin:28px auto 0">
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
<a class="wa" href="https://wa.me/447816130955?text=Hi%2C%20I%20found%20you%20on%20your%20website%20and%20I%27d%20like%20to%20chat%20about%20a%20small%20business%20website." target="_blank" rel="noopener" aria-label="Chat on WhatsApp"><svg viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163a11.867 11.867 0 01-1.587-5.946C.16 5.335 5.495 0 12.05 0a11.817 11.817 0 018.413 3.488 11.824 11.824 0 013.48 8.413c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 01-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884a9.86 9.86 0 001.515 5.26l-.999 3.648 3.973-1.042zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg></a>
