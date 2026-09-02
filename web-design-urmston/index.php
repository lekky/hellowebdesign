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
    <div class="hero-photo crop">
      <picture><source type="image/avif" srcset="/assets/proj-nailhead-480.avif 480w, /assets/proj-nailhead-800.avif 800w, /assets/proj-nailhead-1000.avif 1000w" sizes="(max-width:880px) 100vw, 45vw" /><source type="image/webp" srcset="/assets/proj-nailhead-480.webp 480w, /assets/proj-nailhead-800.webp 800w, /assets/proj-nailhead-1000.webp 1000w" sizes="(max-width:880px) 100vw, 45vw" /><img src="/assets/proj-nailhead-1000.jpg" width="1000" height="515" fetchpriority="high" alt="Nailhead Properties website designed by HelloWebDesign for a Greater Manchester business" /></picture>
    </div>
  </div>
</header>

<!-- WHY LOCAL -->
<section id="why" class="alt" aria-labelledby="why-h">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Why local</span>
      <h2 id="why-h">A local studio, not a faceless agency</h2>
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
<section id="work" aria-labelledby="work-h">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">Our work</span>
      <h2 id="work-h">Recent websites for Greater Manchester businesses</h2>
    </div>
    <div class="work-grid cols-3">
      <div class="work-card"><picture><source type="image/avif" srcset="/assets/proj-nailhead-480.avif 480w, /assets/proj-nailhead-800.avif 800w, /assets/proj-nailhead-1000.avif 1000w" sizes="(max-width:880px) 100vw, 33vw" /><source type="image/webp" srcset="/assets/proj-nailhead-480.webp 480w, /assets/proj-nailhead-800.webp 800w, /assets/proj-nailhead-1000.webp 1000w" sizes="(max-width:880px) 100vw, 33vw" /><img src="/assets/proj-nailhead-1000.jpg" width="1000" height="515" loading="lazy" decoding="async" alt="Nailhead Properties website - property investment, Greater Manchester" /></picture><h3>Nailhead Properties</h3><p>Property investment &middot; Manchester</p></div>
      <div class="work-card"><picture><source type="image/avif" srcset="/assets/proj-flightsim-480.avif 480w, /assets/proj-flightsim-612.avif 612w" sizes="(max-width:880px) 100vw, 33vw" /><source type="image/webp" srcset="/assets/proj-flightsim-480.webp 480w, /assets/proj-flightsim-612.webp 612w" sizes="(max-width:880px) 100vw, 33vw" /><img src="/assets/proj-flightsim-612.jpg" width="612" height="400" loading="lazy" decoding="async" alt="Manchester Flight Sim Centre booking website, Salford" /></picture><h3>Manchester Flight Sim Centre</h3><p>Booking &amp; web app &middot; Salford</p></div>
      <div class="work-card"><picture><source type="image/avif" srcset="/assets/proj-hs-building-480.avif 480w, /assets/proj-hs-building-800.avif 800w, /assets/proj-hs-building-1200.avif 1200w" sizes="(max-width:880px) 100vw, 33vw" /><source type="image/webp" srcset="/assets/proj-hs-building-480.webp 480w, /assets/proj-hs-building-800.webp 800w, /assets/proj-hs-building-1200.webp 1200w" sizes="(max-width:880px) 100vw, 33vw" /><img src="/assets/proj-hs-building-1200.jpg" width="1590" height="861" loading="lazy" decoding="async" alt="HS Building Services website, Greater Manchester" /></picture><h3>HS Building Services</h3><p>Builders &middot; Greater Manchester</p></div>
    </div>
  </div>
</section>

<!-- TESTIMONIAL -->
<section class="alt" aria-label="What clients say">
  <div class="wrap narrow">
    <div class="quote">
      <div class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
      <p>"Really impressed with the whole process. They took the time to understand what we needed and delivered a site we're genuinely proud of. Couldn't recommend them enough."</p>
      <div class="who"><strong>Anoush S</strong><span>Local Pub Owner</span></div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section id="faq" aria-labelledby="faq-h">
  <div class="wrap">
    <div class="sec-head center">
      <span class="eyebrow">FAQs</span>
      <h2 id="faq-h">Questions, answered</h2>
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

<!-- NEARBY AREAS -->
<section class="nearby alt" aria-labelledby="nearby-h">
  <div class="wrap">
    <span class="eyebrow">Nearby areas</span>
    <h2 id="nearby-h">Web design near Urmston</h2>
    <p>We're based in Urmston and cover the whole of Greater Manchester - these are the towns closest to Urmston that we also have dedicated pages for.</p>
    <ul class="nearby-list">
      <li><a href="/web-design-sale/">Sale</a></li>
      <li><a href="/web-design-altrincham/">Altrincham</a></li>
      <li><a href="/web-design-stockport/">Stockport</a></li>
      <li><a href="/web-design-salford/">Salford</a></li>
      <li><a href="/web-design-manchester/">Manchester</a></li>
      <li><a class="hub" href="/web-design-greater-manchester/">All of Greater Manchester &rarr;</a></li>
    </ul>
  </div>
</section>

<!-- CTA -->
<section class="cta-band" aria-labelledby="cta-h">
  <div class="wrap">
    <span class="eyebrow">Ready when you are</span>
    <h2 id="cta-h">Let's build your Urmston business a website</h2>
    <p>Drop us a message and we'll reply within 24 hours. No pressure, no hard sell - just a friendly chat about what you need.</p>
    <a href="/?prefill=Business%20Website%20(multi%20page)#contact" class="btn btn-fill">Get in touch &rarr;</a>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'].'/partials/footer.php'; ?>
<a class="wa" href="https://wa.me/447816130955?text=Hi%2C%20I%20found%20you%20on%20your%20website%20and%20I%27d%20like%20to%20chat%20about%20a%20website." target="_blank" rel="noopener" aria-label="Chat on WhatsApp"><svg viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163a11.867 11.867 0 01-1.587-5.946C.16 5.335 5.495 0 12.05 0a11.817 11.817 0 018.413 3.488 11.824 11.824 0 013.48 8.413c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 01-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884a9.86 9.86 0 001.515 5.26l-.999 3.648 3.973-1.042zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg></a>
