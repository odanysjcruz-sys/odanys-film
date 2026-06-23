# CLAUDE_CONTEXT.md
> Persistent memory for Claude Code sessions. Read this at the start of every session before making any changes.

---

## Project Overview

**Odanys Media** — filmmaker & creative director portfolio for Odanys De La Cruz.
Single-page Laravel application serving as a professional showcase with sections:
Hero → About → Portfolio (Work) → Services → Brands → Testimonials → Contact.

- **Live site:** https://odanysmedia.com (Namecheap shared hosting / cPanel)
- **Local dev:** http://odanys-film.test (Laragon, folder: `C:\laragon\www\odanys-film`)
- **GitHub:** https://github.com/odanysjcruz-sys/odanys-film (private)
- **Owner email:** odanysj.cruz@gmail.com

---

## Tech Stack

| Layer | Technology | Version |
|-------|-----------|---------|
| Backend framework | Laravel | ^13.8 |
| PHP | PHP | ^8.3 |
| Frontend bundler | Vite | ^8.0 |
| CSS framework | Bootstrap | ^5.3.8 |
| Database | SQLite | (file-based, no MySQL needed) |
| Mail | SMTP via cPanel (`hello@odanysmedia.com`) | — |
| Hosting | Namecheap shared hosting / cPanel | — |
| Video embeds | Vimeo (lightbox modal) | — |
| Version control | Git + GitHub | — |

**Key npm devDependencies:** `vite`, `laravel-vite-plugin`, `tailwindcss` (installed but not used — Bootstrap is the active CSS framework), `concurrently`

---

## Current Architecture

```
odanys-film/
├── app/
│   ├── Http/Controllers/
│   │   └── ContactController.php   ← handles contact form POST
│   └── Mail/
│       └── ContactFormMail.php     ← mailable for contact form
├── resources/
│   ├── css/app.css                 ← all custom CSS (no Tailwind in use)
│   ├── js/app.js                   ← all custom JS (Bootstrap import + custom)
│   └── views/
│       ├── welcome.blade.php       ← single page (all sections)
│       ├── layouts/app.blade.php   ← base layout (head, scripts, body)
│       ├── partials/
│       │   ├── navbar.blade.php    ← sticky glass navbar
│       │   └── footer.blade.php    ← footer with social links
│       └── emails/
│           └── contact.blade.php  ← email template for contact form
├── public/
│   ├── images/                    ← all static images served directly
│   │   ├── poster-me-llamas.jpg   ← portfolio card poster (1920x1440, 346 KB)
│   │   ├── poster-pacto.jpg       ← portfolio card poster (1920x1080, 160 KB)
│   │   ├── hero.png               ← hero background
│   │   ├── about.png / aboutme.jpeg
│   │   ├── srv-*.jpg/png          ← services section carousel images
│   │   ├── brand-*.png/jpg        ← brand logos
│   │   └── logo-odanys.png / odanys_logo_final.png
│   ├── build/                     ← Vite output (committed to git for Namecheap)
│   └── .htaccess
├── deploy/
│   ├── public_html_index.php      ← modified index.php for Namecheap web root
│   └── env.production             ← production .env template
├── .cpanel.yml                    ← cPanel Git deployment automation
├── DEPLOY.md                      ← full Namecheap deployment guide
└── vite.config.js
```

### Key component interactions
- All page content lives in `welcome.blade.php`, composed inside `layouts/app.blade.php`
- `navbar.blade.php` and `footer.blade.php` are `@include`d into the layout
- CSS and JS are compiled by Vite into `public/build/` and referenced via `@vite` in the layout
- Contact form POSTs to `ContactController`, which sends mail via `ContactFormMail`
- Portfolio cards use `data-vimeo="VIDEO_ID"` — JS opens a lightbox modal on click

---

## Decisions Made

### Deployment: manual Git push + cPanel deploy (no CI/CD)
- Namecheap shared hosting does not support webhooks or auto-deploy from GitHub
- Workflow: `npm run build` → `git push` → cPanel Git Version Control → "Deploy HEAD Commit"
- `public/build/` is committed to git because Namecheap has no Node.js to build assets server-side

### Server directory layout (CRITICAL — learned 2026-06-23)
```
~/laravel/          ← Laravel app (PHP, blade views, vendor, config). NOT a git repo.
~/laravel-git/      ← cPanel Git Version Control clone of GitHub repo (actual git repo)
~/public_html/      ← Web root. index.php bootstraps from ~/laravel/
~/public_html/build/       ← Vite compiled CSS/JS (copied here by .cpanel.yml)
~/public_html/images/      ← Static images (copied here by .cpanel.yml)
```
- `~/home/` is a cPanel symlink to `/home/` — `find` traverses it and shows doubled paths like
  `/home/odanzuii/home/odanzuii/laravel-git/.git`. The real path is `~/laravel-git/`.
- `git` binary is at `/usr/bin/git` (NOT `/usr/local/bin/git`)
- `ls`, `cp` not in default PATH — use `/bin/ls`, `/bin/cp`, `/bin/find`

### What .cpanel.yml updates vs. what it doesn't
- **DOES update:** `~/public_html/build/` and `~/public_html/images/`
- **DOES NOT update:** `~/laravel/resources/views/`, `~/laravel/public/build/manifest.json`
- After any change to blade views or JS/CSS, you must ALSO manually sync `~/laravel/` via File Manager ZIP upload (see Emergency deploy below)

### Laravel app above web root
- Full app lives at `~/laravel/` on the server; `public/` contents go to `~/public_html/`
- `deploy/public_html_index.php` is the modified entry point that points to `~/laravel/`
- `.cpanel.yml` automates: `composer install`, copying `public/build/` and assets to `public_html/`, `php artisan optimize`

### Database: SQLite
- Portfolio is read-only; no user accounts or dynamic data
- SQLite requires zero server config on shared hosting

### Videos: Vimeo lightbox (not self-hosted)
- Original self-hosted MP4s were too large for shared hosting (250 MB cPanel upload limit)
- Clicking a portfolio card opens a full-screen lightbox with Vimeo iframe (autoplay, no branding)
- Closes via backdrop click, ✕ button, or Escape key

### Portfolio card thumbnails: local JPEG posters (not Vimeo oEmbed)
- Vimeo oEmbed API returned low-resolution thumbnails
- Replaced with high-quality local JPEGs compressed to ~160–350 KB via PowerShell + System.Drawing
- Uses `<img class="film-poster" loading="lazy">` with `object-fit: cover`

### CSS: custom only (Bootstrap grid + utilities, no Tailwind)
- Tailwind is installed but unused — all design is handwritten in `resources/css/app.css`
- Bootstrap is used for grid (`container`, `row`, `col-*`) and a few utilities only

### Mail: MAIL_SCHEME=ssl (not MAIL_ENCRYPTION)
- Laravel 13 reads `MAIL_SCHEME`; the old `MAIL_ENCRYPTION` key is silently ignored
- Port 465 with SSL via cPanel email account `hello@odanysmedia.com`

---

## Portfolio Cards — Current State

| # | Title | Vimeo ID | Poster image | Status |
|---|-------|----------|-------------|--------|
| A-01 | Me Llamas | `1203313171` | `poster-me-llamas.jpg` | Complete |
| A-02 | Pacto | `1203313238` | `poster-pacto.jpg` | Complete |
| A-03 | Raíces | — | — (gradient placeholder) | Vimeo URL + poster needed |

---

## Social Links — Current State

| Platform | Navbar | Footer |
|----------|--------|--------|
| Instagram | https://www.instagram.com/odanys_media/ | https://www.instagram.com/odanys_media/ |
| LinkedIn | `href="#"` placeholder | `href="#"` placeholder |
| Vimeo | https://vimeo.com/user260222135 | https://vimeo.com/user260222135 |
| YouTube | Commented out (no channel yet) | Commented out (no channel yet) |

---

## Progress Log

| Commit | What was done |
|--------|--------------|
| `63fdbfb` | Initial commit — full portfolio built (hero, about, work, services, brands, testimonials, contact) |
| `c3710c0` | Major overhaul: theming, service images, new sections |
| `c5a2420` | Services redesign, brand logos, carousels, testimonial animations |
| `cb15cbb` | Scroll animations for Services and Contact, footer update |
| `407e0b0` | Production-ready contact form for Namecheap cPanel |
| `ef14995` | Added DEPLOY.md, deploy/public_html_index.php, deploy/env.production |
| `b9cfc6f` | Added .cpanel.yml, un-excluded public/build from .gitignore, connected GitHub remote |
| `700c53f` | Replaced local MP4 videos with Vimeo lightbox; Vimeo profile links wired; YouTube commented out |
| `330969d` | Replaced oEmbed thumbnails with local JPEG posters; removed oEmbed JS fetch |
| `69c6e73` | New Pacto poster (Screenshot 2026-06-23), compressed both posters to JPEG 1920px |

---

## Pending Tasks

### Immediate
- [ ] **A-03 Raíces** — provide Vimeo URL and poster image to complete the third portfolio card
- [ ] **Social links** — add real URLs for Instagram and LinkedIn in navbar and footer
- [ ] **YouTube** — uncomment YouTube icon in navbar + footer once channel URL is available
- [ ] **Deploy** current changes to production via cPanel Git Version Control

### Future improvements
- [ ] Optimize `hero.png` (currently referenced but large — run through Squoosh)
- [ ] Add `<meta>` OG tags and Twitter card for social sharing previews
- [ ] Consider WebP versions of poster images for modern browsers (`<picture>` element)
- [ ] Add a loading skeleton or blur-up for poster images on slow connections

---

## Commands & Setup

### Local development
```powershell
# Start: open Laragon and click "Start All"
# Browse to: http://odanys-film.test

# Build assets (required before committing or deploying)
npm run build

# Clear Laravel caches if something looks stale
php artisan config:clear
php artisan cache:clear
```

### Deploy to production (every time)
```powershell
# 1. Build
npm run build

# 2. Commit + push
git add -A
git commit -m "describe what changed"
git push origin master
```

Then upload **two ZIPs** via cPanel File Manager (see "Emergency manual deploy" below).

> **Note:** cPanel Git Version Control "Update from Remote" does NOT work — the server
> can't authenticate with the private GitHub repo via HTTPS. Always use the ZIP method.
> The .cpanel.yml is kept in sync in git but the git deploy path is currently broken.

### Emergency manual deploy (when blade/CSS/JS changes don't appear on server)
The cPanel git deploy does NOT update `~/laravel/` (the running app). If views or assets look stale:

**Two ZIPs to create and upload via File Manager:**

ZIP 1 → extract to `/home/odanzuii/laravel` (updates blade templates + manifest):
- `public/build/manifest.json`
- `public/build/assets/app-*.js`
- `public/build/assets/app-*.css`
- `resources/views/**`

ZIP 2 → extract to `/home/odanzuii/public_html` (makes CSS/JS accessible to browser):
- `build/assets/app-*.js`
- `build/assets/app-*.css`
- `build/manifest.json`

Then run in Terminal: `php /home/odanzuii/laravel/artisan optimize:clear`

### Environment — local `.env` key values
```
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost        ← fine for local; Laragon doesn't need it
DB_CONNECTION=sqlite
MAIL_MAILER=smtp
MAIL_HOST=odanysmedia.com
MAIL_PORT=465
MAIL_SCHEME=ssl                 ← Laravel 13 — use MAIL_SCHEME not MAIL_ENCRYPTION
MAIL_USERNAME=hello@odanysmedia.com
MAIL_TO_ADDRESS=hello@odanysmedia.com
```

### First-time setup on a new machine
```powershell
composer install
cp .env.example .env
php artisan key:generate
npm install
npm run build
# Start Laragon → browse http://odanys-film.test
```

---

## Session Summaries

### Session — 2026-06-21
- Fixed production deployment issues (APP_KEY, session/DB config, Vite assets)
- Connected GitHub remote: https://github.com/odanysjcruz-sys/odanys-film
- Set up cPanel Git Version Control — site is live at https://odanysmedia.com
- Created `.cpanel.yml` for automated post-deploy tasks
- Un-excluded `public/build` from `.gitignore` (Namecheap has no Node.js)

### Session — 2026-06-23 (production deploy fix)
- Diagnosed why WebP images, Vimeo lightbox, and updated CSS weren't showing in production
- Root cause: cPanel git deploy updates ~/public_html/ but never ~/laravel/ (the running app)
- Found git binary at /usr/bin/git (not /usr/local/bin/git)
- Found cPanel git repo at ~/laravel-git/ (find shows doubled path due to ~/home/ symlink)
- Fixed by uploading two ZIPs via File Manager:
  1. Code ZIP → ~/laravel/ (views + manifest): updated blade templates and build manifest
  2. Build ZIP → ~/public_html/ (CSS + JS): made assets accessible from web root
- Site now fully working: hero, about, portfolio (Vimeo lightbox + WebP posters), services (WebP)

### Session — 2026-06-23 (image optimization)
- Audited all 29 images in public/images/ (total: 425 MB)
- Identified 6 unreferenced images (backed up, left in place): about.png, brand-nike.jpg, logo-odanys.png, srv-brand-films.jpg, srv-creative-direction.png, srv-music-video.png
- Installed sharp (npm dev dependency) for WebP conversion
- Converted all 25 referenced images to WebP: 371 MB → 1.9 MB (−99.5%)
- Resized service images from 8000/4500/2880px → 1440px max (appropriate for display area)
- Resized brand logos from 1024–1536px → 256px height (2× retina for 128px display)
- Resized site logo from 4500×4500 → 200×200 WebP + 192×192 PNG (for favicon)
- Created srcset medium variants (960w) for both portfolio poster images
- Added `loading="lazy"` to: about photo, all brand logos, footer logo
- Added `fetchpriority="high"` + `loading="eager"` to navbar logo (above fold)
- Added `<link rel="preload" fetchpriority="high">` for hero image in layout head
- Updated hero CSS background: hero.png → hero.webp
- All originals backed up to public/original-images-backup/
- Added scripts/optimize-images.js for future re-optimization runs

### Session — 2026-06-23 (earlier)
- Replaced self-hosted MP4 video placeholders with Vimeo lightbox embeds (A-01, A-02)
- Lightbox: dark overlay, Vimeo iframe autoplay, closes on backdrop/Escape/✕
- Play button circle animates on hover for Vimeo-linked cards
- Wired Vimeo profile link in navbar and footer; YouTube icons commented out
- Replaced low-quality oEmbed thumbnails with local JPEG posters
- Compressed posters: Me Llamas 37 MB → 346 KB, Pacto 5.6 MB → 160 KB
- Updated Pacto poster to new screenshot (2026-06-23)
- Diagnosed local dev URL confusion: correct URL is `http://odanys-film.test` (Laragon uses folder name)

### Next recommended steps
1. Open `http://odanys-film.test` and verify portfolio cards show posters + lightbox works
2. Deploy to production: cPanel → Git Version Control → Deploy HEAD Commit
3. Get Vimeo URL + poster for A-03 "Raíces" to complete the portfolio section
4. Add real Instagram and LinkedIn URLs to navbar/footer social links
