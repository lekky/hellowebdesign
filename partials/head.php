<?php
  /* Required vars (set before include): $title, $desc, $canonical
     Optional: $ogImage (default og-image.jpg), $twitterDesc (default $desc),
               $jsonLd (raw <script type="application/ld+json">…</script> markup),
               $needsRecaptcha (bool, default false),
               $preloadHero (bool, default false) — emit a <link rel="preload"> for the hero photo;
               the image is $heroPreload = [type, href, srcset, sizes] (default: homepage couple photo) */
  $ogImage        = $ogImage        ?? 'https://hellowebdesign.co.uk/assets/og-image.jpg';
  $twitterDesc    = $twitterDesc    ?? $desc;
  $needsRecaptcha = $needsRecaptcha ?? false;
  $preloadHero    = $preloadHero    ?? false;
  $heroPreload    = $heroPreload    ?? [
    'type'   => 'image/avif',
    'href'   => '/assets/couple-1200.avif',
    'srcset' => '/assets/couple-480.avif 480w, /assets/couple-800.avif 800w, /assets/couple-1200.avif 1200w',
    'sizes'  => '(max-width:880px) 100vw, 45vw',
  ];
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
<?php if ($preloadHero): ?>
<link rel="preload" as="image" type="<?= $heroPreload['type'] ?>" href="<?= $heroPreload['href'] ?>" imagesrcset="<?= $heroPreload['srcset'] ?>" imagesizes="<?= $heroPreload['sizes'] ?>" />
<?php endif; ?>
<script defer src="/assets/site.js"></script>
<?php if ($needsRecaptcha): ?>
<script async defer src="https://www.google.com/recaptcha/api.js?render=6LcixXcsAAAAACLNjsk91s8-RTpuoOeqsnGOqRuH"></script>
<?php endif; ?>
<!-- PostHog (EU Cloud) — product analytics + session replay. Replaced GA4.
     Swap PH_PROJECT_KEY for the real phc_... project key before this goes live. -->
<script>
  !function(t,e){var o,n,p,r;e.__SV||(window.posthog=e,e._i=[],e.init=function(i,s,a){function g(t,e){var o=e.split(".");2==o.length&&(t=t[o[0]],e=o[1]),t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}}(p=t.createElement("script")).type="text/javascript",p.crossOrigin="anonymous",p.async=!0,p.src=s.api_host.replace(".i.posthog.com","-assets.i.posthog.com")+"/static/array.js",(r=t.getElementsByTagName("script")[0]).parentNode.insertBefore(p,r);var u=e;for(void 0!==a?u=e[a]=[]:a="posthog",u.people=u.people||[],Object.defineProperty(u,"toString",{configurable:!0,enumerable:!0,writable:!0,value:function(t){var e="posthog";return"posthog"!==a&&(e+="."+a),t||(e+=" (stub)"),e}}),Object.defineProperty(u.people,"toString",{configurable:!0,enumerable:!0,writable:!0,value:function(){return u.toString(1)+".people (stub)"}}),o="init capture register register_once register_for_session unregister unregister_for_session getFeatureFlag getFeatureFlagResult isFeatureEnabled reloadFeatureFlags updateEarlyAccessFeatureEnrollment getEarlyAccessFeatures on onFeatureFlags onSessionId getSurveys getActiveMatchingSurveys renderSurvey canRenderSurvey getNextSurveyStep identify setPersonProperties group resetGroups setPersonPropertiesForFlags resetPersonPropertiesForFlags setGroupPropertiesForFlags resetGroupPropertiesForFlags reset get_distinct_id getGroups get_session_id get_session_replay_url alias set_config startSessionRecording stopSessionRecording sessionRecordingStarted captureException loadToolbar get_property getSessionProperty createPersonProfile opt_in_capturing opt_out_capturing has_opted_in_capturing has_opted_out_capturing clear_opt_in_out_capturing debug".split(" "),n=0;n<o.length;n++)g(u,o[n]);e._i.push([i,s,a])},e.__SV=1)}(document,window.posthog||[]);
  posthog.init('PH_PROJECT_KEY', {
    api_host: 'https://eu.i.posthog.com',
    defaults: '2026-08-30',
    session_recording: {
      maskAllInputs: true,  /* PostHog's default, set explicitly: never record what visitors type */
      maskTextSelector: '*' /* NOT the default: also mask rendered on-page text */
    }
  })
</script>
<!-- Frontdeskly widget -->
<script src="https://widget.frontdeskly.com/embed.js" data-client="hellowebdesign" async></script>
<?php if (!empty($jsonLd)) echo $jsonLd, "\n"; ?>
</head>
<body>
