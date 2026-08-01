<?php
  /* Required vars (set before include): $title, $desc, $canonical
     Optional: $ogImage (default og-image.jpg), $twitterDesc (default $desc),
               $jsonLd (raw <script type="application/ld+json">…</script> markup),
               $needsRecaptcha (bool, default false) */
  $ogImage        = $ogImage        ?? 'https://hellowebdesign.co.uk/assets/og-image.jpg';
  $twitterDesc    = $twitterDesc    ?? $desc;
  $needsRecaptcha = $needsRecaptcha ?? false;
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?= $title ?></title>
<meta name="description" content="<?= $desc ?>" />
<link rel="canonical" href="<?= $canonical ?>" />
<link rel="icon" href="/favicon.ico" sizes="any" />
<link rel="icon" type="image/png" sizes="96x96" href="/assets/favicon-96x96.png" />
<link rel="icon" type="image/svg+xml" href="/assets/favicon.svg" />
<link rel="apple-touch-icon" sizes="180x180" href="/assets/apple-touch-icon.png" />
<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:site_name" content="HelloWebDesign" />
<meta property="og:title" content="<?= $title ?>" />
<meta property="og:description" content="<?= $desc ?>" />
<meta property="og:url" content="<?= $canonical ?>" />
<meta property="og:image" content="<?= $ogImage ?>" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />
<meta property="og:image:alt" content="Hanna and Rachid, the husband-and-wife team behind HelloWebDesign" />
<meta property="og:locale" content="en_GB" />
<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="<?= $title ?>" />
<meta name="twitter:description" content="<?= $twitterDesc ?>" />
<meta name="twitter:image" content="<?= $ogImage ?>" />
<meta name="twitter:image:alt" content="Hanna and Rachid, the husband-and-wife team behind HelloWebDesign" />
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,400;0,6..72,500;0,6..72,600;1,6..72,400;1,6..72,500&family=Hanken+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="/assets/site.css" />
<script defer src="/assets/site.js"></script>
<?php if ($needsRecaptcha): ?>
<script async defer src="https://www.google.com/recaptcha/api.js?render=6LcixXcsAAAAACLNjsk91s8-RTpuoOeqsnGOqRuH"></script>
<?php endif; ?>
<!-- Google Analytics (GA4) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-5GF9NH7X8G"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-5GF9NH7X8G');
</script>
<!-- Frontdeskly widget -->
<script src="https://widget.frontdeskly.com/embed.js" data-client="hellowebdesign" async></script>
<?php if (!empty($jsonLd)) echo $jsonLd, "\n"; ?>
</head>
<body>
