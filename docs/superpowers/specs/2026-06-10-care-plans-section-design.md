# Care Plans section — design

**Date:** 2026-06-10
**Status:** Approved (pending spec review)

## Goal

Add a recurring monthly "care plan" offering to the homepage. Competitive
research ([competitor-gaps-2026-06](../../../memory)) found that every local
North-West rival monetises ongoing care/maintenance while hellowebdesign sells
only one-off builds. Care plans turn each £499 build into recurring revenue and
give post-launch clients an obvious next step.

This is a **marketing/lead-gen** section, not a billing system. It follows the
same enquiry-via-contact-form model the rest of the site uses — no payment
integration.

## Scope

### In scope
- New homepage section presenting two care-plan tiers.
- Each plan's CTA prefills the contact-form package `<select>`.
- Two new options in that `<select>` so the prefill lands on a real value.
- One new FAQ entry pointing at the care plans.

### Out of scope (YAGNI)
- Real recurring-payment / subscription integration.
- A nav link to the section.
- Care plans on the SEO landing pages (homepage only for now).

## Placement

New `<section id="care-plans">` inserted **after** the `#packages` section
(currently ends at `index.php:440`) and **before** the Testimonials section.
Flow: build packages → ongoing care → social proof.

## Tiers

Two tiers. Hosting included in both (the anchor that makes a care plan feel
worth paying for).

### Essentials — £19/mo  (`.btn-line`, prefill `Care Plan – Essentials`)
- Secure hosting & domain renewal handled
- SSL certificate + daily backups
- Software & security updates
- Uptime monitoring
- Email support

### Complete — £49/mo  (`.pkg.feat` + "Most popular" badge, `.btn-fill`, prefill `Care Plan – Complete`)
- Everything in Essentials, plus:
- Up to 1 hour of content edits/changes each month
- Priority support (same-day where possible)
- Monthly performance check
- Small seasonal tweaks (e.g. opening hours, offers)

## Layout & styling

- Reuse the existing `.pkg` card styling (defined inline in `index.php`
  ~lines 175–198): `.pkg`, `.pkg-name`, `.pkg-sub`, `.price`, `.pkg.feat`,
  `.feat-badge`, `.btn`, `.btn-line`, `.btn-fill`.
- **Do not** reuse the 4-column `.pkg-grid`; two cards in a 4-col grid look
  stranded. Use a dedicated centred 2-column grid (e.g. a `care-grid` class:
  `display:grid; grid-template-columns:repeat(2,1fr); gap:18px; max-width:680px;
  margin:0 auto`). Collapse to 1 column at the existing `560px` breakpoint.
- Price shows a small `/mo` suffix. Add a `.price .per` span style
  (smaller font, muted) rather than baking "/mo" into the 34px serif number.
- Section header uses the standard `.sec-head` + `.eyebrow` pattern, centred,
  matching the `#packages` header.
- Reassurance line under the grid: **"No contracts — cancel any time."**
  (small, muted, centred).

## Copy

- Eyebrow: `Care Plans`
- Heading: **After launch, we've got your back**
- Sub-line: one sentence, e.g. *"Your website kept secure, updated and online —
  so you can get on with running your business."*
- Reassurance line: *"No contracts — cancel any time."*

## Integration points

1. **Contact form select** (`index.php:512`): add two `<option>`s —
   `Care Plan – Essentials` and `Care Plan – Complete` — so the `data-prefill`
   CTAs resolve to real options. The existing prefill JS
   (`index.php:733`, matches option text) needs no change.
2. **FAQ**: add one item after the existing six —
   Q: *"What happens after my site goes live?"*
   A: explains we don't disappear; optional care plans keep the site secure,
   backed up and updated, with a monthly allowance of changes on the Complete
   plan; no obligation.

## Verification

Local machine has no PHP ([local-no-php-verify](../../../memory)). Render with
`.dev/render.mjs` to emulate the PHP includes, serve via the preview tools, and
screenshot the new section (desktop + mobile width) before opening the PR.
Confirm: cards render, prices show `/mo`, the "Most popular" badge sits on the
Complete card, and clicking each CTA scrolls to `#contact` with the correct
option pre-selected.

## Deploy

Standard flow per `CLAUDE.md`: branch → commit → open PR → **stop** and wait for
explicit go-ahead before squash-merge (merging to `main` goes live).
