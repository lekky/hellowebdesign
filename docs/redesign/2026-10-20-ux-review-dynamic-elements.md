# Homepage UX review: why it feels flat, and what changed

Reviewed 2026-10-20 with the UI/UX Pro Max skill against
`docs/design-system/hellowebdesign/MASTER.md`. Rendered locally at 1440px and
390px with the PHP built-in server and headless Chromium, before and after.

## Verdict

The bones are strong: clear hierarchy, honest copy, good contrast, real
accessibility work (skip link, focus rings, inert dialogs, 44px targets).
"Flat" is not a content or colour problem. It comes from four things:

1. **Every section arrives the same way.** One 26px fade-up, same 700ms curve,
   on every block. When everything moves identically, nothing reads as motion.
2. **No depth cues.** Solid paper bands, one shadow value, no layering, no
   element that sits in front of or behind another (except the hero tag).
3. **The work grid is nine identical tiles.** The design system calls for an
   editorial, asymmetric grid; a uniform 4-up grid reads like a catalogue.
4. **The hero is static.** The h1 is big but inert, and the photo is a hard
   rectangle with nothing anchoring it to the page.

## What this PR changes (homepage + shared CSS/JS)

| Area | Change | Why |
|---|---|---|
| Hero h1 | Words arrive one at a time (blur-to-sharp, 75ms stagger). Without JS or under reduced motion the h1 renders as one block. | One focal animation per view, on the most important element. |
| Hero photo | Offset teal hairline frame behind the photo; the photo parallaxes gently against it while the hero is on screen. | Depth. The frame is a print-style device that fits Warm Editorial without gradients or glass. |
| Nav | Scroll-spy: the link for the section in view keeps its underline and gets `aria-current`. Shared `site.js`, no-op on pages without matching sections. | `nav-state-active`: current location should be visible. |
| Section eyebrows | Short teal rule before the eyebrow (both sides when centred). On the homepage it draws in with the section reveal; on inner pages it is static. | Consistent editorial marker; gives each section a recognisable start. |
| Reveals | New variants: `from-left`, `from-right`, `scale`, and `clip` (photo curtain). Base duration 700ms → 600ms. About photo now curtains in, the inset scales in, About body and Contact info slide in from the side. | Variety in arrival direction is what makes motion read as motion. |
| Work grid | FLÓK (the "New" project) spans 2×2 on desktop; headline 24px. Mobile grid unchanged. | Editorial asymmetry; gives the newest piece a hero slot. |
| Services | Row hover now uses `transform: translateX` instead of animating `padding-left`. | Padding animates layout and reflows the rows below; transform stays on the compositor. |
| Testimonials | Oversized serif quote mark watermark; subtle lift on hover. | Depth and character without new colour. |
| Buttons | `:active` scale(.97) dip. | `scale-feedback`: taps feel acknowledged. |
| Brand marquee | Edge fade mask; a 44px pause/play button with `aria-pressed`. | WCAG 2.2.2: moving content that runs over 5s needs a real control. Hover-pause is not reachable by keyboard or touch. |
| Headings | `text-wrap: balance` on hero h1 and section h2. | Already specified in MASTER.md, was not implemented. |
| Reduced motion | Every new keyframe, transform and parallax is disabled under `prefers-reduced-motion: reduce`; the clip-path curtain renders in its final state. | Accessibility floor in MASTER.md. |

No new dependencies. No library. All motion is transform, opacity, clip-path
or filter, so nothing triggers layout.

## Findings not fixed here (recommendations)

- **No "how it works" section.** MASTER.md's section order includes Process
  (Hero > Proof > Work > Services > *Process* > Pricing...). For a studio that
  sells "no jargon, within a week", three steps (chat, build, launch) would
  answer the biggest unspoken question before the pricing section. Content
  decision, so left for you.
- **No social proof next to the hero CTA.** A single line under the buttons
  ("★★★★★ from local businesses" or "Trusted by 20+ Manchester businesses")
  would lift conversion more than any animation. Needs a true number.
- **Contact form has no inline validation.** Errors only surface after the PHP
  round-trip. Validating on blur (email format, required fields) with a message
  under the field would reduce failed submits. The `/info/` intake page already
  has this pattern (`.field.is-invalid`, `.field-error`); reusing it on the
  dark band is a small job.
- **Marquee vs. MASTER.md.** The design system says "no autoplaying marquees";
  the site has one. This PR makes it pausable rather than removing it. If you
  would rather drop it, replace the strip with a static row of the four brand
  names.
- **Stars are text glyphs.** `★★★★★` works, but an inline SVG star would render
  identically on every platform and could be partially filled for 4.5 ratings.
- **Mobile hero order.** On phones the photo sits below both CTAs, so the
  "two people you'll actually work with" tag is below the fold. Consider moving
  the photo above the lead paragraph on mobile only.

## How to verify

```bash
php -S 127.0.0.1:8089 -t .
# then open http://127.0.0.1:8089/ and scroll; toggle "Reduce motion" in the OS
# to confirm the static fallback.
```
