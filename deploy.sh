#!/bin/bash

# Script Deploy Aplikasi Perpustakaan
# Untuk VPS/Server Linux

echo "🚀 Memulai proses deployment..."

# Pull latest code
echo "📥 Pulling latest code..."
git pull origin main

# Install/Update dependencies
echo "📦 Installing dependencies..."
composer install --optimize-autoloader --no-dev

# Clear cache
echo "🧹 Clearing cache..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Run migrations
echo "🗄️ Running migrations..."
php artisan migrate --force

# Optimize
echo "⚡ Optimizing..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
echo "🔐 Setting permissions..."
chmod -R 755 storage
chmod -R 755 bootstrap/cache

# Restart services
echo "🔄 Restarting services..."
sudo systemctl restart php8.1-fpm
sudo systemctl restart nginx

echo "✅ Deployment completed successfully!"
echo "🌐 Your application is now live!"
