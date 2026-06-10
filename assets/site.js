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
    navToggle.addEventListener('click', () => { navLinks.classList.toggle('open'); navToggle.classList.toggle('open'); });
    navLinks.querySelectorAll('a').forEach(a => a.addEventListener('click', () => { navLinks.classList.remove('open'); navToggle.classList.remove('open'); }));
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
