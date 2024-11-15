<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\Credentials\{
    IndexController,
    StoreController,
    ShowController,
    UpdateController,
    DeleteController
};

Route::get('/', IndexController::class)->name('index');
Route::post('/',StoreController::class)->name('store');
Route::get('{credential}',ShowController::class)->name('show');
Route::put('{credential}',UpdateController::class)->name('update');
Route::delete('{credential}',DeleteController::class)->name('delete');
