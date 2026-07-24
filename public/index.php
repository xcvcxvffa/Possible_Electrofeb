<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Hostinger Deployment Path Configuration
|--------------------------------------------------------------------------
| On Hostinger shared hosting, the correct directory structure is:
|
|   ~/domains/yourdomain.com/public_html/     ← Contents of Laravel's /public
|   ~/domains/yourdomain.com/laravel/         ← Full Laravel project root
|
| The paths below use __DIR__.'/../' which works when:
|   - LOCAL:      public/ is inside the Laravel project root (normal dev)
|   - HOSTINGER:  public_html/ contents point UP to laravel/ folder
|
| On Hostinger, after uploading:
|   1. Upload full project to: ~/domains/yourdomain.com/laravel/
|   2. Copy ~/laravel/public/* to ~/public_html/
|   3. In public_html/index.php, change __DIR__.'/../' to:
|      __DIR__.'/../../laravel/'   (or the actual path to your Laravel root)
|
*/

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
