<?php
  $title       = 'HelloWebDesign - Web Design &amp; Social Media in Urmston';
  $desc        = 'Husband-and-wife web design and social media studio in Urmston, helping small businesses across Manchester get online - personal, jargon-free, within a week.';
  $canonical   = 'https://hellowebdesign.co.uk/';
  $needsRecaptcha = true;
  $navItems    = [
    ['/#about',    'About'],
    ['/#work',     'Work'],
    ['/#services', 'Services'],
    ['/#packages', 'Packages'],
  ];
  $ctaHref     = '/#contact';
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
<style>
/* Homepage one-offs. Everything shared (reveal, strip, work/service/pricing cards, quotes,
   contact form, modals, footer, to-top) lives in /assets/site.css. */
.hero{position:relative;overflow:hidden}
.hero h1{font-size:clamp(44px,6vw,78px)}
.hero p.lead{max-width:40ch}
.hero-photo .frame{width:100%;height:auto;border-radius:14px;aspect-ratio:4/5;object-fit:cover;box-shadow:0 30px 60px -28px rgba(23,63,58,.45)}
.hero-tag{position:absolute;left:-22px;bottom:34px;background:var(--paper);border:1px solid var(--line);border-radius:12px;padding:14px 20px;box-shadow:0 16px 30px -18px rgba(0,0,0,.3)}
.hero-tag b{font-family:var(--serif);font-size:22px;color:var(--teal-text)}
.hero-tag span{display:block;font-size:12px;color:var(--muted);letter-spacing:.04em}
.hero-photo .float{position:absolute;animation:floaty 6s ease-in-out infinite}
@keyframes floaty{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}
@media(prefers-reduced-motion:reduce){.hero-photo .float{animation:none}}
</style>
<!-- HERO -->
<header class="hero" id="top">
  <div class="wrap hero-grid">
    <div>
      <span class="speed reveal"><span class="pulse"></span>Online within a week</span>
      <h1 class="reveal d1">We build websites that <em>grow</em> your business.</h1>
      <p class="lead reveal d2">A husband-and-wife studio in Urmston, helping small businesses across Manchester look brilliant online - without the jargon or the agency markup.</p>
      <div class="hero-cta reveal d3">
        <a href="#contact" class="btn btn-fill">Start your project →</a>
        <a href="#work" class="btn btn-line">See our work</a>
      </div>
    </div>
    <div class="hero-photo reveal d2">
      <img class="frame" src="assets/couple.png" width="2399" height="1800" fetchpriority="high" alt="Hanna and Rachid, the husband-and-wife team behind HelloWebDesign in Urmston" />
      <div class="hero-tag float"><b>Hanna &amp; Rachid</b><span>The two people you'll actually work with</span></div>
    </div>
  </div>
</header>

<div class="strip">
  <div class="strip-in" id="marquee">
    <small>20+ years with brands like</small><span class="dot"></span>
    <span>Next</span><span class="dot"></span><span>Iceland</span><span class="dot"></span><span>Pets at Home</span><span class="dot"></span><span>SimplyBe</span><span class="dot"></span>
    <small>20+ years with brands like</small><span class="dot"></span>
    <span>Next</span><span class="dot"></span><span>Iceland</span><span class="dot"></span><span>Pets at Home</span><span class="dot"></span><span>SimplyBe</span><span class="dot"></span>
  </div>
</div>

<!-- ABOUT -->
<section id="about">
  <div class="wrap about-grid">
    <div class="about-media reveal">
      <img class="main" src="assets/working.png" width="1140" height="1600" loading="lazy" decoding="async" alt="Hanna and Rachid working together" />
      <img class="inset" src="assets/desk.png" width="1800" height="1013" loading="lazy" decoding="async" alt="Hanna managing social media analytics" />
    </div>
    <div class="about-body reveal d1">
      <span class="eyebrow">About us</span>
      <h2 class="h2-sm">Real people who actually care about your business</h2>
      <p>We're a family-run studio based in Urmston, working closely with local and specialist businesses to build their presence online - from websites to social media, with a hands-on, personal approach.</p>
      <p>We take the time to understand your products, your customers and how your business actually works. That means less back-and-forth and content that feels genuine, not generic. You'll work directly with us, start to finish. No account managers, no handoffs, no middlemen.</p>
      <div class="stats">
        <div class="stat"><b data-count="20" data-suffix="+">0</b><span>Years experience</span></div>
        <div class="stat"><b data-count="2">0</b><span>Person team</span></div>
        <div class="stat"><b data-count="100" data-suffix="%">0</b><span>Hands-on</span></div>
      </div>
    </div>
  </div>
</section>

<!-- WORK -->
<section id="work" class="work">
  <div class="wrap">
    <div class="sec-head reveal">
      <span class="eyebrow">Our work</span>
      <h2>Recent projects for real local businesses</h2>
      <p>A selection of sites, apps and social media we've designed, built and launched. Tap any project to see what we did.</p>
    </div>
    <div class="work-grid">
      <button class="wc reveal" data-project="flok"><div class="wc-shot"><span class="badge-new">New</span><img loading="lazy" decoding="async" src="assets/proj-flok.png" alt="FLÓK Medical Aesthetics" /></div><div class="wc-body"><div class="wc-meta"><span class="wc-cat">Website · Brand</span><h3>FLÓK Medical Aesthetics</h3></div><span class="arr">↗</span></div></button>
      <button class="wc reveal d1" data-project="savethedate"><div class="wc-shot"><img loading="lazy" decoding="async" src="assets/proj-savethedate.png" alt="Save the Date wedding website" /></div><div class="wc-body"><div class="wc-meta"><span class="wc-cat">Wedding website</span><h3>Save the Date</h3></div><span class="arr">↗</span></div></button>
      <button class="wc reveal d2" data-project="nailhead"><div class="wc-shot"><img loading="lazy" decoding="async" src="assets/proj-nailhead.png" alt="Nailhead Properties" /></div><div class="wc-body"><div class="wc-meta"><span class="wc-cat">Website</span><h3>Nailhead Properties</h3></div><span class="arr">↗</span></div></button>
      <button class="wc reveal" data-project="flightsim"><div class="wc-shot"><img loading="lazy" decoding="async" src="assets/proj-flightsim.png" alt="Manchester Flight Sim Centre" /></div><div class="wc-body"><div class="wc-meta"><span class="wc-cat">Booking · Web App</span><h3>Manchester Flight Sim Centre</h3></div><span class="arr">↗</span></div></button>
      <button class="wc reveal d1" data-project="hs"><div class="wc-shot"><img loading="lazy" decoding="async" src="assets/proj-hs-building.png" alt="HS Building Services" /></div><div class="wc-body"><div class="wc-meta"><span class="wc-cat">Website</span><h3>HS Building Services</h3></div><span class="arr">↗</span></div></button>
      <button class="wc reveal d2" data-project="farmers"><div class="wc-shot"><img loading="lazy" decoding="async" src="assets/proj-farmers.png" alt="The Farmers Arms" /></div><div class="wc-body"><div class="wc-meta"><span class="wc-cat">Website</span><h3>The Farmers Arms</h3></div><span class="arr">↗</span></div></button>
      <button class="wc reveal" data-project="bbm"><div class="wc-shot"><img loading="lazy" decoding="async" src="assets/proj-bbm.png" alt="Bolton Builders Merchants social media" /></div><div class="wc-body"><div class="wc-meta"><span class="wc-cat">Social Media</span><h3>Bolton Builders Merchants</h3></div><span class="arr">↗</span></div></button>
      <button class="wc reveal d1" data-project="fennec"><div class="wc-shot"><img loading="lazy" decoding="async" src="assets/proj-fennec.png" alt="Fennec Consulting" /></div><div class="wc-body"><div class="wc-meta"><span class="wc-cat">Website</span><h3>Fennec Consulting</h3></div><span class="arr">↗</span></div></button>
      <button class="wc reveal d2" data-project="miners"><div class="wc-shot"><img loading="lazy" decoding="async" src="assets/proj-miners.png" alt="The Miners Arms" /></div><div class="wc-body"><div class="wc-meta"><span class="wc-cat">Website</span><h3>The Miners Arms</h3></div><span class="arr">↗</span></div></button>
    </div>
    <div class="work-more-wrap">
      <button class="btn btn-line" id="work-toggle" aria-expanded="false">Show all projects ↓</button>
    </div>
  </div>
</section>

<!-- SERVICES -->
<section id="services">
  <div class="wrap">
    <div class="sec-head reveal">
      <span class="eyebrow">What we do</span>
      <h2>Everything you need to get online</h2>
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

<!-- WHY -->
<section class="why">
  <div class="wrap">
    <div class="sec-head reveal">
      <span class="eyebrow">Why pick us</span>
      <h2>What makes us different</h2>
      <p>We're not a faceless agency. Here's why local businesses choose us.</p>
    </div>
    <div class="why-grid">
      <div class="why-item reveal"><span class="n">01</span><div><h3>You deal with us directly</h3><p>No account managers, no juniors. You speak to the people doing the work, every time.</p></div></div>
      <div class="why-item reveal d1"><span class="n">02</span><div><h3>No hidden fees</h3><p>The price we quote is the price you pay. Extra work is always agreed before we proceed.</p></div></div>
      <div class="why-item reveal"><span class="n">03</span><div><h3>We understand small business</h3><p>We run one ourselves. We know the budgets, the priorities and what actually moves the needle.</p></div></div>
      <div class="why-item reveal d1"><span class="n">04</span><div><h3>Big-brand experience</h3><p>20+ years with household names, now focused entirely on helping local businesses grow.</p></div></div>
    </div>
  </div>
</section>

<!-- PACKAGES -->
<section id="packages">
  <div class="wrap">
    <div class="sec-head center reveal">
      <span class="eyebrow">Packages</span>
      <h2>Simple, honest pricing</h2>
      <p>Whether you need a starter site to get online or ongoing support, there's a package for you.</p>
    </div>
    <div class="pkg-grid">
      <div class="pkg reveal">
        <div class="pkg-name">Starter Site</div><div class="pkg-sub">One-page, get online fast</div><div class="price">From £499</div>
        <ul><li>Single-page design</li><li>Mobile responsive</li><li>Contact form included</li><li>Live within a week</li></ul>
        <a href="/small-business-websites/" class="link-teal pkg-link">More about small business websites →</a>
        <a href="#contact" class="btn btn-line" data-prefill="Starter Website (one page)">Get in touch</a>
      </div>
      <div class="pkg feat reveal d1">
        <span class="feat-badge">Most popular</span><div class="pkg-name">Business Pro</div><div class="pkg-sub">For growing businesses</div><div class="price">Custom</div>
        <ul><li>Multi-page website</li><li>Custom design</li><li>Advanced SEO setup</li><li>Google integration</li></ul>
        <a href="#contact" class="btn btn-fill" data-prefill="Business Website (multi page)">Start your project</a>
      </div>
      <div class="pkg reveal d2">
        <div class="pkg-name">E-Commerce</div><div class="pkg-sub">Sell online</div><div class="price">Custom</div>
        <ul><li>Full online shop</li><li>Secure payments</li><li>Order management</li><li>Product catalogue</li></ul>
        <a href="#contact" class="btn btn-line" data-prefill="E-Commerce / Online Shop">Get in touch</a>
      </div>
      <div class="pkg reveal d3">
        <div class="pkg-name">Wedding</div><div class="pkg-sub">Your day, online</div><div class="price">From £499</div>
        <ul><li>Beautiful wedding site</li><li>RSVP form</li><li>Venue &amp; travel info</li><li>Custom photo gallery</li></ul>
        <a href="/wedding-websites/" class="link-teal pkg-link">More about wedding websites →</a>
        <a href="#contact" class="btn btn-line" data-prefill="Wedding Website">Get in touch</a>
      </div>
    </div>
    <div class="addons reveal">
      <span data-prefill="Social Media Management">+ Social Media Management</span><span data-prefill="Web / Mobile Application">+ Web Applications</span><span data-prefill="Web / Mobile Application">+ Mobile Apps</span><span data-prefill="Something else">+ Business Process Consultancy</span>
    </div>
  </div>
</section>

<!-- CARE PLANS -->
<section id="care-plans" style="background:#e7f1ef">
  <div class="wrap">
    <div class="sec-head center reveal">
      <span class="eyebrow">Care Plans</span>
      <h2>After launch, we've got your back</h2>
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

<!-- TESTIMONIALS -->
<section class="why" style="background:var(--paper-2)">
  <div class="wrap">
    <div class="sec-head center reveal">
      <span class="eyebrow">Testimonials</span>
      <h2>What our clients say</h2>
    </div>
    <div class="quotes">
      <div class="quote reveal"><div class="stars">★★★★★</div><p>"Really impressed with the whole process. They took the time to understand what we needed and delivered a site we're genuinely proud of. Couldn't recommend them enough."</p><div class="who"><strong>Anoush S</strong><span>Local Pub Owner</span></div></div>
      <div class="quote reveal d1"><div class="stars">★★★★★</div><p>"Having someone handle our social media who actually visits the business and understands what we do has made a massive difference. The content feels authentic, not forced."</p><div class="who"><strong>Mick H</strong><span>Local Building Merchant</span></div></div>
      <div class="quote reveal d2"><div class="stars">★★★★★</div><p>"Our wedding website was amazing, made it so easy for our guests and us having everything all in one place."</p><div class="who"><strong>Hassan OE</strong><span>Wedding Website</span></div></div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section id="faq">
  <div class="wrap">
    <div class="sec-head center reveal">
      <span class="eyebrow">FAQs</span>
      <h2>Questions, answered</h2>
      <p>The things people usually ask before getting started.</p>
    </div>
    <div class="faq reveal">
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
<section id="contact" class="contact">
  <div class="wrap ct-grid">
    <div class="ct-info reveal">
      <span class="eyebrow">Contact</span>
      <h2 class="h2-sm">Say hello</h2>
      <p>Ready to get started? Drop us a message and we'll reply within 24 hours. No pressure, no hard sell - just a friendly chat.</p>
      <div class="ct-line"><small>Email</small><a href="mailto:contact@hellowebdesign.co.uk">contact@hellowebdesign.co.uk</a></div>
      <div class="ct-line"><small>Phone</small><span>Hanna 07763 648866 · Rachid 07816 130955</span></div>
      <div class="ct-line"><small>Based in</small><span>Urmston, Manchester, UK</span></div>
    </div>
    <form method="POST" action="send.php" id="contactForm" class="reveal d1">
      <div class="full" id="formStatus" hidden role="status" aria-live="polite"></div>
      <div><label>Your name *</label><input type="text" name="name" required /></div>
      <div><label>Phone number</label><input type="tel" name="phone" /></div>
      <div><label>Email address *</label><input type="email" name="email" required /></div>
      <div><label>Business name</label><input type="text" name="business_name" /></div>
      <div class="full"><label>What are you interested in? *</label>
        <select name="interested_package" required><option value="">Select an option</option><option>Starter Website (one page)</option><option>Business Website (multi page)</option><option>E-Commerce / Online Shop</option><option>Wedding Website</option><option>Social Media Management</option><option>Care Plan - Essentials</option><option>Care Plan - Complete</option><option>Web / Mobile Application</option><option>Something else</option></select>
      </div>
      <div class="full"><label>Tell us a bit about what you need</label><textarea name="message"></textarea></div>
      <input type="hidden" name="g-recaptcha-response" id="recaptchaToken" />
      <div class="full"><button type="submit" class="btn btn-fill">Send message →</button></div>
      <p class="recaptcha-note full">This site is protected by reCAPTCHA and the Google <a href="https://policies.google.com/privacy" target="_blank" rel="noopener">Privacy Policy</a> and <a href="https://policies.google.com/terms" target="_blank" rel="noopener">Terms of Service</a> apply.</p>
    </form>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'].'/partials/footer.php'; ?>
<button class="to-top" id="toTop" aria-label="Back to top"><svg viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"/></svg></button>

<a class="wa" href="https://wa.me/447816130955?text=Hi%2C%20I%20found%20you%20on%20your%20website%20and%20I%27d%20like%20to%20chat%20about%20a%20project." target="_blank" rel="noopener" aria-label="Chat on WhatsApp"><svg viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163a11.867 11.867 0 01-1.587-5.946C.16 5.335 5.495 0 12.05 0a11.817 11.817 0 018.413 3.488 11.824 11.824 0 013.48 8.413c-.003 6.557-5.338 11.892-11.893 11.892a11.9 11.9 0 01-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884a9.86 9.86 0 001.515 5.26l-.999 3.648 3.973-1.042zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg></a>

<!-- PRIVACY MODAL -->
<div class="pmodal" id="privacyModal" aria-hidden="true">
  <div class="pmodal-bg" data-pclose></div>
  <div class="pmodal-card" role="dialog" aria-modal="true" aria-label="Privacy Policy">
    <button class="modal-close" data-pclose aria-label="Close">✕</button>
    <h2>Privacy Policy</h2>
    <p class="updated"><strong>Last updated:</strong> February 2026</p>
    <h3>Who we are</h3>
    <p>HelloWebDesign is a creative studio run by Hanna and Rachid. Our website address is hellowebdesign.co.uk.</p>
    <h3>What data we collect</h3>
    <p>When you use our contact form, we collect the information you provide: your name, email address, phone number, business name, and message. We use this solely to respond to your enquiry.</p>
    <h3>Analytics</h3>
    <p>We use Google Analytics to understand how visitors use our site so we can improve it. Google Analytics sets cookies and may collect data such as your approximate location, device, and the pages you visit. This is processed by Google in line with their <a href="https://policies.google.com/privacy" target="_blank" rel="noopener">Privacy Policy</a>. We only ever look at this data in aggregate, never to identify you personally.</p>
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
  <div class="modal-card" role="dialog" aria-modal="true">
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
  // back to top (page-specific; nav-shadow/mobile-menu/FAQ are in /assets/site.js)
  const toTop = document.getElementById('toTop');
  addEventListener('scroll', () => toTop.classList.toggle('show', scrollY > 500), { passive: true });
  toTop.addEventListener('click', () => scrollTo({ top: 0, behavior: 'smooth' }));

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

  // projects: show first 4 on mobile, expand the rest on tap
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
        if (!open) document.getElementById('work').scrollIntoView({behavior:'smooth', block:'start'});
      });
    }
  }

  // animated count-up
  const counters = Array.from(document.querySelectorAll('[data-count]'));
  function runCount(el){
    const target = +el.dataset.count, suffix = el.dataset.suffix || '';
    const dur = 1100, t0 = performance.now();
    const tick = (t) => {
      const p = Math.min(1, (t - t0) / dur), eased = 1 - Math.pow(1 - p, 3);
      el.textContent = Math.round(eased * target) + suffix;
      if (p < 1) requestAnimationFrame(tick);
    };
    requestAnimationFrame(tick);
  }
  function countCheck(){
    const trigger = innerHeight * 0.85;
    for (let i = counters.length - 1; i >= 0; i--){
      const el = counters[i];
      if (el.getBoundingClientRect().top < trigger){ runCount(el); counters.splice(i,1); }
    }
  }

  function onScroll(){ revealCheck(); countCheck(); }
  addEventListener('scroll', onScroll, { passive:true });
  addEventListener('resize', onScroll);
  // initial passes (next frame + small delay to catch late layout)
  requestAnimationFrame(onScroll);
  setTimeout(onScroll, 150);
  // safety: ensure nothing stays hidden
  setTimeout(() => reveals.forEach(el => { if(!el.classList.contains('in')) reveal(el); }), 2600);

  // project case studies
  const projects = {
    flok: { tag:'Website · Brand', title:'FLÓK Medical Aesthetics', meta:'Medical aesthetics & skin clinic · 2026', img:'assets/proj-flok.png', url:'https://www.flok-aesthetics.com/',
      summary:"A recent build for a skin and aesthetics clinic that wanted to feel like a welcoming community, not a clinical treatment room. We crafted an elegant, editorial site with a calm serif voice, soft imagery and clear paths to booking and treatments.",
      chips:['Brand-led web design','Editorial layout','Treatments & pricing','Booking journey','Reviews & training pages','Mobile responsive'] },
    hs: { tag:'Website', title:'HS Building Services', meta:'Builders · Greater Manchester', img:'assets/proj-hs-building.png',
      summary:"A bold, confident site for an Urmston builder covering roofing, extensions, renovations and loft conversions. Designed to win trust fast and funnel visitors straight to a free quote.",
      chips:['Custom website','Strong hero & branding','Services breakdown','Get-a-quote forms','Project gallery'] },
    nailhead: { tag:'Website', title:'Nailhead Properties', meta:'Property investment · Manchester', img:'assets/proj-nailhead.png',
      summary:"A warm, trustworthy site for a Greater Manchester property investment company - telling their 'putting heart back into homes' story and reassuring sellers with fair, transparent messaging.",
      chips:['Custom website','Story-led about page','Trust signals','Portfolio of homes','Enquiry capture'] },
    flightsim: { tag:'Booking · Web App', title:'Manchester Flight Sim Centre', meta:'Experience days · Salford', img:'assets/proj-flightsim.png',
      summary:"A booking-focused build for a flight-simulator experience centre, making it easy for the public, pilots and trainees to choose a simulator and book a session.",
      chips:['Booking platform','Experience packages','Secure payments','Mobile responsive'] },
    farmers: { tag:'Website', title:'The Farmers Arms', meta:'Country pub · Burscough', img:'assets/proj-farmers.png',
      summary:"A characterful site for a proper country pub on the Leeds & Liverpool canal - big atmospheric imagery, an editorial headline treatment and quick access to the menu and 'find us'.",
      chips:['Custom website','Full-bleed imagery','Menu & opening hours','Find-us & directions'] },
    bbm: { tag:'Social Media Management', title:'Bolton Builders Merchants', meta:'Social media · Atherton', img:'assets/proj-bbm.png',
      summary:"Ongoing social media management with a sense of humour. We create and film playful, on-brand content that grew a builders' merchant into a properly entertaining follow - racking up 13.9K+ likes.",
      chips:['Content strategy','On-site filming','Editing & scheduling','Community management','Trend-led video'] },
    savethedate: { tag:'Wedding', title:'Save the Date', meta:'Wedding website', img:'assets/proj-savethedate.png',
      summary:"A personal one-page wedding site to share the day with guests - the schedule, location, accommodation and an easy RSVP, wrapped in a warm, romantic look.",
      chips:['Wedding website','RSVP form','Schedule & location','Photo gallery','Gift list'] },
    fennec: { tag:'Website', title:'Fennec Consulting', meta:'Business, IT & web solutions', img:'assets/proj-fennec.png',
      summary:"A clean, professional site for a business, IT and web consultancy - clear services, transparent pricing and a confident first impression.",
      chips:['Custom website','Services & pricing','Contact journey','Mobile responsive'] },
    miners: { tag:'Website', title:'The Miners Arms', meta:'Village pub', img:'assets/proj-miners.png',
      summary:"A welcoming site for a quaint, peaceful village pub - showing off the setting with a relaxed, friendly tone and easy links to the menu and gallery.",
      chips:['Custom website','Atmospheric hero','Menu & gallery','Find-us & contact'] }
  };

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
  }
  function closeModal(){ modal.classList.remove('open'); modal.setAttribute('aria-hidden','true'); document.body.style.overflow=''; }
  document.querySelectorAll('.wc').forEach(b => b.addEventListener('click', () => openProject(b.dataset.project)));
  modal.addEventListener('click', (e) => { if (e.target.hasAttribute('data-close')) closeModal(); });
  addEventListener('keydown', (e) => { if (e.key === 'Escape') closeModal(); });

  // contact form: fetch a reCAPTCHA v3 token (action 'contact') before submitting
  const SITE_KEY = '6LcixXcsAAAAACLNjsk91s8-RTpuoOeqsnGOqRuH';
  const cForm = document.getElementById('contactForm');
  if (cForm){
    cForm.addEventListener('submit', (e) => {
      // if reCAPTCHA failed to load, submit anyway so the form still works
      if (typeof grecaptcha === 'undefined'){ return; }
      e.preventDefault();
      const btn = cForm.querySelector('button[type=submit]');
      if (btn){ btn.disabled = true; btn.textContent = 'Sending…'; }
      grecaptcha.ready(() => {
        grecaptcha.execute(SITE_KEY, { action: 'contact' }).then((token) => {
          document.getElementById('recaptchaToken').value = token;
          cForm.submit();
        }).catch(() => {
          if (btn){ btn.disabled = false; btn.textContent = 'Send message →'; }
          alert('reCAPTCHA failed to verify. Please try again.');
        });
      });
    });
  }

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
      // add-ons are <span> (no href) — scroll to the form ourselves
      if (el.tagName !== 'A'){ document.getElementById('contact').scrollIntoView({ behavior: 'smooth' }); }
    });
  });

  // privacy policy modal
  const pModal = document.getElementById('privacyModal');
  const pLink = document.getElementById('privacyLink');
  function closePrivacy(){ pModal.classList.remove('open'); pModal.setAttribute('aria-hidden','true'); document.body.style.overflow=''; }
  if (pLink && pModal){
    pLink.addEventListener('click', (e) => { e.preventDefault(); pModal.classList.add('open'); pModal.setAttribute('aria-hidden','false'); document.body.style.overflow='hidden'; });
    pModal.addEventListener('click', (e) => { if (e.target.hasAttribute('data-pclose')) closePrivacy(); });
    addEventListener('keydown', (e) => { if (e.key === 'Escape') closePrivacy(); });
    // deep link from service pages (/#privacy)
    if (location.hash === '#privacy'){ pLink.click(); }
  }
</script>
