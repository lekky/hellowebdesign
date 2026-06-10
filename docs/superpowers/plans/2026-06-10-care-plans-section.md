# Care Plans Section Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Add a two-tier monthly "care plans" section to the homepage that prefills the contact form, turning one-off builds into recurring revenue.

**Architecture:** Pure static edit to `index.php`. Reuses the existing `.pkg` card styling and the `data-prefill` → contact-`<select>` mechanism. No payment integration; enquiry-via-form like the rest of the site.

**Tech Stack:** PHP partials + inline HTML/CSS/JS. No build step. No PHP locally — verify with `.dev/render.mjs` + preview tools.

---

## File Structure

All changes are in a single file:

- **Modify** `index.php`:
  - Inline `<style>` block (~line 198) — add care-plans CSS.
  - After `#packages` `</section>` (line 440) — new `#care-plans` section.
  - Contact `<select>` (line 512) — two new `<option>`s.
  - FAQ list (after the last `.faq-item`, line 489) — one new item.

No tests exist in this repo; verification is render + browser preview.

**Exact-match contract:** each plan CTA's `data-prefill` text MUST equal a contact-`<select>` option's text exactly (options have no `value` attr, so `select.value = "..."` matches on text). Strings used: `Care Plan - Essentials`, `Care Plan - Complete` (plain hyphen, single spaces).

---

### Task 1: Add care-plans CSS

**Files:**
- Modify: `index.php` (inline `<style>`, immediately after line 198 — the `@media(max-width:560px){.pkg-grid{grid-template-columns:1fr}}` rule)

- [ ] **Step 1: Add the CSS block**

Insert these rules right after the existing `@media(max-width:560px){.pkg-grid{grid-template-columns:1fr}}` line:

```css
.care-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:18px;max-width:680px;margin:0 auto}
.price .per{font-size:15px;color:var(--muted);font-weight:500}
.pkg.feat .price .per{color:#aecfca}
.care-note{text-align:center;font-size:13.5px;color:var(--muted);margin-top:22px}
@media(max-width:560px){.care-grid{grid-template-columns:1fr}}
```

- [ ] **Step 2: Commit**

```bash
git add index.php
git commit -m "Add care-plans CSS (2-col grid, /mo price suffix, note)"
```

---

### Task 2: Add the Care Plans section

**Files:**
- Modify: `index.php` (after the `#packages` closing `</section>` at line 440, before the `<!-- TESTIMONIALS -->` comment)

- [ ] **Step 1: Insert the section HTML**

Insert this block on a new line after line 440 (`</section>` of `#packages`) and before `<!-- TESTIMONIALS -->`:

```html

<!-- CARE PLANS -->
<section id="care-plans" style="background:var(--paper-2)">
  <div class="wrap">
    <div class="sec-head reveal" style="margin-left:auto;margin-right:auto;text-align:center">
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
```

- [ ] **Step 2: Commit**

```bash
git add index.php
git commit -m "Add care-plans section to homepage"
```

---

### Task 3: Wire up the contact select + FAQ

**Files:**
- Modify: `index.php` (contact `<select>` line 512; FAQ list after line 489)

- [ ] **Step 1: Add two options to the contact select**

In the `<select name="interested_package" ...>` at line 512, add two options after `<option>Social Media Management</option>` and before `<option>Web / Mobile Application</option>`:

```html
<option>Care Plan - Essentials</option><option>Care Plan - Complete</option>
```

The resulting select option order: Starter, Business, E-Commerce, Wedding, Social Media Management, **Care Plan - Essentials, Care Plan - Complete**, Web / Mobile Application, Something else.

- [ ] **Step 2: Add a FAQ item**

After the last `.faq-item` (the "I already have a website" item ending at line 489) and before the closing `</div>` of `.faq`, insert:

```html
      <div class="faq-item">
        <button class="faq-q" aria-expanded="false">What happens after my site goes live?<span class="pm"></span></button>
        <div class="faq-a"><div class="faq-a-inner"><p>We don't disappear once you're online. Our optional care plans keep your site secure, backed up and updated - and the Complete plan includes an hour of changes each month. There's no obligation: plenty of clients look after their own site, and that's fine too.</p></div></div>
      </div>
```

- [ ] **Step 3: Commit**

```bash
git add index.php
git commit -m "Wire care plans into contact select + add FAQ entry"
```

---

### Task 4: Verify in browser preview

**Files:** none (verification only)

- [ ] **Step 1: Render the PHP includes to static HTML**

Run: `node .dev/render.mjs` (emulates the PHP partials — no PHP on this machine; see memory `local-no-php-verify`)
Expected: regenerates the `.dev/*.html` files without error.

- [ ] **Step 2: Start the preview server and load the homepage**

Use `preview_start` (serve the rendered homepage), then load it.

- [ ] **Step 3: Check console + structure**

- `preview_console_logs` — expected: no errors.
- `preview_snapshot` — confirm the "Care Plans" section exists between Packages and Testimonials, both cards render, the "Most popular" badge is on the Complete card.

- [ ] **Step 4: Confirm the prefill works**

- `preview_click` the **Essentials** "Get started" button.
- `preview_snapshot` / inspect the `select[name="interested_package"]` — expected value: `Care Plan - Essentials`.
- Repeat for **Complete** — expected value: `Care Plan - Complete`.

- [ ] **Step 5: Visual proof (desktop + mobile)**

- `preview_screenshot` of the care-plans section at default width.
- `preview_resize` to ~390px, `preview_screenshot` — expected: cards stack to one column, prices show `/mo`.

- [ ] **Step 6: Push the branch and open the PR — then STOP**

```bash
git push -u origin feat/care-plans-section
gh pr create --fill --base main
```

Per `CLAUDE.md`: do **not** merge. Open the PR and wait for the user's explicit go-ahead for this specific PR (merging to `main` deploys live).

---

## Notes

- Copy uses plain hyphens and `&pound;` / `&amp;` entities to match the surrounding file's style.
- The `reveal` / `d1` classes give the cards the same scroll-in animation as the rest of the page; no JS changes needed — the existing `[data-prefill]` and reveal handlers pick them up automatically.
