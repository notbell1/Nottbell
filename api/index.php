<?php

// 1. Load Composer Autoloader
require __DIR__ . '/../vendor/autoload.php';

// 2. Start Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 3. Handle Request
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

// 4. Kirim Response ke Browser
$response->send();
$kernel->terminate($request, $response);
