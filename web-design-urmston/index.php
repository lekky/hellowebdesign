<?php
  $title       = 'Web Design Urmston | Local Website Designers - HelloWebDesign';
  $desc        = 'Local Urmston web design from a husband-and-wife studio in Urmston. We meet you in person, build the site ourselves and you deal with us directly - no account managers. Sites from £499.';
  $twitterDesc = 'Local Urmston web design from a husband-and-wife studio. We meet you in person and you deal with us directly. Sites from £499.';
  $canonical   = 'https://hellowebdesign.co.uk/web-design-urmston/';
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
  "name": "Web Design Urmston",
  "serviceType": "Web design",
  "description": "Local website design for small businesses across Urmston and Greater Manchester - built in person by a husband-and-wife studio in Urmston. Sites from £499.",
  "url": "https://hellowebdesign.co.uk/web-design-urmston/",
  "areaServed": { "@type": "Place", "name": "Urmston, Greater Manchester, UK" },
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
    { "@type": "ListItem", "position": 2, "name": "Web Design Greater Manchester", "item": "https://hellowebdesign.co.uk/web-design-greater-manchester/" },
    { "@type": "ListItem", "position": 3, "name": "Web Design Urmston", "item": "https://hellowebdesign.co.uk/web-design-urmston/" }
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
      "name": "Do you meet clients in person around Urmston?",
      "acceptedAnswer": { "@type": "Answer", "text": "Of course - Urmston is our home town. We'll happily meet local businesses in person whenever it helps, which is how we get the detail right." }
    },
    {
      "@type": "Question",
      "name": "Which areas do you cover?",
      "acceptedAnswer": { "@type": "Answer", "text": "We're an Urmston studio working right across Greater Manchester - Urmston, Trafford, Stretford, Sale, Manchester and the surrounding towns - and remotely further afield when it suits." }
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
<style>
.btn-line:hover{background:var(--charcoal);color:var(--paper)}
/* HERO */
  .hero{padding:70px 0 90px}
.hero h1{font-size:clamp(40px,5.4vw,66px);margin:18px 0 24px}
.hero p.lead{font-size:19px;color:var(--muted);max-width:44ch;margin-bottom:32px}
.hero-photo img{width:100%;height:auto;border-radius:14px;aspect-ratio:4/3;object-fit:cover;box-shadow:0 30px 60px -28px rgba(23,63,58,.45)}
.areas-back{margin-top:24px;font-size:14px}
.areas-back a{color:var(--teal-deep);font-weight:600;text-decoration:none;border-bottom:1px solid transparent}
.areas-back a:hover{border-bottom-color:var(--teal-deep)}
.alt{background:var(--paper-2)}
/* feature grid */
  .feat-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:40px 56px}
.feat-item{display:flex;gap:20px}
.feat-item .n{font-family:var(--serif);font-size:30px;color:var(--teal-deep);font-style:italic;line-height:1;flex-shrink:0}
.feat-item h3{font-size:21px;margin-bottom:8px}
.feat-item p{color:var(--muted);font-size:15.5px}
@media(max-width:720px){.feat-grid{grid-template-columns:1fr}}
/* work grid */
  .work-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-top:8px}
.work-card img{width:100%;height:auto;aspect-ratio:16/10;object-fit:cover;border-radius:12px;display:block;margin-bottom:12px}
.work-card h3{font-size:18px;margin-bottom:2px}
.work-card p{color:var(--muted);font-size:14px}
@media(max-width:880px){.work-grid{grid-template-columns:1fr}}
/* CTA band */
  .cta-band{background:var(--charcoal-3);color:var(--paper);text-align:center}
.cta-band h2{color:var(--paper);font-size:clamp(30px,4vw,46px);margin:14px 0 18px}
.cta-band p{color:#b7b2a6;max-width:46ch;margin:0 auto 30px;font-size:17px}
.cta-band .btn-fill{background:var(--teal);color:#0c2a26}
.cta-band .btn-fill:hover{background:#fff;color:#0c2a26}
.foot-top{display:flex;justify-content:space-between;gap:40px;flex-wrap:wrap;padding-bottom:34px;border-top:1px solid #36393e;border-bottom:1px solid #36393e;padding-top:34px}
</style>
<?php include $_SERVER['DOCUMENT_ROOT'].'/partials/nav.php'; ?>
<!-- HERO -->
<header class="hero">
  <div class="wrap hero-grid">
    <div>
      <span class="eyebrow">Web Design &middot; Urmston</span>
      <h1>Web design in Urmston, from two people who actually <em>pick up the phone</em>.</h1>
      <p class="lead">We're a husband-and-wife studio right here in Urmston, building websites for our home town's small businesses. You deal with us directly - the two people doing the work - and we can meet you in person whenever you like.</p>
      <div class="hero-cta">
        <a href="/?prefill=Business%20Website%20(multi%20page)#contact" class="btn btn-fill">Start a chat &rarr;</a>
        <a href="#work" class="btn btn-line">See our work</a>
      </div>
      <p class="areas-back"><a href="/web-design-greater-manchester/">&larr; See all the areas we cover across Greater Manchester</a></p>
    </div>
    <div class="hero-photo">
      <img src="/assets/proj-nailhead.png" width="1000" height="515" fetchpriority="high" alt="Nailhead Properties website designed by HelloWebDesign for a Greater Manchester business" />
    </div>
  </div>
</header>

<!-- WHY LOCAL -->
<section id="why" class="alt">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Why local</span>
      <h2>A local studio, not a faceless agency</h2>
      <p>Big-brand experience, focused entirely on helping small businesses near us grow.</p>
    </div>
    <div class="feat-grid">
      <div class="feat-item"><span class="n">01</span><div><h3>We meet you in person</h3><p>This is our home town - we're an Urmston studio through and through, so you genuinely can't get more local. We'll meet you in person whenever it helps.</p></div></div>
      <div class="feat-item"><span class="n">02</span><div><h3>You deal with us directly</h3><p>No account managers, no juniors. You speak to the two people actually designing and building your site, every time.</p></div></div>
      <div class="feat-item"><span class="n">03</span><div><h3>We understand small business</h3><p>We run one ourselves, so we know the budgets and priorities - and what actually brings in customers.</p></div></div>
      <div class="feat-item"><span class="n">04</span><div><h3>Big-brand experience</h3><p>20+ years working with household names, now focused entirely on local businesses around Urmston and Greater Manchester.</p></div></div>
    </div>
  </div>
</section>

<!-- LOCAL WORK -->
<section id="work">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Our work</span>
      <h2>Recent websites for Greater Manchester businesses</h2>
    </div>
    <div class="work-grid">
      <div class="work-card"><img src="/assets/proj-nailhead.png" width="1000" height="515" loading="lazy" decoding="async" alt="Nailhead Properties website - property investment, Greater Manchester" /><h3>Nailhead Properties</h3><p>Property investment &middot; Manchester</p></div>
      <div class="work-card"><img src="/assets/proj-flightsim.png" width="612" height="400" loading="lazy" decoding="async" alt="Manchester Flight Sim Centre booking website, Salford" /><h3>Manchester Flight Sim Centre</h3><p>Booking &amp; web app &middot; Salford</p></div>
      <div class="work-card"><img src="/assets/proj-hs-building.png" width="1590" height="861" loading="lazy" decoding="async" alt="HS Building Services website, Greater Manchester" /><h3>HS Building Services</h3><p>Builders &middot; Greater Manchester</p></div>
    </div>
  </div>
</section>

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
        <button class="faq-q" aria-expanded="false">Do you meet clients in person around Urmston?<span class="pm"></span></button>
        <div class="faq-a"><div class="faq-a-inner"><p>Of course - Urmston is our home town. We'll happily meet local businesses in person whenever it helps, which is how we get the detail right.</p></div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q" aria-expanded="false">Which areas do you cover?<span class="pm"></span></button>
        <div class="faq-a"><div class="faq-a-inner"><p>We're an Urmston studio working right across Greater Manchester - Urmston, Trafford, Stretford, Sale, Manchester and the surrounding towns - and remotely further afield when it suits.</p></div></div>
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
    <h2>Let's build your Urmston business a website</h2>
    <p>Drop us a message and we'll reply within 24 hours. No pressure, no hard sell - just a friendly chat about what you need.</p>
    <a href="/?prefill=Business%20Website%20(multi%20page)#contact" class="btn btn-fill">Get in touch &rarr;</a>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'].'/partials/footer.php'; ?>
<a class="wa" href="https://wa.me/447816130955?text=Hi%2C%20I%20found%20you%20on%20your%20website%20and%20I%27d%20like%20to%20chat%20about%20a%20website." target="_blank" rel="noopener" aria-label="Chat on WhatsApp"><svg viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163a11.867 11.867 0 01-1.587-5.946C.16 5.335 5.495 0 12.05 0a11.817 11.817 0 018.413 3.488 11.824 11.824 0 013.48 8.413c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 01-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884a9.86 9.86 0 001.515 5.26l-.999 3.648 3.973-1.042zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg></a>
