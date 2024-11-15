<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Services\{
    IndexController,
    StoreController,
    ShowController,
    UpdateController,
    DeleteController
};


Route::get('/',IndexController::class)->name('index');
Route::post('/',StoreController::class)->name('store');
Route::get('{service}',ShowController::class)->name('show');
Route::put('{service}',UpdateController::class)->name('update');
Route::delete('{service}',DeleteController::class)->name('delete');
