<?php
  $title       = 'Social Media Management in Manchester | HelloWebDesign';
  $desc        = 'Hands-on social media management for Manchester businesses - content creation, on-site filming, scheduling and community management from a husband-and-wife studio in Urmston.';
  $twitterDesc = 'Hands-on social media management for Manchester businesses - content creation, on-site filming, scheduling and community management.';
  $canonical   = 'https://hellowebdesign.co.uk/social-media-management/';
  $needsRecaptcha = false;
  $navItems    = [
    ['/',           'Home'],
    ['#included',   "What's included"],
    ['#case-study', 'Case study'],
    ['#faq',        'FAQs'],
  ];
  $ctaHref     = '/?prefill=Social%20Media%20Management#contact';
  $jsonLd      = <<<'JSONLD'
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "Social Media Management",
  "serviceType": "Social media management",
  "description": "Content creation, scheduling, community management and on-site filming for small businesses across Greater Manchester - on its own or alongside a website.",
  "url": "https://hellowebdesign.co.uk/social-media-management/",
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
    { "@type": "ListItem", "position": 2, "name": "Social Media Management", "item": "https://hellowebdesign.co.uk/social-media-management/" }
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
      "name": "Do you visit our business in person?",
      "acceptedAnswer": { "@type": "Answer", "text": "Yes - on-site filming visits are a core part of how we work. We come to you, get to know the business and capture content that feels genuine, not generic." }
    },
    {
      "@type": "Question",
      "name": "Can you manage our social media alongside building a website?",
      "acceptedAnswer": { "@type": "Answer", "text": "Yes. We offer social media management on its own or alongside a website, so everything stays consistent and under one roof." }
    },
    {
      "@type": "Question",
      "name": "How much does social media management cost?",
      "acceptedAnswer": { "@type": "Answer", "text": "It's custom-quoted around what you actually need - how often you want to post, whether you need filming visits, and which platforms you're on. The price we quote is the price you pay - no hidden fees." }
    }
  ]
}
</script>
JSONLD;
  include $_SERVER['DOCUMENT_ROOT'].'/partials/head.php';
  include $_SERVER['DOCUMENT_ROOT'].'/partials/nav.php';
?>
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
</style>
<!-- HERO -->
<header class="hero">
  <div class="wrap hero-grid">
    <div>
      <span class="eyebrow">Social Media Management · Manchester</span>
      <h1>Social media that sounds like <em>your</em> business, not a robot.</h1>
      <p class="lead">Content creation, scheduling, community management and on-site filming for small businesses across Greater Manchester - handled by two people who actually visit, so the content feels genuine.</p>
      <div class="hero-cta">
        <a href="/?prefill=Social%20Media%20Management#contact" class="btn btn-fill">Start a chat →</a>
        <a href="#case-study" class="btn btn-line">See it in action</a>
      </div>
    </div>
    <div class="hero-photo">
      <img src="/assets/desk.png" width="1800" height="1013" fetchpriority="high" alt="Hanna managing social media analytics for a client" />
    </div>
  </div>
</header>

<!-- WHAT'S INCLUDED -->
<section id="included" class="alt">
  <div class="wrap">
    <div class="sec-head">
      <span class="eyebrow">What's included</span>
      <h2>Everything handled, so you can run the business</h2>
      <p>We take the whole job off your plate - from planning what to post to replying to comments.</p>
    </div>
    <div class="feat-grid">
      <div class="feat-item"><span class="n">01</span><div><h3>Content creation &amp; on-site filming</h3><p>We visit your business, learn how it actually works and film content on location - so your feed shows the real thing, not stock photos.</p></div></div>
      <div class="feat-item"><span class="n">02</span><div><h3>Scheduling &amp; posting</h3><p>A steady, consistent flow of posts planned and published for you. No more "we haven't posted in three weeks" guilt.</p></div></div>
      <div class="feat-item"><span class="n">03</span><div><h3>Community management</h3><p>Comments and messages looked after, so followers get a reply and casual interest turns into actual enquiries.</p></div></div>
      <div class="feat-item"><span class="n">04</span><div><h3>Trend-led video &amp; editing</h3><p>Playful, on-brand video content that rides what's working right now - edited, captioned and ready to perform.</p></div></div>
    </div>
  </div>
</section>

<!-- CASE STUDY -->
<section id="case-study">
  <div class="wrap case-grid">
    <img src="/assets/proj-bbm.png" width="1795" height="1049" loading="lazy" decoding="async" alt="Bolton Builders Merchants social media content created by HelloWebDesign" />
    <div class="case-body">
      <span class="eyebrow">Case study</span>
      <h2>Bolton Builders Merchants</h2>
      <p>Ongoing social media management with a sense of humour. We create and film playful, on-brand content that grew a builders' merchant into a properly entertaining follow - racking up 13.9K+ likes.</p>
      <div class="chips"><span>Content strategy</span><span>On-site filming</span><span>Editing &amp; scheduling</span><span>Community management</span><span>Trend-led video</span></div>
      <div class="quote">
        <div class="stars">★★★★★</div>
        <p>"Having someone handle our social media who actually visits the business and understands what we do has made a massive difference. The content feels authentic, not forced."</p>
        <div class="who"><strong>Mick H</strong>Local Building Merchant</div>
      </div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section id="faq" class="alt">
  <div class="wrap">
    <div class="sec-head" style="margin-left:auto;margin-right:auto;text-align:center">
      <span class="eyebrow">FAQs</span>
      <h2>Questions, answered</h2>
    </div>
    <div class="faq">
      <div class="faq-item">
        <button class="faq-q" aria-expanded="false">Do you visit our business in person?<span class="pm"></span></button>
        <div class="faq-a"><div class="faq-a-inner"><p>Yes - on-site filming visits are a core part of how we work. We come to you, get to know the business and capture content that feels genuine, not generic.</p></div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q" aria-expanded="false">Can you manage our social media alongside building a website?<span class="pm"></span></button>
        <div class="faq-a"><div class="faq-a-inner"><p>Yes. We offer social media management on its own or alongside a website, so everything stays consistent and under one roof.</p></div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q" aria-expanded="false">How much does social media management cost?<span class="pm"></span></button>
        <div class="faq-a"><div class="faq-a-inner"><p>It's custom-quoted around what you actually need - how often you want to post, whether you need filming visits, and which platforms you're on. The price we quote is the price you pay - no hidden fees.</p></div></div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-band">
  <div class="wrap">
    <span class="eyebrow" style="color:var(--teal)">Ready when you are</span>
    <h2>Let's get your socials working for you</h2>
    <p>Drop us a message and we'll reply within 24 hours. No pressure, no hard sell - just a friendly chat about what you need.</p>
    <a href="/?prefill=Social%20Media%20Management#contact" class="btn btn-fill">Get in touch →</a>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'].'/partials/footer.php'; ?>
<a class="wa" href="https://wa.me/447816130955?text=Hi%2C%20I%20found%20you%20on%20your%20website%20and%20I%27d%20like%20to%20chat%20about%20social%20media%20management." target="_blank" rel="noopener" aria-label="Chat on WhatsApp"><svg viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163a11.867 11.867 0 01-1.587-5.946C.16 5.335 5.495 0 12.05 0a11.817 11.817 0 018.413 3.488 11.824 11.824 0 013.48 8.413c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 01-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884a9.86 9.86 0 001.515 5.26l-.999 3.648 3.973-1.042zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg></a>
