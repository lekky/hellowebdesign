<?php
  $title       = 'Wedding Websites - From £499 | HelloWebDesign';
  $desc        = 'A beautiful wedding website for your big day - RSVP form, schedule, venue and travel info and a photo gallery, all in one place for your guests. From £499.';
  $twitterDesc = 'A beautiful wedding website for your big day - RSVP form, schedule, venue and travel info and a photo gallery, all in one place for your guests.';
  $canonical   = 'https://hellowebdesign.co.uk/wedding-websites/';
  $needsRecaptcha = false;
  $navItems    = [
    ['/',         'Home'],
    ['#included', "What's included"],
    ['#example',  'Example'],
    ['#faq',      'FAQs'],
  ];
  $ctaHref     = '/?prefill=Wedding%20Website#contact';
  $jsonLd      = <<<'JSONLD'
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "Wedding Websites",
  "serviceType": "Wedding website design",
  "description": "A personal wedding website to share the day with guests - the schedule, location, accommodation and an easy RSVP, wrapped in a warm, romantic look. From £499.",
  "url": "https://hellowebdesign.co.uk/wedding-websites/",
  "areaServed": { "@type": "Place", "name": "United Kingdom" },
  "offers": {
    "@type": "Offer",
    "price": "499",
    "priceCurrency": "GBP",
    "description": "Wedding websites from £499"
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
    { "@type": "ListItem", "position": 2, "name": "Wedding Websites", "item": "https://hellowebdesign.co.uk/wedding-websites/" }
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
      "name": "What's included in a wedding website?",
      "acceptedAnswer": { "@type": "Answer", "text": "A beautiful site designed around your day - an RSVP form, your schedule, venue and travel information and a custom photo gallery, all in one place for your guests." }
    },
    {
      "@type": "Question",
      "name": "Can guests RSVP through the website?",
      "acceptedAnswer": { "@type": "Answer", "text": "Yes - an RSVP form is built in, so guests can reply in seconds and you keep track of everything in one place instead of chasing texts and paper cards." }
    },
    {
      "@type": "Question",
      "name": "How much does a wedding website cost?",
      "acceptedAnswer": { "@type": "Answer", "text": "Wedding websites start from £499, designed around what you actually need. The price we quote is the price you pay - no hidden fees." }
    }
  ]
}
</script>
JSONLD;
  include $_SERVER['DOCUMENT_ROOT'].'/partials/head.php';
  include $_SERVER['DOCUMENT_ROOT'].'/partials/nav.php';
?>
<!-- HERO -->
<header class="hero">
  <div class="wrap hero-grid">
    <div>
      <span class="hero-price">From £499</span>
      <h1>Your big day, beautifully <em>online</em>.</h1>
      <p class="lead">A personal wedding website that gives your guests everything in one place - the schedule, the venue, where to stay and an easy RSVP - wrapped in a warm, romantic design that's unmistakably yours.</p>
      <div class="hero-cta">
        <a href="/?prefill=Wedding%20Website#contact" class="btn btn-fill">Start yours →</a>
        <a href="#example" class="btn btn-line">See an example</a>
      </div>
    </div>
    <div class="hero-photo framed">
      <picture><source type="image/avif" srcset="/assets/proj-savethedate-480.avif 480w, /assets/proj-savethedate-800.avif 800w, /assets/proj-savethedate-1000.avif 1000w" sizes="(max-width:880px) 100vw, 45vw" /><source type="image/webp" srcset="/assets/proj-savethedate-480.webp 480w, /assets/proj-savethedate-800.webp 800w, /assets/proj-savethedate-1000.webp 1000w" sizes="(max-width:880px) 100vw, 45vw" /><img src="/assets/proj-savethedate-1000.jpg" width="1000" height="633" fetchpriority="high" alt="Save the Date - a wedding website designed by HelloWebDesign" /></picture>
    </div>
  </div>
</header>

<!-- WHAT'S INCLUDED -->
<section id="included" class="alt" aria-labelledby="included-h">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">What's included</span>
      <h2 id="included-h">Everything your guests need, in one place</h2>
      <p>No more fielding the same questions a hundred times - point everyone to one beautiful link.</p>
    </div>
    <div class="feat-grid">
      <div class="feat-item"><span class="n">01</span><div><h3>Easy RSVP form</h3><p>Guests reply in seconds and you keep track of everything in one place - no more chasing texts and paper cards.</p></div></div>
      <div class="feat-item"><span class="n">02</span><div><h3>Schedule &amp; venue info</h3><p>The running order of the day, the venue, directions and travel info - so everyone knows where to be and when.</p></div></div>
      <div class="feat-item"><span class="n">03</span><div><h3>Accommodation &amp; travel</h3><p>Recommended places to stay and how to get there, especially handy for guests travelling from afar.</p></div></div>
      <div class="feat-item"><span class="n">04</span><div><h3>Photo gallery &amp; gift list</h3><p>A custom gallery of your favourite photos, plus space for your gift list or honeymoon fund details.</p></div></div>
    </div>
  </div>
</section>

<!-- EXAMPLE -->
<section id="example" aria-labelledby="example-h">
  <div class="wrap case-grid">
    <picture><source type="image/avif" srcset="/assets/proj-savethedate-480.avif 480w, /assets/proj-savethedate-800.avif 800w, /assets/proj-savethedate-1000.avif 1000w" sizes="(max-width:880px) 100vw, 50vw" /><source type="image/webp" srcset="/assets/proj-savethedate-480.webp 480w, /assets/proj-savethedate-800.webp 800w, /assets/proj-savethedate-1000.webp 1000w" sizes="(max-width:880px) 100vw, 50vw" /><img src="/assets/proj-savethedate-1000.jpg" width="1000" height="633" loading="lazy" decoding="async" alt="Save the Date wedding website - schedule, location and RSVP in one place" /></picture>
    <div class="case-body">
      <span class="eyebrow">Recent wedding site</span>
      <h2 id="example-h">Save the Date</h2>
      <p>A personal one-page wedding site to share the day with guests - the schedule, location, accommodation and an easy RSVP, wrapped in a warm, romantic look.</p>
      <div class="chips"><span>RSVP form</span><span>Schedule &amp; location</span><span>Photo gallery</span><span>Gift list</span></div>
      <div class="quote">
        <div class="stars">★★★★★</div>
        <p>"Our wedding website was amazing, made it so easy for our guests and us having everything all in one place."</p>
        <div class="who"><strong>Hassan OE</strong><span>Wedding Website</span></div>
      </div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section id="faq" class="alt" aria-labelledby="faq-h">
  <div class="wrap">
    <div class="sec-head center">
      <span class="eyebrow">FAQs</span>
      <h2 id="faq-h">Questions, answered</h2>
    </div>
    <div class="faq">
      <div class="faq-item">
        <button class="faq-q" aria-expanded="false">What's included in a wedding website?<span class="pm"></span></button>
        <div class="faq-a"><div class="faq-a-inner"><p>A beautiful site designed around your day - an RSVP form, your schedule, venue and travel information and a custom photo gallery, all in one place for your guests.</p></div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q" aria-expanded="false">Can guests RSVP through the website?<span class="pm"></span></button>
        <div class="faq-a"><div class="faq-a-inner"><p>Yes - an RSVP form is built in, so guests can reply in seconds and you keep track of everything in one place instead of chasing texts and paper cards.</p></div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q" aria-expanded="false">How much does a wedding website cost?<span class="pm"></span></button>
        <div class="faq-a"><div class="faq-a-inner"><p>Wedding websites start from £499, designed around what you actually need. The price we quote is the price you pay - no hidden fees.</p></div></div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-band" aria-labelledby="cta-h">
  <div class="wrap">
    <span class="eyebrow">Congratulations, by the way</span>
    <h2 id="cta-h">Let's build your wedding website</h2>
    <p>Tell us about your day and we'll reply within 24 hours. No pressure, no hard sell - just a friendly chat.</p>
    <a href="/?prefill=Wedding%20Website#contact" class="btn btn-fill">Get in touch →</a>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'].'/partials/footer.php'; ?>
<a class="wa" href="https://wa.me/447816130955?text=Hi%2C%20I%20found%20you%20on%20your%20website%20and%20I%27d%20like%20to%20chat%20about%20a%20wedding%20website." target="_blank" rel="noopener" aria-label="Chat on WhatsApp"><svg viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163a11.867 11.867 0 01-1.587-5.946C.16 5.335 5.495 0 12.05 0a11.817 11.817 0 018.413 3.488 11.824 11.824 0 013.48 8.413c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 01-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884a9.86 9.86 0 001.515 5.26l-.999 3.648 3.973-1.042zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg></a>
