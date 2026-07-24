#!/bin/bash
# ============================================================
# HOSTINGER POST-DEPLOYMENT SCRIPT
# Run this via Hostinger SSH Terminal AFTER git pull/deploy
# Path: ~/public_html/deploy.sh
# Usage: bash deploy.sh
# ============================================================

set -e  # Exit immediately on any error

LARAVEL_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

echo "=============================================="
echo " Possible Electrofeb - Hostinger Deployment"
echo " Laravel Root: $LARAVEL_ROOT"
echo "=============================================="

# ---- 1. Composer Install (production, no dev) ----
echo ""
echo "[1/9] Installing Composer dependencies..."
cd "$LARAVEL_ROOT"
composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction
echo "      ✅ Composer install complete"

# ---- 2. Clear all caches ----
echo ""
echo "[2/9] Clearing application caches..."
php artisan optimize:clear
echo "      ✅ All caches cleared"

# ---- 3. Generate APP_KEY if missing ----
echo ""
echo "[3/9] Verifying APP_KEY..."
if grep -q "APP_KEY=$" "$LARAVEL_ROOT/.env" || grep -q "APP_KEY= " "$LARAVEL_ROOT/.env"; then
    echo "      APP_KEY is empty — generating..."
    php artisan key:generate --force
    echo "      ✅ APP_KEY generated"
else
    echo "      ✅ APP_KEY already set"
fi

# ---- 4. Storage permissions ----
echo ""
echo "[4/9] Setting storage permissions..."
chmod -R 775 "$LARAVEL_ROOT/storage"
chmod -R 775 "$LARAVEL_ROOT/bootstrap/cache"
echo "      ✅ Permissions set (775)"

# ---- 5. Create storage symlink ----
echo ""
echo "[5/9] Creating storage symlink..."
if [ ! -L "$LARAVEL_ROOT/public/storage" ]; then
    php artisan storage:link
    echo "      ✅ Storage symlink created"
else
    echo "      ✅ Storage symlink already exists"
fi

# ---- 6. Remove Vite hot file (prevents dev asset loading) ----
echo ""
echo "[6/9] Removing Vite hot file..."
rm -f "$LARAVEL_ROOT/public/hot"
echo "      ✅ Vite hot file removed"

# ---- 7. Cache config, routes, views ----
echo ""
echo "[7/9] Caching configuration for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo "      ✅ Config, routes, views cached"

# ---- 8. Optimize autoloader ----
echo ""
echo "[8/9] Optimizing autoloader..."
composer dump-autoload --optimize
echo "      ✅ Autoloader optimized"

# ---- 9. Verify deployment ----
echo ""
echo "[9/9] Verifying deployment..."
php artisan about --only=environment
echo ""
echo "=============================================="
echo " ✅ Deployment Complete!"
echo " Visit your domain to verify the website."
echo "=============================================="
echo ""
echo "IMPORTANT: If this is a first deployment, make sure:"
echo "  1. .env file exists (copy from .env.hostinger)"
echo "  2. APP_KEY is set in .env"
echo "  3. DB credentials are correct in .env"
echo "  4. Root .htaccess exists at public_html/"
echo "=============================================="
