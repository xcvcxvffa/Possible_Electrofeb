<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| HOSTINGER DEPLOYMENT - public_html/index.php
|--------------------------------------------------------------------------
| This file goes inside: public_html/
| The full Laravel project is at: laravel/ (sibling to public_html)
|
| Hostinger directory structure:
|   domains/yourdomain.com/
|   ├── public_html/          ← Web root (this file lives here)
|   │   ├── index.php         ← THIS FILE
|   │   ├── .htaccess
|   │   ├── favicon.ico
|   │   ├── robots.txt
|   │   └── assets/
|   └── laravel/              ← Full Laravel project root
|       ├── app/
|       ├── bootstrap/
|       ├── config/
|       ├── storage/
|       ├── vendor/
|       └── ...
|
*/

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../laravel/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../laravel/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../laravel/bootstrap/app.php';

$app->handleRequest(Request::capture());
