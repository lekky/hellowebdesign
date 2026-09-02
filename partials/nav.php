<?php
  /* $navItems: array of [href, label] for the main links.
     Optional: $ctaHref (default '/#contact'), $ctaLabel (default 'Get in touch'). */
  $ctaHref  = $ctaHref  ?? '/#contact';
  $ctaLabel = $ctaLabel ?? 'Get in touch';
?>
<a class="skip-link" href="#main">Skip to content</a>
<nav id="nav">
  <div class="wrap nav-in">
    <a href="/" class="brand"><picture><source media="(max-width:880px)" srcset="/assets/logo-dark.png" /><img src="/assets/logo.png" width="677" height="369" alt="HelloWebDesign - web design and social media studio in Urmston, Manchester" /></picture></a>
    <div class="nav-links" id="navLinks">
<?php foreach ($navItems as [$href, $label]): ?>
      <a href="<?= $href ?>"><?= $label ?></a>
<?php endforeach; ?>
      <a href="<?= $ctaHref ?>" class="nav-cta"><?= $ctaLabel ?></a>
    </div>
    <button class="nav-toggle" id="navToggle" aria-label="Open menu" aria-expanded="false" aria-controls="navLinks"><span></span><span></span><span></span></button>
  </div>
</nav>
