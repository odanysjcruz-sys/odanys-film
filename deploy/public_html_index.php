<?php

/**
 * This file goes in public_html/index.php on Namecheap.
 *
 * The rest of the Laravel app lives one level above public_html
 * in a folder called "laravel" (i.e. ~/laravel/).
 *
 * Directory layout on the server:
 *   ~/laravel/          ← all Laravel files (app, bootstrap, config, vendor…)
 *   ~/public_html/      ← web root; contains THIS file + build/ images/ videos/
 */

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

if (file_exists($maintenance = __DIR__ . '/../laravel/storage/framework/maintenance.php')) {
    require $maintenance;
}

require __DIR__ . '/../laravel/vendor/autoload.php';

/** @var Application $app */
$app = require_once __DIR__ . '/../laravel/bootstrap/app.php';

$app->handleRequest(Request::capture());
