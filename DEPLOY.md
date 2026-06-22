# Deployment Guide — Namecheap Shared Hosting (cPanel)

## Overview

On Namecheap the web root is `public_html/`. Laravel's public files live in
`public/`. The solution is to put the full Laravel app in a folder **above**
`public_html` and drop a modified `index.php` into `public_html/` that points
there.

```
~/                         ← your home directory on the server
├── laravel/               ← the full Laravel app (app/, config/, vendor/ …)
└── public_html/           ← web root (what visitors see)
    ├── index.php          ← MODIFIED (from deploy/public_html_index.php)
    ├── .htaccess
    ├── build/
    ├── images/
    ├── videos/
    ├── favicon.ico
    └── robots.txt
```

---

## Step 0 — Optimize images BEFORE uploading (mandatory)

The current PNG images are 18–37 MB each. Unoptimized, the page will not load
acceptably for any visitor. Compress them first.

**Free options:**
- **https://squoosh.app** — drag and drop, choose WebP, quality 80, resize to
  max 1920 px wide. Saves ~95% file size.
- **https://tinypng.com** — batch upload PNG/JPG. No resize but good compression.

Target sizes after compression:
| File type       | Uncompressed | Target     |
|-----------------|-------------|-----------|
| Carousel PNGs   | 18–37 MB    | < 400 KB  |
| Brand logos PNG | 1–2 MB      | < 100 KB  |
| Hero / About    | 0.6–1.6 MB  | < 300 KB  |

After compressing, replace the files in `public/images/` and run `git add` +
`git commit` before proceeding.

**Videos (774 MB + 833 MB):** These cannot be uploaded through cPanel File
Manager (250 MB limit). Options:
1. **Recommended:** Host on YouTube/Vimeo (private/unlisted) and embed — saves
   ~1.6 GB of hosting bandwidth.
2. If you must self-host: use FTP (FileZilla) to upload directly. See Step 4.

---

## Step 1 — Local preparation (run on your machine)

```powershell
# 1. Build production assets
npm run build

# 2. Install production-only PHP dependencies
composer install --no-dev --optimize-autoloader

# 3. Confirm no leftover .env changes; .env is NOT uploaded to the server
git status
```

---

## Step 2 — cPanel: set PHP version to 8.3

1. Log in to **cPanel** → **Software** → **Select PHP Version** (or
   "MultiPHP Manager").
2. Set the domain `odanysmedia.com` to **PHP 8.3**.
3. Click **Set as current** then go to **PHP Extensions** and confirm these are
   enabled (most are on by default):
   - `mbstring` `openssl` `pdo_sqlite` `xml` `json` `ctype`
   - `tokenizer` `curl` `fileinfo` `intl`

---

## Step 3 — Upload the Laravel app above public_html

Use **cPanel File Manager** or **FileZilla** (FTP).

Upload these folders/files to `~/laravel/` (create the folder first):

```
app/
bootstrap/
config/
database/
resources/
routes/
storage/            ← upload the folder structure but NOT storage/logs/*.log
vendor/
artisan
composer.json
composer.lock
```

**Do NOT upload:**
- `node_modules/`
- `public/`           ← its contents go to public_html/ separately (Step 4)
- `.env`              ← you will create this on the server (Step 5)
- `public/videos/`   ← upload via FTP only if self-hosting (large files)

---

## Step 4 — Upload public/ contents to public_html/

Upload the **contents** of `public/` (not the folder itself) into `public_html/`:

```
public_html/
├── .htaccess         ← from public/.htaccess
├── favicon.ico
├── robots.txt
├── build/            ← from public/build/  (Vite assets + manifest.json)
├── images/           ← from public/images/ (optimized — see Step 0)
└── videos/           ← from public/videos/ (via FTP if self-hosting)
```

Then upload `deploy/public_html_index.php` as `public_html/index.php`
(replace the existing one).

---

## Step 5 — Create .env on the server

In cPanel File Manager, create `~/laravel/.env` with this content
(or upload `deploy/env.production` and rename it to `.env`):

```env
APP_NAME="Odanys Media"
APP_ENV=production
APP_KEY=                     # fill in after key:generate (Step 6)
APP_DEBUG=false
APP_URL=https://odanysmedia.com

APP_MAINTENANCE_DRIVER=file

LOG_CHANNEL=single
LOG_LEVEL=error

DB_CONNECTION=sqlite

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync

CACHE_STORE=file

MAIL_MAILER=smtp
MAIL_HOST=odanysmedia.com
MAIL_PORT=465
MAIL_SCHEME=ssl
MAIL_USERNAME=hello@odanysmedia.com
MAIL_PASSWORD=your_actual_password_here
MAIL_FROM_ADDRESS=hello@odanysmedia.com
MAIL_FROM_NAME="Odanys Media"
MAIL_TO_ADDRESS=hello@odanysmedia.com

VITE_APP_NAME="Odanys Media"
```

**Important:** `MAIL_SCHEME=ssl` — not `MAIL_ENCRYPTION`. Laravel 13 reads
`MAIL_SCHEME`; the old key is silently ignored.

---

## Step 6 — Run artisan commands via cPanel Terminal

Go to **cPanel → Advanced → Terminal** (or SSH in with PuTTY).

```bash
cd ~/laravel

# Generate app key (copy the output into .env as APP_KEY=)
php artisan key:generate --show

# Then set it in .env, or run without --show to set it automatically:
php artisan key:generate

# Cache config, routes, and views for production speed
php artisan optimize

# Verify the config was cached correctly (should show no errors)
php artisan about
```

---

## Step 7 — Set file permissions

In Terminal:

```bash
# Storage and cache must be writable by the web server
chmod -R 755 ~/laravel/storage
chmod -R 755 ~/laravel/bootstrap/cache

# Make log directory writable
chmod 775 ~/laravel/storage/logs
```

---

## Step 8 — Verify the deployment

1. Visit `https://odanysmedia.com` — the site should load.
2. Fill out the contact form and submit — check `hello@odanysmedia.com` for
   the email.
3. If something breaks, check `~/laravel/storage/logs/laravel.log` for errors.

---

## Troubleshooting

### Blank page / 500 error
- Temporarily set `APP_DEBUG=true` in `.env`, reload, read the error, then set
  it back to `false`.
- Check `~/laravel/storage/logs/laravel.log`.

### "Class not found" errors
```bash
cd ~/laravel && composer dump-autoload --optimize
```

### Contact form sends but mail never arrives
- Verify `MAIL_PASSWORD` is correct.
- In cPanel Email, confirm `hello@odanysmedia.com` exists as an email account.
- Check spam folder.
- Verify port 465 is not blocked: cPanel → Email → Email Deliverability.

### Assets return 404 (CSS/JS not loading)
- Confirm `public_html/build/` exists and contains `manifest.json` + `assets/`.
- Confirm `APP_URL=https://odanysmedia.com` (no trailing slash).
- Run `php artisan optimize:clear` then `php artisan optimize` again.

### "No application encryption key" error
```bash
cd ~/laravel && php artisan key:generate
```

### Redirect loop on HTTPS
The app already has `trustProxies(at: '*')` in `bootstrap/app.php` which
handles cPanel's SSL proxy. If you still get a loop, add this to `.env`:
```
FORCE_HTTPS=true
```

---

## Re-deploying after changes

```powershell
# Local: build and commit
npm run build
git add -A && git commit -m "..."
```

On the server (Terminal):
```bash
cd ~/laravel

# Pull changes (if using git on server) OR re-upload changed files via FTP

# Clear and rebuild caches
php artisan optimize:clear
php artisan optimize
```

---

## Checklist summary

- [ ] Images compressed (< 400 KB each)
- [ ] `npm run build` run locally
- [ ] `composer install --no-dev --optimize-autoloader` run locally
- [ ] PHP 8.3 set in cPanel MultiPHP Manager
- [ ] `~/laravel/` uploaded (app, bootstrap, config, database, resources, routes, storage, vendor)
- [ ] `public_html/` has: `.htaccess`, modified `index.php`, `build/`, `images/`, `favicon.ico`, `robots.txt`
- [ ] `~/laravel/.env` created with production values + mail password
- [ ] `php artisan key:generate` run on server
- [ ] `php artisan optimize` run on server
- [ ] `storage/` and `bootstrap/cache/` permissions set to 755
- [ ] Contact form tested end-to-end
