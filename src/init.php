<?php

use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$base = __DIR__.'/..';
$path = [
    'public' => $base.$_ENV["PUBLIC_PATH"],
    'source' => $base.$_ENV["SOURCE_PATH"],
    'vendor' => $base.$_ENV["VENDOR_PATH"],
    'views' => $base.$_ENV["VIEW_PATH"],
];



require $path["source"].'/routes.php';



