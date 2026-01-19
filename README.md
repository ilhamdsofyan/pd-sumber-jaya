# PD Sumber Jaya – Company Website

Website company profile & edukasi untuk PD Sumber Jaya.  
Fokus: **B2B lead generation, konten edukasi, dan ads (Google & Meta)**.  
Tidak ada transaksi di website.

---

## Tech Stack

- WordPress (latest stable)
- PHP 8.1 / 8.2
- Theme: GeneratePress (+ child theme)
- Page builder: Gutenberg only
- Database: MySQL / MariaDB
- Tracking: Google Tag Manager

---

## Repository Strategy

Repository ini **TIDAK** menyimpan:

- WordPress core (`wp-admin`, `wp-includes`)
- Media uploads
- `wp-config.php`
- Cache & backup files

Yang di-track di Git:

- Active theme (GeneratePress + child theme)
- Custom plugin (jika ada)
- Project structure & config non-secret

WordPress core diinstall terpisah (local & production).

---

## Local Development Setup

### 1. Requirements

- PHP 8.1+
- MySQL / MariaDB
- Web server (Apache / Nginx)
- Local stack (LocalWP / XAMPP / Laragon)

### 2. Install WordPress

- Download WordPress dari wordpress.org
- Extract ke root project
- Buat database lokal
- Setup via browser (`http://localhost/...`)

### 3. wp-config.php (Local)

Contoh setting penting:

```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
define('WP_MEMORY_LIMIT', '256M');
```

---

## Git Workflow
```sh
git clone <repo>
cd project
# Pastikan WordPress core sudah diinstall secara manual
```

- Commit hanya theme & custom plugin
- Jangan commit core WordPress
- Jangan commit uploads / cache

---

## Environment Notes
### Local

- WP_DEBUG: ON
- Tracking: OFF / dummy

### Production

- WP_DEBUG: OFF
- HTTPS wajib
- Tracking via GTM aktif
- Cache & security enabled

---

## Migration (Local → Production)

High level flow:
1. Install WordPress fresh di server
2. Setup database & wp-config.php
3. Pull repository (theme + plugin)
4. Import database (search & replace URL)
5. Set permalink & flush rewrite
6. Enable cache & security

⚠️ Jangan copy-paste WordPress core dari local ke server.

---

## Rules & Constraints

- No page builder berat (Elementor, dll)
- No random plugin
- Semua tracking via GTM
- Performance > visual gimmick

---

## Goal

Website ini dibangun untuk:
- Cepat
- Aman
- Mudah dirawat
- Siap scale konten & ads

Bukan buat pamer teknologi.

---

## Maintainer
Internal Dev Team
PD Sumber Jaya