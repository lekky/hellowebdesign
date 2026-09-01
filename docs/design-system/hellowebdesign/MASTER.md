# HelloWebDesign — Design System (MASTER)

Global source of truth for every page under hellowebdesign.co.uk. Page-specific
overrides go in `pages/<page>.md` and win over this file.

Generated with the UI/UX Pro Max skill on 2026-09-01. The generator's raw
picks (Minimalism & Swiss, green/orange palette, Caveat/Quicksand) were rejected
as a poor fit for a personal local studio; the values below are assembled from
verified domain matches and measured contrast. Rationale:
`docs/redesign/2026-09-01-ui-ux-pro-max-redesign-proposal.md`.

## Pattern

**Trust & Authority + Conversion** (`trust-authority-conversion`), supported by
`hero-testimonials-cta` and `portfolio-grid`.

Section order: Hero (credibility) > Proof strip > Work > Services > Process >
Pricing > Testimonials > About > FAQ > Contact.

Primary CTA: "Start your project" in hero and nav, repeated after pricing and
after testimonials. Secondary: "See our work". Package and add-on CTAs prefill
the contact `interested_package` select via `data-prefill`.

## Style

**Editorial Grid / Magazine** (`editorial-grid-magazine`), warm variant.
Asymmetric 7/5 grids, large photography, print-inspired serif headings, generous
white space, hairline rules over cards. Cards are reserved for things that are
genuinely separate objects (price cards, project tiles, testimonials).

Avoid: gradients, glassmorphism, neon accents, emoji icons, dark mode for the
main pages (dark is used only for the contact and footer bands).

## Colours

| Token | Hex | Use |
|---|---|---|
| `--paper` | `#f7f3ea` | page ground |
| `--paper-2` | `#efe8d9` | alternate section ground |
| `--ink` | `#33373b` | headings and body on light |
| `--muted` | `#5a554b` | secondary text (6.1:1 on paper-2) |
| `--teal` | `#60bfb5` | fills, highlights, text on dark only |
| `--teal-text` | `#266860` | eyebrows, links, small teal text on light (5.3:1 on paper-2) |
| `--teal-deep` | `#2f7a72` | large display accents only |
| `--teal-ink` | `#173f3a` | hover fills, dark teal surfaces |
| `--charcoal` | `#33373b` | primary button fill, featured card |
| `--charcoal-2` | `#2a2d31` | inputs on dark |
| `--charcoal-3` | `#212327` | contact band, footer |
| `--line` | `#e2dbcb` | hairlines |
| `--focus` | `#1d6f66` | focus ring on light (`--teal` on dark) |
| `--error` | `#b4423b` | form errors on light; `#f3d4d2` text on dark |

Rules: teal `#60bfb5` is never used as text on a light ground. One primary
button colour (charcoal) across the site; the nav CTA uses the same style.

## Typography

Google Fonts: Newsreader (opsz 6..72, 400/500/600, italic 400/500) +
Hanken Grotesk (400/500/600/700). `display=swap`.

| Role | Face | Size / leading |
|---|---|---|
| h1 | Newsreader 500 | clamp(44px, 6vw, 76px) / 1.02, `text-wrap: balance` |
| h2 | Newsreader 500 | clamp(32px, 4.2vw, 50px) / 1.06 |
| h3 | Newsreader 500 | 24px / 1.15 |
| body | Hanken Grotesk 400 | 17px / 1.6, max-width 65ch, 16px min on mobile |
| small | Hanken Grotesk 500 | 14px |
| label | Hanken Grotesk 600 | 13px uppercase, letter-spacing .14em (12px floor) |
| price | Newsreader 500 | 34px, `font-variant-numeric: tabular-nums` |

## Spacing (density 3, spacious)

`--space-1: 8px; --space-2: 16px; --space-3: 24px; --space-4: 40px;
--space-5: 64px; --space-6: 96px; --space-7: 128px;`

Section padding `--space-6` (desktop) / `--space-5` (mobile). Container
1180px; gutters 24px mobile, 32px desktop. Radii: 12px cards, 999px pills,
0 for hairline-only blocks.

## Motion (standard tier)

Reveal on scroll 400ms `cubic-bezier(.22,.61,.36,1)`, stagger 60ms, from a
visible resting state under reduced motion. Hover 200ms. No autoplaying
marquees. All keyframes behind `@media (prefers-reduced-motion: no-preference)`.

## Components (shared in `assets/site.css`)

button (primary, secondary, text) · eyebrow · sec-head · proof-strip ·
work-card · service-row · process-step · price-card (+ featured) · testimonial ·
faq-item · cta-band · field (+ error) · modal (`<dialog>`, URL hash state) ·
skip-link · to-top.

## Accessibility floor

Contrast 4.5:1 text, 3:1 UI; visible `:focus-visible` ring on everything;
labels bound with `for`/`id`; buttons are `<button>`; 44px touch targets with
8px gaps; `aria-expanded` on disclosure controls; skip link; one `h1` per page;
`prefers-reduced-motion` honoured; images with `width`/`height`, `srcset`,
AVIF/WebP, lazy below the fold.
