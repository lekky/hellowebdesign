# HelloWebDesign site redesign proposal

**Date:** 2026-09-01
**Method:** UI/UX Pro Max skill (v2.13.0, installed at `.claude/skills/ui-ux-pro-max/`) run against the current site, plus a manual audit of `index.php`, `partials/`, `assets/site.css`, the service pages and the city pages.
**Status:** Proposal only. Nothing on the live site changes until each phase below is opened as a PR and approved.

---

## 1. The verdict in one paragraph

The site's *idea* is right and should stay: two named people, a photo of them, plain English, real prices. What holds it back is execution. The homepage buries its proof (portfolio, brand experience, reviews) under a long About block, runs two different primary-button colours in the first screen, ships 14 MB of PNG imagery with a 4.7 MB hero, and fails a handful of accessibility basics (no focus rings, unbound form labels, clickable `<span>`s, an auto-scrolling marquee with no pause). The redesign keeps the "Warm Editorial" identity, tightens it into a real token system shared by all 20 pages, reorders the homepage around the skill's **Trust & Authority + Conversion** pattern, and fixes every audit item below.

---

## 2. What the skill recommended, and what we kept

The generator was run three times. Its raw picks did **not** fit a local, personal studio, so per the skill's own contract (verify fit, retry, label anything unverified) the direction below is assembled from verified domain matches instead.

| Query | Generator output | Fit | Decision |
|---|---|---|---|
| "web design agency small business local studio personal warm" | Pattern: Funnel (3-step). Style: Minimalism & Swiss. Colours: emerald green + orange. Type: Caveat / Quicksand | Poor: palette ignores the teal logo, handwriting face reads as a party invite | Rejected; kept the Funnel idea as *one section* (Process) |
| "creative agency web design studio portfolio editorial" | Pattern: Scroll-Triggered Storytelling. Style: Brutalism. Colours: hot pink + cyan | Poor: brutalism contradicts "trustworthy, no-jargon" | Rejected |
| "local service business website design studio trust" `--variance 6 --motion 4 --density 3` | Same as first, Inter/Inter, spacious spacing scale, stagger motion preset | Spacing scale and motion tier are useful | Kept the density-3 spacing scale and the "Standard" motion tier |

Verified matches used instead (all from the skill's own database):

- **Landing pattern:** `trust-authority-conversion`. Section order: Hero (credibility) > Proof (logos, stats, reviews) > Solution > Clear CTA path. Transparent pricing, low-friction form, static logo set under reduced motion.
- **Supporting patterns:** `hero-testimonials-cta` (social proof placed *before* the final CTA) and `portfolio-grid` (visuals first, neutral ground, minimal accent).
- **Style:** `editorial-grid-magazine`. Asymmetric grid, large imagery, print-inspired type, reveal on scroll. This is what "Warm Editorial" was reaching for.
- **Typography:** `News Editorial` pairing. The database independently recommends **Newsreader** for "trustworthy, readable" editorial headings, which the site already uses. Its body partner is Roboto; we keep **Hanken Grotesk** (already loaded, warmer, humanist) as a deliberate deviation.
- **Colour:** no database palette matches a teal-on-cream brand, so the palette below is the existing brand corrected for contrast. Closest reference: `Real Estate/Property` ("trust teal") and `Notes & Writing` ("warm ink on cream").
- **UX rules applied** (domain `ux`): focus appearance, error summary + inline validation, reduced-motion, autoplay pause, touch target spacing, URL reflects state, skip link, 16 px body on mobile, WebP + lazy loading, fixed nav must not obscure content.

---

## 3. Design system

Persisted in the skill's format at `docs/design-system/hellowebdesign/MASTER.md`.

### 3.1 Colour tokens

Contrast ratios measured against the ground each token is meant for.

| Token | Value | Role | Contrast |
|---|---|---|---|
| `--paper` | `#f7f3ea` | Page ground | |
| `--paper-2` | `#efe8d9` | Alternate section ground | |
| `--ink` | `#33373b` | Headings, body on light | 10.8:1 on paper |
| `--muted` | `#5a554b` *(was `#6f6a5f`)* | Secondary text | 6.1:1 on paper-2 (old value: 4.4:1, fails AA) |
| `--teal` | `#60bfb5` | Fills, highlights, accents on dark. **Never as text on light** | 2.2:1 on white (fails) |
| `--teal-text` | `#266860` *(new)* | Eyebrows, inline links, small teal text on light | 5.3:1 on paper-2, 5.9:1 on paper |
| `--teal-deep` | `#2f7a72` | Large display accents only (the italic *grow*) | 4.6:1 on paper (large text passes) |
| `--teal-ink` | `#173f3a` | Hover fills, dark teal surfaces | |
| `--charcoal` / `-2` / `-3` | `#33373b` / `#2a2d31` / `#212327` | Dark bands (contact, footer, featured card) | |
| `--line` | `#e2dbcb` | Hairlines and borders | |
| `--focus` | `#1d6f66` *(new)* | 3 px focus ring on light; `--teal` on dark | |

**One CTA colour.** Today the nav button is teal-filled and the hero button is charcoal-filled: two competing primaries in the first screen. Rule: primary = charcoal fill, paper text; secondary = 1.5 px charcoal outline; text link = `--teal-text` with underline on hover. Teal is a highlight, not a button.

### 3.2 Typography

| Role | Face | Size | Notes |
|---|---|---|---|
| Display (h1) | Newsreader 500, opsz 72 | `clamp(44px, 6vw, 76px)`, line-height 1.02 | `text-wrap: balance`; italic teal-deep for the one emphasised word |
| Section (h2) | Newsreader 500 | `clamp(32px, 4.2vw, 50px)`, 1.06 | |
| Card / row (h3) | Newsreader 500 | 24 px, 1.15 | |
| Body | Hanken Grotesk 400 | 17 px, 1.6, max 65 ch | 16 px minimum on mobile |
| Small | Hanken Grotesk 500 | 14 px | Meta, captions |
| Label | Hanken Grotesk 600 | 13 px, uppercase, 0.14 em tracking | **Floor is 12 px.** Current `.wc-cat` (10.5 px), `.badge-new` (10.5 px) and `.feat-badge` (11 px) go up |
| Prices | Newsreader 500, `font-variant-numeric: tabular-nums` | 34 px | Digits align across cards |

### 3.3 Spacing and layout

Density dial 3 (spacious): `--space-1..7` = 8 / 16 / 24 / 40 / 64 / 96 / 128 px. Section padding `--space-6` desktop, `--space-5` mobile. Container 1180 px, gutters 24 px mobile / 32 px desktop. Grid: 12 columns; hero and about use asymmetric 7/5 splits rather than 50/50.

### 3.4 Motion

Standard tier. Reveal on scroll: 400 ms, `cubic-bezier(.22,.61,.36,1)`, stagger 60 ms. Hover: 200 ms. **Everything** animated sits behind `prefers-reduced-motion`, including the three keyframes that currently do not (`pulse`, `floaty`, `marq`) and `scroll-behavior: smooth`.

### 3.5 Components (shared, in `assets/site.css`)

Button (primary / secondary / text), eyebrow, section head, proof strip, work card, service row, process step, price card (+ featured variant), testimonial, FAQ item, CTA band, form field (+ error state), modal. Today the price card, testimonial, reveal and modal CSS live inline in `index.php` and are re-declared with drift on the service pages.

---

## 4. Homepage blueprint

| # | Current order | Proposed order | Why |
|---|---|---|---|
| 1 | Hero | **Hero** with proof line inside the fold | Pattern: hero carries credibility |
| 2 | Brand marquee | **Proof strip** (static): "20+ yrs with Next, Iceland, Pets at Home, SimplyBe" + review rating | No autoplay, no pause problem, readable at rest |
| 3 | About (long) | **Work** (6 featured, "all projects" link) | Portfolio pattern: visuals first, proof before pitch |
| 4 | Work | **Services** (4 rows, each linking to its page) | Solution after proof |
| 5 | Services | **How it works** (3 steps: Chat, Build, Launch, "live within a week") | The one place the Funnel pattern earns numbering; answers "what happens next" |
| 6 | Why us | **Pricing**: packages and care plans in one section, same card | One price surface, tabular figures, one "Most popular" |
| 7 | Packages | **Testimonials** with name, business, initial avatar | Social proof directly before the final CTA |
| 8 | Care plans | **About Hanna & Rachid** (shorter, with real numbers) | Story after the reader is already interested |
| 9 | Testimonials | **FAQ** | Unchanged |
| 10 | FAQ | **Contact** | Unchanged position, fixed form |
| 11 | Contact | Footer | |

Hero specifics:

- Headline stays a promise, but a specific one: "Websites for small businesses, built by the two people you'll actually talk to." (or keep the current line; copy is the owners' call).
- One primary button ("Start your project") + one text link ("See our work"). Remove the second filled button.
- Under the buttons, a single quiet proof line: review stars + "Live within a week" + "From £499". This replaces the pill.
- **Mobile:** the couple photo currently falls below the fold, so the site's thesis (real people) is invisible on the device most local searches come from. Use a landscape crop or the "Hanna & Rachid" tag as a compact strip above the buttons.
- Mobile nav goes cream like desktop (today it flips to charcoal and swaps logos, which reads as a different site).

"Why pick us" is folded into About and the Process section; its four points are restated as the proof line and step copy rather than a separate grid.

---

## 5. Audit: what is broken now and where

Severity: **A** = accessibility failure, **P** = performance, **C** = consistency/UX.

| Sev | Finding | Location | Fix |
|---|---|---|---|
| A | Focus ring removed on inputs, none defined anywhere else | `index.php:224` `input:focus{outline:none}`; no `:focus-visible` in `site.css` | Global `:focus-visible` 3 px `--focus` ring, 2 px offset |
| A | Form labels not bound to inputs | `index.php:540-547` (`<label>` without `for`, inputs without `id`) | Add `id`/`for`; add `aria-describedby` for the reCAPTCHA note |
| A | Add-on chips are clickable `<span>`s: no keyboard, no role | `index.php:442`, handler `index.php:770-776` | Make them `<button type="button">` |
| A | Project modal: no focus trap, focus not returned, background not inert | `index.php:707-725` | `<dialog>` element or focus trap + `inert`; return focus to the card |
| A | Mobile menu button has no `aria-expanded` / `aria-controls` | `partials/nav.php:11`, `assets/site.js` | Add both, toggle on click, close on Escape |
| A | Marquee autoplays with no pause control; `marq`, `floaty`, `pulse` ignore reduced-motion | `index.php:106-114` | Replace with static proof strip; guard remaining keyframes |
| A | `scroll-behavior: smooth` not guarded | `assets/site.css:19` | Wrap in `prefers-reduced-motion: no-preference` |
| A | Secondary text fails AA on alternate ground (4.4:1) | `--muted` on `--paper-2`, e.g. Work and Why section intros | `--muted: #5a554b` |
| A | Teal eyebrow text on paper-2 is 4.2:1 | `.work .eyebrow` `index.php:130` | `--teal-text: #266860` for all teal text on light |
| A | Labels below 12 px | `.wc-cat` 10.5 px, `.badge-new` 10.5 px, `.feat-badge` 11 px (`index.php:139-140,193`) | 13 px label token |
| A | Touch targets under 44 px | `.addons span` ~38 px tall; footer links 14 px with 9 px gap (`site.css:86`) | 44 px min-height, 8 px+ gaps |
| A | No skip link; sections re-use `.why` class for testimonials | `partials/nav.php`, `index.php:472` | Skip link to `#main`; semantic section classes |
| P | Hero image is a 4.7 MB PNG at 2399 px wide for a ~520 px column | `assets/couple.png`, `index.php:298` | AVIF/WebP + `srcset` (480/800/1200), PNG fallback. Expect ~150 KB |
| P | 14.3 MB of PNG across `assets/`; no modern formats, no `srcset` anywhere | `assets/*.png` | Convert all 12 photos; keep logo PNGs |
| P | Modal loads full-size project PNG on open | `index.php:710` | Use the WebP variants |
| C | Two primary button colours in the first screen | nav `.nav-cta` teal vs hero `.btn-fill` charcoal | One primary style |
| C | Mobile nav changes colour and logo | `site.css:46-48` | Same cream nav at all widths |
| C | ~200 lines of page-specific CSS per page; price card, quote, reveal, modal re-declared across 18 pages | `index.php:85-284`, service pages' `<style>` | Move components into `site.css`; pages keep only true one-offs |
| C | Stats are filler ("2 person team", "100% hands-on") | `index.php:325-329` | Real figures: sites launched, years, typical reply time |
| C | Project modal has no URL, so a project cannot be shared or reached by back button | `index.php:707-725` | `#project=flok` hash state, `popstate` closes |
| C | Section intro copy centred on some sections, left on others | `index.php:412,450,474,489` inline styles | One `sec-head` alignment per section type |

---

## 6. The whole site, not just the homepage

The proposal covers all 20 public pages. The shared partials already exist (`partials/head.php`, `nav.php`, `footer.php`); the redesign extends the sharing to components.

| Page group | Count | Change |
|---|---|---|
| Homepage `index.php` | 1 | Full restructure per section 4 |
| Service pages: small-business-websites, wedding-websites, social-media-management | 3 | Same components: hero with proof line, "What's included", pricing card (same as home), portfolio grid filtered to that service, FAQ, CTA band. Drop their private copies of card CSS |
| Area hub `web-design-greater-manchester` + 13 city pages | 14 | Keep the SEO copy and schema untouched. Apply tokens, proof strip, shared work grid and CTA band. Add a "nearby areas" row so the pages link laterally |
| `/info/` intake page | 1 | Same tokens and form component, including the inline validation and error summary; keep `send-intake.php` as is |
| Partials | 3 | Skip link and `aria-expanded` in `nav.php`; footer links get 44 px targets |

Everything the contact form depends on (field names, reCAPTCHA pair, `data-prefill`, the `?status=` redirect) is unchanged.

---

## 7. Rollout (one PR each, none merged without a go-ahead)

1. **Phase 0, no visual change:** image pipeline (AVIF/WebP + `srcset`), focus rings, bound labels, button chips, `aria-expanded`, reduced-motion guards, contrast token corrections. Shippable in a day and safe to deploy first.
2. **Phase 1, foundation:** token set and shared components into `site.css`; pages keep working unchanged.
3. **Phase 2, homepage:** new section order, hero, proof strip, process, merged pricing, modal with URL state.
4. **Phase 3, service and area pages:** adopt shared components; nearby-areas row.
5. **Phase 4, intake page.**

Each PR is checked with the skill's pre-delivery list before it is opened.

---

## 8. Pre-delivery checklist (from the skill)

- [ ] No emojis as icons (SVG only: existing inline icons kept, add Lucide where new ones are needed)
- [ ] `cursor: pointer` on every clickable element
- [ ] Hover states 150–300 ms
- [ ] Light mode text contrast 4.5:1 minimum (measured, see 3.1)
- [ ] Focus states visible for keyboard navigation
- [ ] `prefers-reduced-motion` respected everywhere
- [ ] Responsive at 375, 768, 1024, 1440 px
- [ ] 16 px body text on mobile; no label under 12 px
- [ ] Touch targets 44 px with 8 px spacing
- [ ] Images: modern format, `srcset`, `width`/`height` reserved, lazy below the fold
- [ ] Skip link, landmarks, one `h1` per page
- [ ] Contact form: labels bound, inline validation, error summary focused on failed submit

---

## Appendix: how to re-run the skill

```bash
# design system (marketing density)
python3 .claude/skills/ui-ux-pro-max/scripts/search.py "local service business website design studio trust" \
  --design-system --variance 6 --motion 4 --density 3 -p "HelloWebDesign"

# focused searches
python3 .claude/skills/ui-ux-pro-max/scripts/search.py "focus ring" --domain ux
python3 .claude/skills/ui-ux-pro-max/scripts/search.py "trust conversion" --domain landing
python3 .claude/skills/ui-ux-pro-max/scripts/search.py "editorial serif" --domain typography
```
