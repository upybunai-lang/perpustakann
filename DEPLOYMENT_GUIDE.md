# 🚀 Panduan Deploy Aplikasi Perpustakaan ke Web Hosting

## Pilihan Hosting

### 1. Shared Hosting (cPanel)
- Contoh: Hostinger, Niagahoster, Rumahweb, Dewaweb
- Cocok untuk: Aplikasi skala kecil-menengah
- Harga: Mulai Rp 20.000/bulan

### 2. VPS (Virtual Private Server)
- Contoh: DigitalOcean, Vultr, AWS, Google Cloud
- Cocok untuk: Aplikasi skala menengah-besar
- Harga: Mulai $5/bulan

### 3. Platform as a Service (PaaS)
- Contoh: Heroku, Railway, Vercel (untuk frontend)
- Cocok untuk: Testing & development
- Harga: Ada free tier

---

## 📦 METODE 1: Deploy ke Shared Hosting (cPanel)

### Persiapan

1. **Beli Hosting & Domain**
   - Pilih paket hosting yang support PHP 8.x dan MySQL
   - Contoh domain: `perpustakaan.com` atau `www.perpustakaan.com`

2. **Persyaratan Hosting:**
   - PHP >= 8.0
   - MySQL/MariaDB
   - Composer
   - SSH Access (opsional tapi direkomendasikan)

### Langkah-langkah Deploy

#### A. Persiapan File

1. **Optimize Aplikasi**
```bash
# Di komputer lokal
cd perpus

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize untuk production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Install dependencies production
composer install --optimize-autoloader --no-dev
```

2. **Update .env untuk Production**
```bash
# Buat file .env.production
APP_NAME="Sistem Perpustakaan"
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://www.perpustakaan.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=nama_database_hosting
DB_USERNAME=username_database_hosting
DB_PASSWORD=password_database_hosting
```

3. **Compress File**
```bash
# Zip semua file kecuali node_modules
# Exclude: node_modules, .git, storage/logs/*
```

#### B. Upload ke Hosting

**Via cPanel File Manager:**

1. Login ke cPanel
2. Buka File Manager
3. Navigasi ke folder `public_html`
4. Upload file zip
5. Extract file zip

**Via FTP (FileZilla):**

1. Download FileZilla
2. Connect ke hosting (host, username, password dari cPanel)
3. Upload semua file ke `public_html`

**Via SSH (Recommended):**

```bash
# Connect via SSH
ssh username@your-domain.com

# Clone atau upload file
cd public_html
# Upload via scp atau git clone
```

#### C. Struktur Folder di Hosting

```
public_html/
├── perpus/              # Folder aplikasi Laravel
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── public/         # Folder public Laravel
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   └── vendor/
└── public_html/        # Document root (akan kita redirect)
```

**PENTING:** Pindahkan isi folder `public` Laravel ke root `public_html`

```bash
# Via SSH
cd public_html
mv perpus/public/* ./
mv perpus/public/.htaccess ./

# Edit index.php
nano index.php
```

Edit `index.php`:
```php
<?php

require __DIR__.'/perpus/vendor/autoload.php';
$app = require_once __DIR__.'/perpus/bootstrap/app.php';
```

#### D. Setup Database

1. **Buat Database di cPanel**
   - MySQL Databases
   - Create New Database: `perpus_app`
   - Create User & Password
   - Add User to Database (All Privileges)

2. **Import Database**
   - phpMyAdmin
   - Select database
   - Import → Choose `database.sql`
   - Go

3. **Update .env**
```bash
DB_DATABASE=cpanel_perpus_app
DB_USERNAME=cpanel_username
DB_PASSWORD=your_password
```

#### E. Set Permissions

```bash
# Via SSH
cd public_html/perpus

# Set permissions
chmod -R 755 storage
chmod -R 755 bootstrap/cache

# Set ownership (jika perlu)
chown -R username:username storage
chown -R username:username bootstrap/cache
```

#### F. Generate Application Key

```bash
# Via SSH
cd public_html/perpus
php artisan key:generate
```

#### G. Setup .htaccess

Buat file `.htaccess` di `public_html`:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

Atau redirect semua ke folder public:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_URI} !^/public/
    RewriteRule ^(.*)$ /public/$1 [L,QSA]
</IfModule>
```

---

## 🖥️ METODE 2: Deploy ke VPS (Ubuntu)

### Persiapan VPS

1. **Beli VPS**
   - DigitalOcean, Vultr, AWS, dll
   - Pilih Ubuntu 20.04 atau 22.04

2. **Connect via SSH**
```bash
ssh root@your-server-ip
```

### Install Dependencies

```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install Nginx
sudo apt install nginx -y

# Install PHP 8.1
sudo apt install software-properties-common -y
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
sudo apt install php8.1-fpm php8.1-cli php8.1-mysql php8.1-xml php8.1-mbstring php8.1-curl php8.1-zip php8.1-gd -y

# Install MySQL
sudo apt install mysql-server -y
sudo mysql_secure_installation

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Git
sudo apt install git -y
```

### Deploy Aplikasi

```bash
# Clone atau upload aplikasi
cd /var/www
sudo git clone https://github.com/username/perpus.git
# atau upload via scp

cd perpus

# Install dependencies
composer install --optimize-autoloader --no-dev

# Setup permissions
sudo chown -R www-data:www-data /var/www/perpus
sudo chmod -R 755 /var/www/perpus/storage
sudo chmod -R 755 /var/www/perpus/bootstrap/cache

# Setup .env
cp .env.example .env
nano .env
# Edit database credentials

# Generate key
php artisan key:generate

# Migrate database
php artisan migrate --force

# Cache config
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Setup Nginx

```bash
sudo nano /etc/nginx/sites-available/perpus
```

Isi dengan:

```nginx
server {
    listen 80;
    server_name perpustakaan.com www.perpustakaan.com;
    root /var/www/perpus/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Enable site:

```bash
sudo ln -s /etc/nginx/sites-available/perpus /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl restart nginx
```

### Setup SSL (HTTPS)

```bash
# Install Certbot
sudo apt install certbot python3-certbot-nginx -y

# Get SSL certificate
sudo certbot --nginx -d perpustakaan.com -d www.perpustakaan.com

# Auto renewal
sudo certbot renew --dry-run
```

### Setup Database

```bash
# Login MySQL
sudo mysql

# Create database
CREATE DATABASE perpus_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'perpus_user'@'localhost' IDENTIFIED BY 'strong_password';
GRANT ALL PRIVILEGES ON perpus_app.* TO 'perpus_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;

# Import database
mysql -u perpus_user -p perpus_app < /var/www/perpus/database.sql
```

---

## 🌐 METODE 3: Deploy ke Heroku (Free/Paid)

### Persiapan

1. **Install Heroku CLI**
```bash
# Windows
# Download dari https://devcenter.heroku.com/articles/heroku-cli

# Mac
brew tap heroku/brew && brew install heroku

# Linux
curl https://cli-assets.heroku.com/install.sh | sh
```

2. **Login Heroku**
```bash
heroku login
```

### Deploy

```bash
cd perpus

# Create Heroku app
heroku create perpustakaan-app

# Add buildpack
heroku buildpacks:set heroku/php

# Add MySQL addon
heroku addons:create jawsdb:kitefin

# Set environment variables
heroku config:set APP_KEY=$(php artisan key:generate --show)
heroku config:set APP_ENV=production
heroku config:set APP_DEBUG=false

# Create Procfile
echo "web: vendor/bin/heroku-php-apache2 public/" > Procfile

# Deploy
git add .
git commit -m "Deploy to Heroku"
git push heroku main

# Run migrations
heroku run php artisan migrate --force
```

---

## 📋 Checklist Sebelum Deploy

- [ ] Update .env untuk production
- [ ] Set APP_DEBUG=false
- [ ] Set APP_ENV=production
- [ ] Generate APP_KEY baru
- [ ] Update APP_URL dengan domain
- [ ] Backup database lokal
- [ ] Test semua fitur di lokal
- [ ] Optimize dengan cache
- [ ] Set permissions storage & bootstrap/cache
- [ ] Setup SSL certificate
- [ ] Test di browser
- [ ] Setup backup otomatis

---

## 🔧 Troubleshooting

### Error 500
```bash
# Check logs
tail -f storage/logs/laravel.log

# Clear cache
php artisan cache:clear
php artisan config:clear
```

### Permission Denied
```bash
sudo chmod -R 755 storage
sudo chmod -R 755 bootstrap/cache
sudo chown -R www-data:www-data storage
```

### Database Connection Error
- Cek credentials di .env
- Cek apakah MySQL running
- Cek firewall

### CSS/JS Not Loading
- Cek APP_URL di .env
- Run: `php artisan storage:link`
- Clear browser cache

---

## 📞 Support

Jika ada masalah saat deploy, cek:
1. Laravel logs: `storage/logs/laravel.log`
2. Nginx/Apache error logs
3. PHP error logs

**Selamat! Aplikasi perpustakaan Anda sudah online!** 🎉
