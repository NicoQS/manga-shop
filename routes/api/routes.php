<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->as('v1:')->group(static function (): void {
    Route::middleware(['auth:sanctum','throttle:api'])->group(static function ():void
    {
        Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
            return $request->user();
        });

        Route::prefix('services')->as('services:')->group(base_path(path: 'routes/api/v1/services.php'));

        Route::prefix('credentials')->as('credentials:')->group(base_path(path: 'routes/api/v1/credentials.php'));

        Route::prefix('checks')->as('checks:')->group(base_path(path: 'routes/api/v1/checks.php'));
    });
});
