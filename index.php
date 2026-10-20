<?php
  $title       = 'HelloWebDesign - Web Design &amp; Social Media in Urmston';
  $desc        = 'Husband-and-wife web design and social media studio in Urmston, helping small businesses across Manchester get online - personal, jargon-free, within a week.';
  $canonical   = 'https://hellowebdesign.co.uk/';
  $needsRecaptcha = true;
  $preloadHero = true;
  $navItems    = [
    ['/#how',      'How it works'],
    ['/#work',     'Work'],
    ['/#services', 'Services'],
    ['/#packages', 'Pricing'],
  ];
  $ctaHref     = '/#contact';
  $ctaLabel    = 'Message us';
  $jsonLd      = <<<'JSONLD'
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ProfessionalService",
  "name": "HelloWebDesign",
  "description": "A husband-and-wife web design and social media studio in Urmston, helping small businesses across Manchester build their online presence.",
  "url": "https://hellowebdesign.co.uk/",
  "logo": "https://hellowebdesign.co.uk/assets/logo.png",
  "image": "https://hellowebdesign.co.uk/assets/og-image.jpg",
  "email": "contact@hellowebdesign.co.uk",
  "telephone": "+447763648866",
  "priceRange": "££",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "Urmston",
    "addressRegion": "Greater Manchester",
    "addressCountry": "GB"
  },
  "areaServed": { "@type": "Place", "name": "Greater Manchester, UK" },
  "founder": [
    { "@type": "Person", "name": "Hanna" },
    { "@type": "Person", "name": "Rachid" }
  ],
  "sameAs": [
    "https://www.instagram.com/hellowebdesignco/",
    "https://www.facebook.com/hello.web.design.uk/"
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
      "name": "How quickly can my site go live?",
      "acceptedAnswer": { "@type": "Answer", "text": "Simple one-page starter sites can be live within a week. Multi-page, e-commerce and bespoke builds take a little longer - we'll agree a clear timeline with you before we start." }
    },
    {
      "@type": "Question",
      "name": "How much will it cost?",
      "acceptedAnswer": { "@type": "Answer", "text": "Starter sites begin at £499. Business, e-commerce and wedding sites are custom-quoted around what you actually need. The price we quote is the price you pay - no hidden fees." }
    },
    {
      "@type": "Question",
      "name": "Who will I actually be working with?",
      "acceptedAnswer": { "@type": "Answer", "text": "Us - Hanna and Rachid - directly, from the first chat through to launch. No account managers, no juniors, no handoffs." }
    },
    {
      "@type": "Question",
      "name": "Do you only work with businesses in Manchester?",
      "acceptedAnswer": { "@type": "Answer", "text": "We're based in Urmston and work with businesses across Greater Manchester and beyond. Most of the work is done remotely, with on-site visits when they help." }
    },
    {
      "@type": "Question",
      "name": "Do you handle social media as well as websites?",
      "acceptedAnswer": { "@type": "Answer", "text": "Yes. We offer social media management - content creation, scheduling, community management and on-site filming - on its own or alongside a website." }
    },
    {
      "@type": "Question",
      "name": "I already have a website - can you redesign it?",
      "acceptedAnswer": { "@type": "Answer", "text": "Definitely. Whether you want a complete rebuild or to improve what you've already got, just tell us what's not working and we'll take it from there." }
    }
  ]
}
</script>
JSONLD;
  include $_SERVER['DOCUMENT_ROOT'].'/partials/head.php';
  include $_SERVER['DOCUMENT_ROOT'].'/partials/nav.php';
?>
<main id="main">
<style>
/* Homepage one-offs. Everything shared (reveal, work/service/pricing cards, quotes,
   contact form, modals, footer, to-top) lives in /assets/site.css. */

/* --- hero: "Hi, we're Hanna and Rachid" + quick form, photo with floating review card --- */
.hero{position:relative;overflow:hidden;padding:64px 0 88px}
.hero-grid{align-items:flex-start}
.hero h1{font-size:clamp(46px,6vw,80px);margin:18px 0 20px}
.hero p.lead{max-width:46ch;margin-bottom:28px}
.hero-cta{margin-bottom:30px}
.hero-cta .btn svg{width:18px;height:18px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
.quick{background:#fff;border:1.5px solid #d6ccb6;border-radius:16px;padding:22px 24px 24px;box-shadow:0 24px 44px -32px rgba(23,63,58,.45);display:flex;flex-direction:column;gap:14px;max-width:560px}
.quick-head{display:flex;justify-content:space-between;align-items:baseline;gap:12px;flex-wrap:wrap}
.quick-head strong{font-family:var(--serif);font-weight:500;font-size:22px}
.quick-head span{font-size:13px;color:var(--teal-text);font-weight:600}
.quick-row{display:flex;gap:12px;flex-wrap:wrap}
.quick-row>div{flex:1 1 180px}
.quick label{display:block;font-size:13.5px;font-weight:500;margin-bottom:6px}
.quick input{width:100%;min-height:44px;background:var(--paper);border:1px solid var(--line);border-radius:10px;padding:10px 14px;color:var(--ink);font-family:var(--sans);font-size:16px}
.quick input:focus{border-color:var(--teal-deep);background:#fff}
.quick input::placeholder{color:var(--muted);opacity:.7}
.quick .btn{width:100%;border:0;cursor:pointer}
.hero-photo .frame{width:100%;height:auto;border-radius:14px;aspect-ratio:4/5;object-fit:cover;box-shadow:0 30px 60px -28px rgba(23,63,58,.45)}
.hero-photo{isolation:isolate}
.hero-photo::before{content:"";position:absolute;inset:22px -22px -22px 22px;border:1.5px solid var(--teal);border-radius:14px;opacity:.6;z-index:-1}
.hero-photo picture{display:block;will-change:transform}
.hero-review{position:absolute;left:-28px;bottom:36px;max-width:340px;margin:0;background:var(--paper);border:1px solid var(--line);border-radius:12px;padding:18px 20px;box-shadow:0 16px 30px -18px rgba(0,0,0,.3);animation:floaty 6s ease-in-out infinite}
.hero-review .stars{color:var(--teal-deep);letter-spacing:2px;font-size:13px;margin-bottom:6px}
.hero-review blockquote{margin:0 0 8px;font-family:var(--serif);font-style:italic;font-size:17px;line-height:1.4;color:#2e2b25}
.hero-review figcaption{font-size:13px;color:var(--muted)}
.hero-review figcaption strong{color:var(--ink)}
@keyframes floaty{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
/* headline arrives word by word (spans added by JS; without JS the h1 reveals as one block) */
.hero h1.split{opacity:1;transform:none}
.hero h1 .w{display:inline-block;opacity:0;transform:translateY(.35em);filter:blur(5px);animation:wordIn .75s cubic-bezier(.22,.61,.36,1) forwards;animation-delay:calc(var(--i) * 75ms + 120ms)}
@keyframes wordIn{to{opacity:1;transform:none;filter:blur(0)}}
@media(max-width:880px){.hero-review{left:12px;bottom:16px;max-width:calc(100% - 24px)}.hero-photo::before{inset:16px -12px -12px 16px}}

/* --- promises row --- */
.promises{background:var(--paper-2);border-top:1px solid var(--line);border-bottom:1px solid var(--line);padding:40px 0}
.promise-grid{display:flex;flex-wrap:wrap;gap:24px}
.promise{flex:1 1 220px;display:flex;gap:14px;align-items:flex-start}
.promise .ic{width:44px;height:44px;border-radius:12px;background:#fff;border:1px solid var(--line);display:flex;align-items:center;justify-content:center;flex-shrink:0;color:var(--teal-deep)}
.promise .ic svg{width:22px;height:22px;fill:none;stroke:currentColor;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
.promise strong{display:block;font-size:15.5px}
.promise span{font-size:14px;color:var(--muted)}

/* --- what happens next (timeline) --- */
.timeline{display:flex;flex-wrap:wrap;border-top:1.5px solid var(--teal-deep)}
.step{flex:1 1 240px;padding:28px 28px 0 0;position:relative}
.step::before{content:"";position:absolute;top:-8px;left:0;width:14px;height:14px;border-radius:50%;background:var(--teal-deep);border:3px solid var(--paper)}
.step.last::before{background:var(--teal)}
.step small{font-size:12px;letter-spacing:.18em;text-transform:uppercase;color:var(--teal-text);font-weight:700}
.step h3{font-size:24px;margin:8px 0}
.step p{font-size:15.5px;color:var(--muted)}

/* --- work: one big tile + three side tiles, the rest behind a toggle --- */
.work-grid{grid-template-columns:repeat(3,1fr)}
.wc.wc-feat{grid-column:1/3;grid-row:1/4}
.wc.wc-feat .wc-shot{aspect-ratio:auto;flex:1;min-height:0}
.wc.wc-feat .wc-body{padding:18px 22px 20px}
.wc.wc-feat h3{font-size:24px}
.wc.wc-side{flex-direction:row;min-height:150px}
.wc.wc-side .wc-shot{width:42%;flex-shrink:0;aspect-ratio:auto;border-bottom:0;border-right:1px solid var(--line)}
.wc.wc-side .wc-body{flex:1}
.work-grid:not(.show-all) .wc:nth-child(n+5){display:none}
.work-more-wrap{display:flex}
@media(max-width:900px){
  .work-grid{grid-template-columns:repeat(2,1fr)}
  .wc.wc-feat{grid-column:1/-1;grid-row:auto}
  .wc.wc-feat .wc-shot{aspect-ratio:16/10;flex:none}
  .wc.wc-side{flex-direction:column;min-height:0}
  .wc.wc-side .wc-shot{width:auto;aspect-ratio:16/10;border-right:0;border-bottom:1px solid var(--line)}
}
@media(max-width:520px){.work-grid{grid-template-columns:1fr}}

/* --- pricing comparison table --- */
.cmp-wrap{overflow-x:auto;background:#fff;border:1px solid var(--line);border-radius:16px}
.cmp{border-collapse:collapse;width:100%;min-width:720px}
.cmp th,.cmp td{text-align:left;padding:14px 18px;border-bottom:1px solid var(--line);font-size:14.5px;vertical-align:top}
.cmp thead th{background:var(--paper-2);border-bottom:1px solid #d6ccb6;vertical-align:bottom}
.cmp thead th:first-child{width:26%}
.cmp tbody th{font-weight:600;color:var(--ink)}
.cmp .plan{display:block;font-family:var(--serif);font-weight:500;font-size:22px}
.cmp .cost{display:block;font-family:var(--serif);font-weight:500;font-size:28px;color:var(--teal-deep);font-variant-numeric:tabular-nums}
.cmp .pop{background:var(--charcoal);color:var(--paper)}
.cmp .pop .cost{color:var(--teal)}
.cmp .pop .feat-badge{position:static;transform:none;display:inline-block;margin-bottom:6px}
.cmp td.hi{background:#fbfaf7}
.cmp tr:last-child th,.cmp tr:last-child td{border-bottom:0}
.cmp .btn{font-size:14px;padding:11px 18px}
.cmp-note{text-align:center;font-size:14px;color:var(--muted);margin-top:20px}
/* phones: the table scrolls sideways; keep the row labels pinned and say so */
.cmp-hint{display:none;font-size:13px;color:var(--muted);text-align:right;margin:0 0 8px}
@media(max-width:760px){
  .cmp-hint{display:block}
  .cmp tbody th,.cmp thead th:first-child{position:sticky;left:0;z-index:1;background:#fff;box-shadow:1px 0 0 var(--line)}
  .cmp thead th:first-child{background:var(--paper-2)}
}
.addons{margin-top:18px}

/* --- faq: heading left, accordion right --- */
.faq-grid{display:flex;gap:56px;flex-wrap:wrap}
.faq-grid .sec-head{flex:1 1 300px;margin-bottom:0}
.faq-grid .faq{flex:1.4 1 480px;max-width:none;margin:0}
.faq-grid .sec-head .btn{margin-top:8px}

/* --- contact: three ways to talk --- */
.talk{display:flex;flex-direction:column;gap:12px;margin-top:4px}
.talk a{display:block;background:var(--charcoal-2);border:1px solid #41454a;border-radius:14px;padding:18px 20px;color:var(--paper);transition:border-color .2s,transform .2s}
.talk a:hover{border-color:var(--teal);transform:translateY(-2px)}
.talk small{display:block;font-size:12px;letter-spacing:.16em;text-transform:uppercase;color:var(--teal);margin-bottom:4px}
.talk b{display:block;font-family:var(--serif);font-weight:400;font-size:20px}
.talk span{font-size:13.5px;color:#b7b2a6}

@media(prefers-reduced-motion:reduce){
  .hero-review{animation:none}
  .hero h1 .w{animation:none;opacity:1;transform:none;filter:none}
  .hero-photo picture{transform:none!important}
  .talk a:hover{transform:none}
}
</style>

<!-- HERO -->
<header class="hero" id="about">
  <div class="wrap hero-grid">
    <div>
      <span class="eyebrow reveal" style="display:inline-flex;align-items:center;gap:12px"><span style="width:26px;height:1.5px;background:var(--teal-deep)"></span>Urmston, Manchester</span>
      <h1 class="reveal d1">Hi, we're <em>Hanna</em> and <em>Rachid</em>.</h1>
      <p class="lead reveal d2">We build websites and run social media for small businesses across Manchester. When you get in touch, you talk to us. When we build your site, we build it. No account managers, ever.</p>
      <div class="hero-cta reveal d3">
        <a href="https://wa.me/447816130955?text=Hi%2C%20I%20found%20you%20on%20your%20website%20and%20I%27d%20like%20to%20chat%20about%20a%20project." class="btn btn-fill" target="_blank" rel="noopener"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21 11.5a8.4 8.4 0 0 1-9 8.4L3 21l1.1-3.3A8.4 8.4 0 1 1 21 11.5z"/></svg>WhatsApp us</a>
        <a href="tel:07763648866" class="btn btn-line"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.4 1.8.7 2.7a2 2 0 0 1-.5 2.1L8 9.8a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.7.7a2 2 0 0 1 1.7 2z"/></svg>Call Hanna 07763 648866</a>
      </div>
      <form method="POST" action="send.php" class="quick reveal d4" id="quickForm" data-recaptcha aria-label="Quick enquiry">
        <div class="quick-head"><strong>Or tell us what you need</strong><span>We reply within 24 hours</span></div>
        <div class="quick-row">
          <div><label for="q-name">Your name *</label><input type="text" id="q-name" name="name" autocomplete="name" required aria-required="true" /></div>
          <div><label for="q-email">Email *</label><input type="email" id="q-email" name="email" autocomplete="email" required aria-required="true" /></div>
        </div>
        <div><label for="q-msg">What do you need? One line is fine.</label><input type="text" id="q-msg" name="message" placeholder="e.g. a one-page site for my café" /></div>
        <input type="hidden" name="interested_package" value="Quick enquiry (homepage)" />
        <input type="hidden" name="g-recaptcha-response" />
        <button type="submit" class="btn btn-fill">Send to Hanna &amp; Rachid →</button>
      </form>
    </div>
    <div class="hero-photo reveal d2">
      <picture><source type="image/avif" srcset="assets/couple-480.avif 480w, assets/couple-800.avif 800w, assets/couple-1200.avif 1200w" sizes="(max-width:880px) 100vw, 45vw" /><source type="image/webp" srcset="assets/couple-480.webp 480w, assets/couple-800.webp 800w, assets/couple-1200.webp 1200w" sizes="(max-width:880px) 100vw, 45vw" /><img class="frame" width="2399" height="1800" fetchpriority="high" alt="Hanna and Rachid, the husband-and-wife team behind HelloWebDesign in Urmston" src="assets/couple-1200.jpg" /></picture>
      <figure class="hero-review">
        <div class="stars" aria-hidden="true">★★★★★</div>
        <blockquote>“They took the time to understand what we needed and delivered a site we're genuinely proud of.”</blockquote>
        <figcaption><strong>Anoush S</strong> · Local pub owner</figcaption>
      </figure>
    </div>
  </div>
</header>

<!-- PROMISES -->
<section class="promises" aria-label="Our promises">
  <div class="wrap promise-grid">
    <div class="promise reveal"><span class="ic"><svg viewBox="0 0 24 24"><path d="M12 2 4 5v6c0 5 3.4 9.4 8 11 4.6-1.6 8-6 8-11V5z"/><path d="m9 12 2 2 4-4"/></svg></span><div><strong>No hidden fees</strong><span>The price we quote is the price you pay.</span></div></div>
    <div class="promise reveal d1"><span class="ic"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></span><div><strong>Live within a week</strong><span>For one-page starter sites.</span></div></div>
    <div class="promise reveal d2"><span class="ic"><svg viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.9M16 3.1a4 4 0 0 1 0 7.8"/></svg></span><div><strong>A direct line to us</strong><span>Two people, start to finish.</span></div></div>
    <div class="promise reveal d3"><span class="ic"><svg viewBox="0 0 24 24"><path d="M3 17l6-6 4 4 8-8"/><path d="M14 7h7v7"/></svg></span><div><strong>20+ years with big brands</strong><span>Next, Iceland, Pets at Home, SimplyBe.</span></div></div>
  </div>
</section>

<!-- WHAT HAPPENS NEXT -->
<section id="how" aria-labelledby="how-title">
  <div class="wrap">
    <div class="sec-head reveal">
      <span class="eyebrow">What happens next</span>
      <h2 id="how-title">From your message to a live site</h2>
      <p>No mystery, no waiting around. This is what the next couple of weeks look like.</p>
    </div>
    <div class="timeline">
      <div class="step reveal"><small>Today</small><h3>You get a reply from one of us</h3><p>Within 24 hours, from Hanna or Rachid. We'll ask a couple of questions and suggest a time to talk.</p></div>
      <div class="step reveal d1"><small>This week</small><h3>A 20-minute chat and a fixed quote</h3><p>Phone, video or a visit if that helps. You get a clear price and timeline in writing. No obligation.</p></div>
      <div class="step reveal d2"><small>Next week</small><h3>Your starter site goes live</h3><p>One-page sites are live within a week of go-ahead. Bigger builds get a timeline we agree up front.</p></div>
      <div class="step last reveal d3"><small>After that</small><h3>We're still here</h3><p>Optional care plans from £19 a month keep it secure, backed up and updated. Or look after it yourself. Both are fine.</p></div>
    </div>
  </div>
</section>

<!-- SERVICES -->
<section id="services" class="alt" aria-labelledby="services-title">
  <div class="wrap">
    <div class="sec-head reveal">
      <span class="eyebrow">What we do</span>
      <h2 id="services-title">Everything you need to get online</h2>
      <p>From a simple one-page site to a full shop and ongoing social media - all under one roof.</p>
    </div>
    <div class="svc-list">
      <div class="svc reveal">
        <span class="ic"><svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="14" rx="2"/><path d="M3 8h18M7 21h10"/></svg></span>
        <h3>Custom Websites</h3>
        <p>Beautiful, responsive sites built to showcase your business and turn visitors into customers - from single-page builds to multi-page. <a href="/web-design-manchester/" class="link-teal nowrap">Web design in Manchester →</a></p>
      </div>
      <div class="svc reveal">
        <span class="ic"><svg viewBox="0 0 24 24"><path d="M3 4h2l2.4 12.2a2 2 0 0 0 2 1.6h7.7a2 2 0 0 0 2-1.5L21 8H6"/><circle cx="9" cy="20" r="1"/><circle cx="18" cy="20" r="1"/></svg></span>
        <h3>E-Commerce</h3>
        <p>Ready to sell online? We set up your shop with product management, secure payments and everything you need to take orders.</p>
      </div>
      <div class="svc reveal">
        <span class="ic"><svg viewBox="0 0 24 24"><path d="M21 11.5a8.4 8.4 0 0 1-9 8.4L3 21l1.1-3.3A8.4 8.4 0 1 1 21 11.5z"/><path d="M8 11h.01M12 11h.01M16 11h.01"/></svg></span>
        <h3>Social Media Management</h3>
        <p>Content creation, scheduling, community management and on-site filming visits. You focus on running the business. <a href="/social-media-management/" class="link-teal nowrap">Learn more →</a></p>
      </div>
      <div class="svc reveal">
        <span class="ic"><svg viewBox="0 0 24 24"><rect x="7" y="2" width="10" height="20" rx="2"/><path d="M11 18h2"/></svg></span>
        <h3>Bespoke Web &amp; Mobile Apps</h3>
        <p>Need more than a standard site? We build custom web and mobile applications around how your business actually works.</p>
      </div>
    </div>
  </div>
</section>

<!-- WORK -->
<section id="work" class="work" aria-labelledby="work-title">
  <div class="wrap">
    <div class="sec-head reveal">
      <span class="eyebrow">Things we've made</span>
      <h2 id="work-title">Local businesses we've helped get online</h2>
      <p>A selection of sites, apps and social media we've designed, built and launched. Tap any project to see what we did.</p>
    </div>
    <div class="work-grid" id="work-grid">
      <button class="wc wc-feat reveal" data-project="flok" aria-haspopup="dialog"><div class="wc-shot"><span class="badge-new">New</span><picture><source type="image/avif" srcset="assets/proj-flok-480.avif 480w, assets/proj-flok-800.avif 800w, assets/proj-flok-1200.avif 1200w" sizes="(max-width:900px) 100vw, 55vw" /><source type="image/webp" srcset="assets/proj-flok-480.webp 480w, assets/proj-flok-800.webp 800w, assets/proj-flok-1200.webp 1200w" sizes="(max-width:900px) 100vw, 55vw" /><img loading="lazy" decoding="async" alt="FLÓK Medical Aesthetics" src="assets/proj-flok-1200.jpg" /></picture></div><div class="wc-body"><div class="wc-meta"><span class="wc-cat">Website · Brand</span><h3>FLÓK Medical Aesthetics</h3></div><span class="arr">↗</span></div></button>
      <button class="wc wc-side reveal d1" data-project="farmers" aria-haspopup="dialog"><div class="wc-shot"><picture><source type="image/avif" srcset="assets/proj-farmers-480.avif 480w, assets/proj-farmers-800.avif 800w, assets/proj-farmers-1000.avif 1000w" sizes="(max-width:520px) 100vw, (max-width:900px) 50vw, 15vw" /><source type="image/webp" srcset="assets/proj-farmers-480.webp 480w, assets/proj-farmers-800.webp 800w, assets/proj-farmers-1000.webp 1000w" sizes="(max-width:520px) 100vw, (max-width:900px) 50vw, 15vw" /><img loading="lazy" decoding="async" alt="The Farmers Arms" src="assets/proj-farmers-1000.jpg" /></picture></div><div class="wc-body"><div class="wc-meta"><span class="wc-cat">Country pub</span><h3>The Farmers Arms</h3></div><span class="arr">↗</span></div></button>
      <button class="wc wc-side reveal d2" data-project="bbm" aria-haspopup="dialog"><div class="wc-shot"><picture><source type="image/avif" srcset="assets/proj-bbm-480.avif 480w, assets/proj-bbm-800.avif 800w, assets/proj-bbm-1200.avif 1200w" sizes="(max-width:520px) 100vw, (max-width:900px) 50vw, 15vw" /><source type="image/webp" srcset="assets/proj-bbm-480.webp 480w, assets/proj-bbm-800.webp 800w, assets/proj-bbm-1200.webp 1200w" sizes="(max-width:520px) 100vw, (max-width:900px) 50vw, 15vw" /><img loading="lazy" decoding="async" alt="Bolton Builders Merchants social media" src="assets/proj-bbm-1200.jpg" /></picture></div><div class="wc-body"><div class="wc-meta"><span class="wc-cat">Social media</span><h3>Bolton Builders Merchants</h3></div><span class="arr">↗</span></div></button>
      <button class="wc wc-side reveal d3" data-project="savethedate" aria-haspopup="dialog"><div class="wc-shot"><picture><source type="image/avif" srcset="assets/proj-savethedate-480.avif 480w, assets/proj-savethedate-800.avif 800w, assets/proj-savethedate-1000.avif 1000w" sizes="(max-width:520px) 100vw, (max-width:900px) 50vw, 15vw" /><source type="image/webp" srcset="assets/proj-savethedate-480.webp 480w, assets/proj-savethedate-800.webp 800w, assets/proj-savethedate-1000.webp 1000w" sizes="(max-width:520px) 100vw, (max-width:900px) 50vw, 15vw" /><img loading="lazy" decoding="async" alt="Save the Date wedding website" src="assets/proj-savethedate-1000.jpg" /></picture></div><div class="wc-body"><div class="wc-meta"><span class="wc-cat">Wedding website</span><h3>Save the Date</h3></div><span class="arr">↗</span></div></button>
      <button class="wc reveal" data-project="nailhead" aria-haspopup="dialog"><div class="wc-shot"><picture><source type="image/avif" srcset="assets/proj-nailhead-480.avif 480w, assets/proj-nailhead-800.avif 800w, assets/proj-nailhead-1000.avif 1000w" sizes="(max-width:520px) 100vw, (max-width:900px) 50vw, 33vw" /><source type="image/webp" srcset="assets/proj-nailhead-480.webp 480w, assets/proj-nailhead-800.webp 800w, assets/proj-nailhead-1000.webp 1000w" sizes="(max-width:520px) 100vw, (max-width:900px) 50vw, 33vw" /><img loading="lazy" decoding="async" alt="Nailhead Properties" src="assets/proj-nailhead-1000.jpg" /></picture></div><div class="wc-body"><div class="wc-meta"><span class="wc-cat">Website</span><h3>Nailhead Properties</h3></div><span class="arr">↗</span></div></button>
      <button class="wc reveal d1" data-project="flightsim" aria-haspopup="dialog"><div class="wc-shot"><picture><source type="image/avif" srcset="assets/proj-flightsim-480.avif 480w, assets/proj-flightsim-612.avif 612w" sizes="(max-width:520px) 100vw, (max-width:900px) 50vw, 33vw" /><source type="image/webp" srcset="assets/proj-flightsim-480.webp 480w, assets/proj-flightsim-612.webp 612w" sizes="(max-width:520px) 100vw, (max-width:900px) 50vw, 33vw" /><img loading="lazy" decoding="async" alt="Manchester Flight Sim Centre" src="assets/proj-flightsim-612.jpg" /></picture></div><div class="wc-body"><div class="wc-meta"><span class="wc-cat">Booking · Web App</span><h3>Manchester Flight Sim Centre</h3></div><span class="arr">↗</span></div></button>
      <button class="wc reveal d2" data-project="hs" aria-haspopup="dialog"><div class="wc-shot"><picture><source type="image/avif" srcset="assets/proj-hs-building-480.avif 480w, assets/proj-hs-building-800.avif 800w, assets/proj-hs-building-1200.avif 1200w" sizes="(max-width:520px) 100vw, (max-width:900px) 50vw, 33vw" /><source type="image/webp" srcset="assets/proj-hs-building-480.webp 480w, assets/proj-hs-building-800.webp 800w, assets/proj-hs-building-1200.webp 1200w" sizes="(max-width:520px) 100vw, (max-width:900px) 50vw, 33vw" /><img loading="lazy" decoding="async" alt="HS Building Services" src="assets/proj-hs-building-1200.jpg" /></picture></div><div class="wc-body"><div class="wc-meta"><span class="wc-cat">Website</span><h3>HS Building Services</h3></div><span class="arr">↗</span></div></button>
      <button class="wc reveal" data-project="fennec" aria-haspopup="dialog"><div class="wc-shot"><picture><source type="image/avif" srcset="assets/proj-fennec-480.avif 480w, assets/proj-fennec-800.avif 800w, assets/proj-fennec-1000.avif 1000w" sizes="(max-width:520px) 100vw, (max-width:900px) 50vw, 33vw" /><source type="image/webp" srcset="assets/proj-fennec-480.webp 480w, assets/proj-fennec-800.webp 800w, assets/proj-fennec-1000.webp 1000w" sizes="(max-width:520px) 100vw, (max-width:900px) 50vw, 33vw" /><img loading="lazy" decoding="async" alt="Fennec Consulting" src="assets/proj-fennec-1000.jpg" /></picture></div><div class="wc-body"><div class="wc-meta"><span class="wc-cat">Website</span><h3>Fennec Consulting</h3></div><span class="arr">↗</span></div></button>
      <button class="wc reveal d1" data-project="miners" aria-haspopup="dialog"><div class="wc-shot"><picture><source type="image/avif" srcset="assets/proj-miners-480.avif 480w, assets/proj-miners-800.avif 800w, assets/proj-miners-1000.avif 1000w" sizes="(max-width:520px) 100vw, (max-width:900px) 50vw, 33vw" /><source type="image/webp" srcset="assets/proj-miners-480.webp 480w, assets/proj-miners-800.webp 800w, assets/proj-miners-1000.webp 1000w" sizes="(max-width:520px) 100vw, (max-width:900px) 50vw, 33vw" /><img loading="lazy" decoding="async" alt="The Miners Arms" src="assets/proj-miners-1000.jpg" /></picture></div><div class="wc-body"><div class="wc-meta"><span class="wc-cat">Website</span><h3>The Miners Arms</h3></div><span class="arr">↗</span></div></button>
    </div>
    <div class="work-more-wrap">
      <button class="btn btn-line" id="work-toggle" aria-expanded="false" aria-controls="work-grid">Show all projects ↓</button>
    </div>
  </div>
</section>

<!-- REVIEWS -->
<section id="reviews" aria-labelledby="testimonials-title">
  <div class="wrap">
    <div class="sec-head center reveal">
      <span class="eyebrow">Reviews</span>
      <h2 id="testimonials-title">What our clients say</h2>
    </div>
    <div class="quotes">
      <div class="quote reveal"><div class="stars">★★★★★</div><p>"Really impressed with the whole process. They took the time to understand what we needed and delivered a site we're genuinely proud of. Couldn't recommend them enough."</p><div class="who"><strong>Anoush S</strong><span>Local Pub Owner</span></div></div>
      <div class="quote reveal d1"><div class="stars">★★★★★</div><p>"Having someone handle our social media who actually visits the business and understands what we do has made a massive difference. The content feels authentic, not forced."</p><div class="who"><strong>Mick H</strong><span>Local Building Merchant</span></div></div>
      <div class="quote reveal d2"><div class="stars">★★★★★</div><p>"Our wedding website was amazing, made it so easy for our guests and us having everything all in one place."</p><div class="who"><strong>Hassan OE</strong><span>Wedding Website</span></div></div>
    </div>
  </div>
</section>

<!-- PACKAGES -->
<section id="packages" class="alt" aria-labelledby="packages-title">
  <div class="wrap">
    <div class="sec-head center reveal">
      <span class="eyebrow">Pricing</span>
      <h2 id="packages-title">Compare the packages</h2>
      <p>The price we quote is the price you pay. Wedding websites also start from £499.</p>
    </div>
    <p class="cmp-hint" aria-hidden="true">Swipe to compare →</p>
    <div class="cmp-wrap reveal">
      <table class="cmp">
        <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col"><span class="plan">Starter Site</span><span class="cost">From £499</span></th>
            <th scope="col" class="pop"><span class="feat-badge">Most popular</span><span class="plan">Business Pro</span><span class="cost">Custom quote</span></th>
            <th scope="col"><span class="plan">E-Commerce</span><span class="cost">Custom quote</span></th>
          </tr>
        </thead>
        <tbody>
          <tr><th scope="row">Pages</th><td>One page</td><td class="hi">Multi-page</td><td>Shop + pages</td></tr>
          <tr><th scope="row">Design</th><td>Clean layout, your branding</td><td class="hi">Fully custom</td><td>Fully custom</td></tr>
          <tr><th scope="row">Mobile responsive</th><td>✓</td><td class="hi">✓</td><td>✓</td></tr>
          <tr><th scope="row">Contact form</th><td>✓</td><td class="hi">✓</td><td>✓</td></tr>
          <tr><th scope="row">SEO setup</th><td>Basics</td><td class="hi">Advanced + Google integration</td><td>Advanced + Google integration</td></tr>
          <tr><th scope="row">Secure payments &amp; orders</th><td>—</td><td class="hi">—</td><td>✓ Product catalogue &amp; order management</td></tr>
          <tr><th scope="row">Typical time to live</th><td>Within a week</td><td class="hi">Agreed up front</td><td>Agreed up front</td></tr>
          <tr>
            <th scope="row"></th>
            <td><a href="#contact" class="btn btn-line" data-prefill="Starter Website (one page)">Get in touch</a></td>
            <td class="hi"><a href="#contact" class="btn btn-fill" data-prefill="Business Website (multi page)">Start your project</a></td>
            <td><a href="#contact" class="btn btn-line" data-prefill="E-Commerce / Online Shop">Get in touch</a></td>
          </tr>
        </tbody>
      </table>
    </div>
    <p class="cmp-note">Not sure which one? <a href="#contact" class="link-teal">Tell us what you need</a> and we'll suggest the right fit. <a href="/small-business-websites/" class="link-teal">More about small business websites →</a></p>
    <div class="addons reveal">
      <button type="button" data-prefill="Wedding Website">+ Wedding Websites</button><button type="button" data-prefill="Social Media Management">+ Social Media Management</button><button type="button" data-prefill="Web / Mobile Application">+ Web &amp; Mobile Apps</button><button type="button" data-prefill="Something else">+ Something else</button>
    </div>
  </div>
</section>

<!-- CARE PLANS -->
<section id="care-plans" style="background:#e7f1ef" aria-labelledby="care-plans-title">
  <div class="wrap">
    <div class="sec-head center reveal">
      <span class="eyebrow">Care Plans</span>
      <h2 id="care-plans-title">After launch, we've got your back</h2>
      <p>Your website kept secure, updated and online - so you can get on with running your business.</p>
    </div>
    <div class="care-grid">
      <div class="pkg reveal">
        <div class="pkg-name">Essentials</div><div class="pkg-sub">Peace of mind, handled</div><div class="price">&pound;19<span class="per">/mo</span></div>
        <ul><li>Secure hosting &amp; domain renewal</li><li>SSL certificate + daily backups</li><li>Software &amp; security updates</li><li>Uptime monitoring</li><li>Email support</li></ul>
        <a href="#contact" class="btn btn-line" data-prefill="Care Plan - Essentials">Get started</a>
      </div>
      <div class="pkg feat reveal d1">
        <span class="feat-badge">Most popular</span><div class="pkg-name">Complete</div><div class="pkg-sub">We keep it fresh for you</div><div class="price">&pound;49<span class="per">/mo</span></div>
        <ul><li>Everything in Essentials, plus:</li><li>Up to 1 hour of edits each month</li><li>Priority support</li><li>Monthly performance check</li><li>Seasonal tweaks &amp; updates</li></ul>
        <a href="#contact" class="btn btn-fill" data-prefill="Care Plan - Complete">Get started</a>
      </div>
    </div>
    <p class="care-note">No contracts - cancel any time.</p>
  </div>
</section>

<!-- FAQ -->
<section id="faq" aria-labelledby="faq-title">
  <div class="wrap faq-grid">
    <div class="sec-head reveal from-left">
      <span class="eyebrow">Before you ask</span>
      <h2 id="faq-title">The things people usually want to know</h2>
      <p>Anything else, just ask. That's what the chat is for.</p>
      <a href="#contact" class="btn btn-line">Ask us something</a>
    </div>
    <div class="faq reveal d1">
      <div class="faq-item">
        <button class="faq-q" aria-expanded="false">How quickly can my site go live?<span class="pm"></span></button>
        <div class="faq-a"><div class="faq-a-inner"><p>Simple one-page starter sites can be live within a week. Multi-page, e-commerce and bespoke builds take a little longer - we'll agree a clear timeline with you before we start.</p></div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q" aria-expanded="false">How much will it cost?<span class="pm"></span></button>
        <div class="faq-a"><div class="faq-a-inner"><p>Starter sites begin at £499. Business, e-commerce and wedding sites are custom-quoted around what you actually need. The price we quote is the price you pay - no hidden fees.</p></div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q" aria-expanded="false">Who will I actually be working with?<span class="pm"></span></button>
        <div class="faq-a"><div class="faq-a-inner"><p>Us - Hanna and Rachid - directly, from the first chat through to launch. No account managers, no juniors, no handoffs.</p></div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q" aria-expanded="false">Do you only work with businesses in Manchester?<span class="pm"></span></button>
        <div class="faq-a"><div class="faq-a-inner"><p>We're based in Urmston and work with businesses across Greater Manchester and beyond. Most of the work is done remotely, with on-site visits when they help.</p></div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q" aria-expanded="false">Do you handle social media as well as websites?<span class="pm"></span></button>
        <div class="faq-a"><div class="faq-a-inner"><p>Yes. We offer social media management - content creation, scheduling, community management and on-site filming - on its own or alongside a website.</p></div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q" aria-expanded="false">I already have a website - can you redesign it?<span class="pm"></span></button>
        <div class="faq-a"><div class="faq-a-inner"><p>Definitely. Whether you want a complete rebuild or to improve what you've already got, just tell us what's not working and we'll take it from there.</p></div></div>
      </div>
      <div class="faq-item">
        <button class="faq-q" aria-expanded="false">What happens after my site goes live?<span class="pm"></span></button>
        <div class="faq-a"><div class="faq-a-inner"><p>We don't disappear once you're online. Our optional care plans keep your site secure, backed up and updated - and the Complete plan includes an hour of changes each month. There's no obligation: plenty of clients look after their own site, and that's fine too.</p></div></div>
      </div>
    </div>
  </div>
</section>

<!-- CONTACT -->
<section id="contact" class="contact" aria-labelledby="contact-title">
  <div class="wrap ct-grid">
    <div class="ct-info reveal from-left">
      <span class="eyebrow">Prefer to talk?</span>
      <h2 class="h2-sm" id="contact-title">Pick whichever is easiest for you</h2>
      <p>No pressure, no hard sell. Just a friendly chat about what you're after. We reply within 24 hours.</p>
      <div class="talk">
        <a href="https://wa.me/447816130955?text=Hi%2C%20I%20found%20you%20on%20your%20website%20and%20I%27d%20like%20to%20chat%20about%20a%20project." target="_blank" rel="noopener"><small>WhatsApp</small><b>Message Rachid</b><span>Usually the quickest reply</span></a>
        <a href="tel:07763648866"><small>Phone</small><b>Hanna 07763 648866</b><span>Rachid 07816 130955</span></a>
        <a href="mailto:contact@hellowebdesign.co.uk"><small>Email</small><b>contact@hellowebdesign.co.uk</b><span>Urmston, Manchester, UK</span></a>
      </div>
    </div>
    <form method="POST" action="send.php" id="contactForm" class="reveal d1" data-recaptcha aria-describedby="recaptcha-note">
      <div class="full" id="formStatus" hidden role="status" aria-live="polite"></div>
      <div><label for="f-name">Your name *</label><input type="text" id="f-name" name="name" autocomplete="name" required aria-required="true" /></div>
      <div><label for="f-phone">Phone number</label><input type="tel" id="f-phone" name="phone" autocomplete="tel" /></div>
      <div><label for="f-email">Email address *</label><input type="email" id="f-email" name="email" autocomplete="email" required aria-required="true" /></div>
      <div><label for="f-business">Business name</label><input type="text" id="f-business" name="business_name" autocomplete="organization" /></div>
      <div class="full"><label for="f-interest">What are you interested in? *</label>
        <select id="f-interest" name="interested_package" required aria-required="true"><option value="">Select an option</option><option>Starter Website (one page)</option><option>Business Website (multi page)</option><option>E-Commerce / Online Shop</option><option>Wedding Website</option><option>Social Media Management</option><option>Care Plan - Essentials</option><option>Care Plan - Complete</option><option>Web / Mobile Application</option><option>Something else</option></select>
      </div>
      <div class="full"><label for="f-message">Tell us a bit about what you need</label><textarea id="f-message" name="message"></textarea></div>
      <input type="hidden" name="g-recaptcha-response" id="recaptchaToken" />
      <div class="full"><button type="submit" class="btn btn-fill">Send message →</button></div>
      <p class="recaptcha-note full" id="recaptcha-note">This site is protected by reCAPTCHA and the Google <a href="https://policies.google.com/privacy" target="_blank" rel="noopener">Privacy Policy</a> and <a href="https://policies.google.com/terms" target="_blank" rel="noopener">Terms of Service</a> apply.</p>
    </form>
  </div>
</section>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'].'/partials/footer.php'; ?>
<button class="to-top" id="toTop" aria-label="Back to top"><svg viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"/></svg></button>

<a class="wa" href="https://wa.me/447816130955?text=Hi%2C%20I%20found%20you%20on%20your%20website%20and%20I%27d%20like%20to%20chat%20about%20a%20project." target="_blank" rel="noopener" aria-label="Chat on WhatsApp"><svg viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163a11.867 11.867 0 01-1.587-5.946C.16 5.335 5.495 0 12.05 0a11.817 11.817 0 018.413 3.488 11.824 11.824 0 013.48 8.413c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 01-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884a9.86 9.86 0 001.515 5.26l-.999 3.648 3.973-1.042zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg></a>

<!-- PRIVACY MODAL -->
<div class="pmodal" id="privacyModal" aria-hidden="true">
  <div class="pmodal-bg" data-pclose></div>
  <div class="pmodal-card" role="dialog" aria-modal="true" aria-labelledby="privacy-title">
    <button class="modal-close" data-pclose aria-label="Close">✕</button>
    <h2 id="privacy-title">Privacy Policy</h2>
    <p class="updated"><strong>Last updated:</strong> September 2026</p>
    <h3>Who we are</h3>
    <p>HelloWebDesign is a creative studio run by Hanna and Rachid. Our website address is hellowebdesign.co.uk.</p>
    <h3>What data we collect</h3>
    <p>When you use our contact form, we collect the information you provide: your name, email address, phone number, business name, and message. We use this solely to respond to your enquiry.</p>
    <h3>Analytics</h3>
    <p>We use <a href="https://posthog.com/privacy" target="_blank" rel="noopener">PostHog</a>, an analytics tool hosted in the EU, to see which pages and buttons people actually use, and to replay how visitors move through the site so we can spot where things get confusing. These replays mask everything you type and all the text on the page, so we can see that someone got stuck on the contact form without ever seeing what they wrote. PostHog sets cookies and processes this data in line with their privacy policy.</p>
    <h3>How we use your data</h3>
    <p>We only use the information you provide to respond to your enquiry and, if applicable, to deliver the services you've requested. We never sell or share your data with third parties.</p>
    <h3>Your rights</h3>
    <p>You have the right to request access to, correction of, or deletion of any personal data we hold about you. Contact us at <a href="mailto:contact@hellowebdesign.co.uk">contact@hellowebdesign.co.uk</a> for any data-related requests.</p>
    <h3>Contact</h3>
    <p>If you have any questions about this privacy policy, please email us at <a href="mailto:contact@hellowebdesign.co.uk">contact@hellowebdesign.co.uk</a>.</p>
    <button class="btn btn-fill" data-pclose>Close</button>
  </div>
</div>

<!-- MODAL -->
<div class="modal" id="modal" aria-hidden="true">
  <div class="modal-bg" data-close></div>
  <div class="modal-card" role="dialog" aria-modal="true" aria-labelledby="m-title">
    <button class="modal-close" data-close aria-label="Close">✕</button>
    <div class="modal-shot"><img id="m-img" alt="" /></div>
    <div class="modal-body">
      <span class="tag" id="m-tag"></span>
      <h3 id="m-title"></h3>
      <div class="meta" id="m-meta"></div>
      <p class="summary" id="m-summary"></p>
      <div class="modal-sub">What we did</div>
      <div class="chips" id="m-chips"></div>
      <div class="modal-cta">
        <a id="m-view" class="btn btn-line" target="_blank" rel="noopener">View project ↗</a>
        <a href="#contact" class="btn btn-fill" data-close>Start a project like this →</a>
      </div>
    </div>
  </div>
</div>
<script>
  // back to top (page-specific; nav-shadow/mobile-menu/FAQ/scroll-spy are in /assets/site.js)
  const toTop = document.getElementById('toTop');
  addEventListener('scroll', () => toTop.classList.toggle('show', scrollY > 500), { passive: true });
  toTop.addEventListener('click', () => scrollTo({ top: 0, behavior: 'smooth' }));

  const reduceMotion = matchMedia('(prefers-reduced-motion: reduce)').matches;

  // hero headline: wrap each word so it can arrive on its own (keeps the <em>s intact)
  const heroH1 = document.querySelector('.hero h1');
  if (heroH1 && !reduceMotion){
    let i = 0;
    const wrapWords = (node) => {
      Array.from(node.childNodes).forEach((n) => {
        if (n.nodeType === 3){
          const frag = document.createDocumentFragment();
          n.textContent.split(/(\s+)/).forEach((part) => {
            if (!part) return;
            if (/^\s+$/.test(part)){ frag.appendChild(document.createTextNode(part)); return; }
            const s = document.createElement('span'); s.className = 'w'; s.style.setProperty('--i', i++); s.textContent = part;
            frag.appendChild(s);
          });
          n.replaceWith(frag);
        } else if (n.nodeType === 1){ wrapWords(n); }
      });
    };
    wrapWords(heroH1);
    heroH1.classList.remove('reveal', 'd1');
    heroH1.classList.add('split');
  }

  // hero photo: gentle parallax against its hairline frame while the hero is on screen
  const heroPic = document.querySelector('.hero-photo picture');
  if (heroPic && !reduceMotion){
    let ticking = false;
    const parallax = () => {
      ticking = false;
      if (scrollY > innerHeight) return;
      heroPic.style.transform = 'translateY(' + (scrollY * -0.08).toFixed(1) + 'px)';
    };
    addEventListener('scroll', () => { if (!ticking){ ticking = true; requestAnimationFrame(parallax); } }, { passive: true });
  }

  // reveal on scroll (scroll-position based - robust across environments)
  const reveals = Array.from(document.querySelectorAll('.reveal'));
  function reveal(el){
    el.classList.add('in');
    // watchdog: some embedded webviews stall opacity transitions - force the end state
    setTimeout(() => {
      if (parseFloat(getComputedStyle(el).opacity) < 0.05){
        el.style.transition = 'none'; el.style.opacity = '1'; el.style.transform = 'none';
      }
    }, 820);
  }
  function revealCheck(){
    const trigger = innerHeight * 0.92;
    for (const el of reveals){
      if (el.classList.contains('in')) continue;
      if (el.getBoundingClientRect().top < trigger) reveal(el);
    }
  }

  // projects: the featured four are always shown; the rest expand on tap
  const workGrid = document.querySelector('.work-grid');
  const workToggle = document.getElementById('work-toggle');
  if (workGrid && workToggle){
    const total = workGrid.querySelectorAll('.wc').length;
    if (total <= 4){
      workToggle.closest('.work-more-wrap').remove();
    } else {
      const collapsed = 'Show all ' + total + ' projects ↓', expanded = 'Show fewer ↑';
      workToggle.textContent = collapsed;
      workToggle.addEventListener('click', () => {
        const open = workGrid.classList.toggle('show-all');
        workToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        workToggle.textContent = open ? expanded : collapsed;
        if (open) revealCheck(); else document.getElementById('work').scrollIntoView({behavior:'smooth', block:'start'});
      });
    }
  }

  function onScroll(){ revealCheck(); }
  addEventListener('scroll', onScroll, { passive:true });
  addEventListener('resize', onScroll);
  // initial passes (next frame + small delay to catch late layout)
  requestAnimationFrame(onScroll);
  setTimeout(onScroll, 150);
  // safety: ensure nothing stays hidden
  setTimeout(() => reveals.forEach(el => { if(!el.classList.contains('in')) reveal(el); }), 2600);

  // project case studies
  const projects = {
    flok: { tag:'Website · Brand', title:'FLÓK Medical Aesthetics', meta:'Medical aesthetics & skin clinic · 2026', img:'assets/proj-flok-1200.webp', url:'https://www.flok-aesthetics.com/',
      summary:"A recent build for a skin and aesthetics clinic that wanted to feel like a welcoming community, not a clinical treatment room. We crafted an elegant, editorial site with a calm serif voice, soft imagery and clear paths to booking and treatments.",
      chips:['Brand-led web design','Editorial layout','Treatments & pricing','Booking journey','Reviews & training pages','Mobile responsive'] },
    hs: { tag:'Website', title:'HS Building Services', meta:'Builders · Greater Manchester', img:'assets/proj-hs-building-1200.webp',
      summary:"A bold, confident site for an Urmston builder covering roofing, extensions, renovations and loft conversions. Designed to win trust fast and funnel visitors straight to a free quote.",
      chips:['Custom website','Strong hero & branding','Services breakdown','Get-a-quote forms','Project gallery'] },
    nailhead: { tag:'Website', title:'Nailhead Properties', meta:'Property investment · Manchester', img:'assets/proj-nailhead-1000.webp',
      summary:"A warm, trustworthy site for a Greater Manchester property investment company - telling their 'putting heart back into homes' story and reassuring sellers with fair, transparent messaging.",
      chips:['Custom website','Story-led about page','Trust signals','Portfolio of homes','Enquiry capture'] },
    flightsim: { tag:'Booking · Web App', title:'Manchester Flight Sim Centre', meta:'Experience days · Salford', img:'assets/proj-flightsim-612.webp',
      summary:"A booking-focused build for a flight-simulator experience centre, making it easy for the public, pilots and trainees to choose a simulator and book a session.",
      chips:['Booking platform','Experience packages','Secure payments','Mobile responsive'] },
    farmers: { tag:'Website', title:'The Farmers Arms', meta:'Country pub · Burscough', img:'assets/proj-farmers-1000.webp',
      summary:"A characterful site for a proper country pub on the Leeds & Liverpool canal - big atmospheric imagery, an editorial headline treatment and quick access to the menu and 'find us'.",
      chips:['Custom website','Full-bleed imagery','Menu & opening hours','Find-us & directions'] },
    bbm: { tag:'Social Media Management', title:'Bolton Builders Merchants', meta:'Social media · Atherton', img:'assets/proj-bbm-1200.webp',
      summary:"Ongoing social media management with a sense of humour. We create and film playful, on-brand content that grew a builders' merchant into a properly entertaining follow - racking up 13.9K+ likes.",
      chips:['Content strategy','On-site filming','Editing & scheduling','Community management','Trend-led video'] },
    savethedate: { tag:'Wedding', title:'Save the Date', meta:'Wedding website', img:'assets/proj-savethedate-1000.webp',
      summary:"A personal one-page wedding site to share the day with guests - the schedule, location, accommodation and an easy RSVP, wrapped in a warm, romantic look.",
      chips:['Wedding website','RSVP form','Schedule & location','Photo gallery','Gift list'] },
    fennec: { tag:'Website', title:'Fennec Consulting', meta:'Business, IT & web solutions', img:'assets/proj-fennec-1000.webp',
      summary:"A clean, professional site for a business, IT and web consultancy - clear services, transparent pricing and a confident first impression.",
      chips:['Custom website','Services & pricing','Contact journey','Mobile responsive'] },
    miners: { tag:'Website', title:'The Miners Arms', meta:'Village pub', img:'assets/proj-miners-1000.webp',
      summary:"A welcoming site for a quaint, peaceful village pub - showing off the setting with a relaxed, friendly tone and easy links to the menu and gallery.",
      chips:['Custom website','Atmospheric hero','Menu & gallery','Find-us & contact'] }
  };

  // dialog focus management shared by the project + privacy modals:
  // inert the page behind, move focus to the close button, trap Tab, restore focus on close
  const pageLandmarks = () => Array.from(document.querySelectorAll('nav, main, footer, #toTop, .wa'));
  const FOCUSABLE = 'a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])';
  function dialogOpen(root){
    root._opener = document.activeElement;
    pageLandmarks().forEach(el => el.setAttribute('inert', ''));
    const close = root.querySelector('.modal-close');
    if (close) close.focus();
  }
  function dialogClose(root, restoreFocus = true){
    pageLandmarks().forEach(el => el.removeAttribute('inert'));
    const opener = root._opener; root._opener = null;
    if (restoreFocus && opener && typeof opener.focus === 'function' && document.contains(opener)) opener.focus();
  }
  function trapTab(root, e){
    if (e.key !== 'Tab') return;
    const items = Array.from(root.querySelectorAll(FOCUSABLE)).filter(el => el.offsetParent !== null || el === document.activeElement);
    if (!items.length) return;
    const first = items[0], last = items[items.length - 1];
    if (e.shiftKey && (document.activeElement === first || !root.contains(document.activeElement))){ e.preventDefault(); last.focus(); }
    else if (!e.shiftKey && (document.activeElement === last || !root.contains(document.activeElement))){ e.preventDefault(); first.focus(); }
  }

  const modal = document.getElementById('modal');
  function openProject(id){
    const p = projects[id]; if(!p) return;
    document.getElementById('m-img').src = p.img;
    document.getElementById('m-img').alt = p.title;
    document.getElementById('m-tag').textContent = p.tag;
    document.getElementById('m-title').textContent = p.title;
    document.getElementById('m-meta').textContent = p.meta;
    document.getElementById('m-summary').textContent = p.summary;
    document.getElementById('m-chips').innerHTML = p.chips.map(c => '<span>'+c+'</span>').join('');
    const view = document.getElementById('m-view');
    if (p.url){ view.href = p.url; view.style.display = ''; } else { view.style.display = 'none'; }
    modal.classList.add('open'); modal.setAttribute('aria-hidden','false');
    document.body.style.overflow = 'hidden';
    dialogOpen(modal);
  }
  function closeModal(restoreFocus = true){
    if (!modal.classList.contains('open')) return;
    modal.classList.remove('open'); modal.setAttribute('aria-hidden','true'); document.body.style.overflow='';
    dialogClose(modal, restoreFocus);
  }
  document.querySelectorAll('.wc').forEach(b => b.addEventListener('click', () => openProject(b.dataset.project)));
  // closing via the "#contact" link: let the hash jump set the focus point instead of restoring it to the card
  modal.addEventListener('click', (e) => { if (e.target.hasAttribute('data-close')) closeModal(e.target.tagName !== 'A'); });
  modal.addEventListener('keydown', (e) => trapTab(modal, e));
  addEventListener('keydown', (e) => { if (e.key === 'Escape') closeModal(); });

  // forms (hero quick form + full contact form): fetch a reCAPTCHA v3 token (action 'contact') before submitting
  const SITE_KEY = '6LcixXcsAAAAACLNjsk91s8-RTpuoOeqsnGOqRuH';
  document.querySelectorAll('form[data-recaptcha]').forEach((form) => {
    form.addEventListener('submit', (e) => {
      // if reCAPTCHA failed to load, submit anyway so the form still works
      if (typeof grecaptcha === 'undefined'){ return; }
      e.preventDefault();
      const btn = form.querySelector('button[type=submit]');
      const label = btn ? btn.textContent : '';
      if (btn){ btn.disabled = true; btn.textContent = 'Sending…'; }
      grecaptcha.ready(() => {
        grecaptcha.execute(SITE_KEY, { action: 'contact' }).then((token) => {
          form.querySelector('input[name="g-recaptcha-response"]').value = token;
          form.submit();
        }).catch(() => {
          if (btn){ btn.disabled = false; btn.textContent = label; }
          alert('reCAPTCHA failed to verify. Please try again.');
        });
      });
    });
  });

  // show a status banner after the PHP redirect (/?status=success|error#contact)
  (() => {
    const status = new URLSearchParams(location.search).get('status');
    if (!status) return;
    const box = document.getElementById('formStatus');
    if (!box) return;
    box.hidden = false;
    if (status === 'success'){
      box.className = 'full form-status ok';
      box.textContent = "Thanks - your message has been sent. We'll reply within 24 hours.";
    } else {
      box.className = 'full form-status err';
      box.textContent = "Sorry, something went wrong. Please try again, or email contact@hellowebdesign.co.uk.";
    }
  })();

  // prefill the "What are you interested in?" select from a package/service CTA
  const interestSelect = document.querySelector('select[name="interested_package"]');
  // ...or from a query param (links from service pages: /?prefill=...#contact)
  const prefillParam = new URLSearchParams(location.search).get('prefill');
  if (prefillParam && interestSelect){ interestSelect.value = prefillParam; }
  document.querySelectorAll('[data-prefill]').forEach((el) => {
    el.addEventListener('click', () => {
      if (interestSelect){ interestSelect.value = el.dataset.prefill; }
      // add-ons are <button>s (no href) — scroll to the form ourselves
      if (el.tagName !== 'A'){ document.getElementById('contact').scrollIntoView({ behavior: 'smooth' }); }
    });
  });

  // privacy policy modal
  const pModal = document.getElementById('privacyModal');
  const pLink = document.getElementById('privacyLink');
  function closePrivacy(){
    if (!pModal.classList.contains('open')) return;
    pModal.classList.remove('open'); pModal.setAttribute('aria-hidden','true'); document.body.style.overflow='';
    dialogClose(pModal);
  }
  if (pLink && pModal){
    pLink.addEventListener('click', (e) => { e.preventDefault(); pModal.classList.add('open'); pModal.setAttribute('aria-hidden','false'); document.body.style.overflow='hidden'; dialogOpen(pModal); });
    pModal.addEventListener('click', (e) => { if (e.target.hasAttribute('data-pclose')) closePrivacy(); });
    pModal.addEventListener('keydown', (e) => trapTab(pModal, e));
    addEventListener('keydown', (e) => { if (e.key === 'Escape') closePrivacy(); });
    // deep link from service pages (/#privacy)
    if (location.hash === '#privacy'){ pLink.click(); }
  }
</script>
