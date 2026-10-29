<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\BudayaController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/budaya', [BudayaController::class, 'index'])->name('budaya.index');
Route::get('/budaya/{slug}', [BudayaController::class, 'show'])->name('budaya.show');

Route::view('/tentang', 'tentang')->name('tentang');
use App\Http\Controllers\AdminAuthController;

Route::middleware('guest')->group(function () {
    Route::get('/masuk-admin', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/masuk-admin', [AdminAuthController::class, 'login'])->middleware('throttle:5,1');
});

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', fn () => view('admin.dashboard'))->name('admin.dashboard');
    Route::post('/keluar', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::resource('kategori', CategoryController::class)
        ->except('show')
        ->parameters(['kategori' => 'category'])
        ->names('admin.categories');
});