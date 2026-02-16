<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/**
 * Resolve project base path for shared hosting layouts:
 * 1) public_html contains full Laravel project.
 * 2) public_html contains only web root, app is one level above.
 */
$basePath = is_file(__DIR__.'/vendor/autoload.php') && is_file(__DIR__.'/bootstrap/app.php')
    ? __DIR__
    : dirname(__DIR__);

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = $basePath.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require $basePath.'/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once $basePath.'/bootstrap/app.php';

$app->handleRequest(Request::capture());
