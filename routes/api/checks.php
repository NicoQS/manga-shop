<?php
declare(strict_types=1);
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Checks\{
    IndexController,
    StoreController,
    ShowController,
    UpdateController,
    DeleteController
};

Route::get('/', IndexController::class)->name('index');
Route::post('/', StoreController::class)->name('store');
Route::get('{checks}', ShowController::class)->name('show');
Route::put('{checks}', UpdateController::class)->name('update');
Route::delete('{checks}', DeleteController::class)->name('delete');
