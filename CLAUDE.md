# HelloWebDesign

Static marketing site for **hellowebdesign.co.uk** (a husband-and-wife web design
studio). Plain `index.html` + `assets/` + a PHP contact handler. No build step.

## Structure
- `index.html` — the entire single-page site (inline CSS + JS, "Warm Editorial" design)
- `send.php` — contact-form handler: reCAPTCHA v3 verify + `mail()`, redirects to `?status=success|error#contact`
- `assets/` — logo, team photos, 9 project shots
- `.github/workflows/deploy.yml` — auto-deploy on push to `main`

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
