/* Shared behaviour for all pages: nav shadow, mobile menu, FAQ accordion.
   Loaded with `defer`, so the DOM is ready. Null-guarded so it is safe on any page. */
(() => {
  // nav shadow on scroll
  const nav = document.getElementById('nav');
  if (nav) {
    addEventListener('scroll', () => nav.classList.toggle('scrolled', scrollY > 12), { passive: true });
  }

  // mobile menu
  const navToggle = document.getElementById('navToggle');
  const navLinks  = document.getElementById('navLinks');
  if (navToggle && navLinks) {
    const setMenu = (open) => {
      navLinks.classList.toggle('open', open);
      navToggle.classList.toggle('open', open);
      navToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    };
    navToggle.addEventListener('click', () => setMenu(!navLinks.classList.contains('open')));
    navLinks.querySelectorAll('a').forEach(a => a.addEventListener('click', () => setMenu(false)));
    // Escape closes the open menu and hands focus back to the button
    addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && navLinks.classList.contains('open')) { setMenu(false); navToggle.focus(); }
    });
  }

  // scroll-spy: underline the nav link for the section currently in view
  // (links are "/#id" or "#id"; only sections that exist on this page take part)
  const spyLinks = Array.from(document.querySelectorAll('.nav-links a:not(.nav-cta)'))
    .map(a => { const id = (a.getAttribute('href') || '').split('#')[1]; const el = id && document.getElementById(id); return el ? { a, el } : null; })
    .filter(Boolean);
  if (spyLinks.length && 'IntersectionObserver' in window) {
    const setActive = (el) => spyLinks.forEach(({ a, el: s }) => {
      const on = s === el;
      a.classList.toggle('active', on);
      if (on) a.setAttribute('aria-current', 'true'); else a.removeAttribute('aria-current');
    });
    const visible = new Map();
    const io = new IntersectionObserver((entries) => {
      entries.forEach(e => e.isIntersecting ? visible.set(e.target, e.intersectionRatio) : visible.delete(e.target));
      let best = null, bestRatio = 0;
      visible.forEach((r, el) => { if (r > bestRatio) { best = el; bestRatio = r; } });
      setActive(best);
    }, { rootMargin: '-35% 0px -45% 0px', threshold: [0, .25, .5, .75, 1] });
    spyLinks.forEach(({ el }) => io.observe(el));
  }

  // FAQ accordion (only one open at a time)
  document.querySelectorAll('.faq-q').forEach((q) => {
    q.addEventListener('click', () => {
      const item = q.closest('.faq-item');
      const wasOpen = item.classList.contains('open');
      document.querySelectorAll('.faq-item.open').forEach((o) => {
        o.classList.remove('open');
        o.querySelector('.faq-q').setAttribute('aria-expanded', 'false');
      });
      if (!wasOpen) { item.classList.add('open'); q.setAttribute('aria-expanded', 'true'); }
    });
  });
})();
