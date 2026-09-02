# HelloWebDesign

Static marketing site for **hellowebdesign.co.uk** (a husband-and-wife web design
studio). Plain `index.html` + `assets/` + a PHP contact handler. No build step.

## Structure
- `index.php` — the homepage (inline page CSS + JS, "Warm Editorial" design); shared head/nav/footer come from `partials/`
- `send.php` — contact-form handler: reCAPTCHA v3 verify + `mail()`, redirects to `?status=success|error#contact`
- `assets/` — logo, team photos, 9 project shots, shared `site.css` / `site.js`
- service pages (`small-business-websites/`, `wedding-websites/`, `social-media-management/`), area hub + 13 city pages (`web-design-*/`), `info/` intake page
- `.github/workflows/deploy.yml` — auto-deploy on push to `main`

## UI/UX Pro Max skill
`.claude/skills/ui-ux-pro-max/` is committed (the rest of `.claude/` stays ignored; deploy excludes `.claude/**`).
Use it for any visual/UX work. Search: `python3 .claude/skills/ui-ux-pro-max/scripts/search.py "<query>" --domain <ux|style|color|typography|landing|icons>`.
The site's verified design system lives at `docs/design-system/hellowebdesign/MASTER.md`; the redesign
proposal is `docs/redesign/2026-09-01-ui-ux-pro-max-redesign-proposal.md`.

## Deploy ⚠️ pushes to `main` go LIVE
Merging to `main` triggers GitHub Actions → uploads over **explicit FTPS, port 21**
to `/public_html`. The host is **FTP, not SFTP**, despite secrets being named `SFTP_*`.

**Ship changes this way — never push straight to `main`:**
1. `git fetch origin && git checkout -B main origin/main` (resync — see gotcha)
2. branch, commit, open a PR — then **STOP**
3. **Never merge/squash a PR without the user's explicit go-ahead for that specific PR.**
   Approval to make a change is NOT approval to deploy it. Open the PR and wait.
4. once approved: squash-merge, watch the run, then `curl` the live URL to verify

**Gotchas:**
- Squash-merge makes local `main` diverge from `origin/main` (`pull --ff-only` aborts).
  Always resync with `checkout -B main origin/main` before branching.
- Deploys occasionally fail with `Timeout (control socket)` — transient FTP hiccup,
  just `gh run rerun <id> --failed`.
- The design source bundle (`_design/`, `_design_index.html`) is git-ignored — never deploy it.

## Contact form
Form fields: `name`, `phone`, `email`, `business_name`, `interested_package`, `message`,
`g-recaptcha-response`. reCAPTCHA v3 badge is hidden with the required disclosure text;
keep both the site key (in `index.html`) and the secret (in `send.php`) in sync as a pair.
Package/add-on CTAs prefill the `interested_package` select via `data-prefill`.
