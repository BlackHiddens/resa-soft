#!/bin/bash
set -e

PHP_BIN=${PHP_BIN:-/opt/alt/php83/usr/bin/php}
COMPOSER_BIN=${COMPOSER_BIN:-composer2}

$PHP_BIN $(which $COMPOSER_BIN) install --no-dev --optimize-autoloader
$PHP_BIN artisan migrate --force
$PHP_BIN artisan optimize:clear
$PHP_BIN artisan config:cache
$PHP_BIN artisan route:cache
$PHP_BIN artisan view:cache

echo "Deployment tasks completed."