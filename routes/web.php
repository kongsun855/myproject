<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Admin\PostController;   // ← make sure this is here

Route::get('/', [HomeController::class, 'index'])->name('home');
//Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/article/{id}', [HomeController::class, 'article'
])->name('article');

Route::get('/dashboard', function () {
    return view('dashboard');


})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* ==============================================================
   ADMIN ROUTES – THIS IS THE ONLY THING THAT WAS WRONG
   ============================================================== */
Route::prefix('admin')
     ->middleware('auth')
     ->as('admin.')               // ← THIS LINE WAS MISSING!
     ->group(function () {

    Route::get('/setting', [SettingController::class, 'index'])->name('setting');

    Route::resource('category', CategoryController::class);
    Route::resource('posts', PostController::class);   // ← now creates admin.posts.store etc.
});

// Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
// Route::get('/setting', [SettingController::class, 'index'])->name('setting');

require __DIR__.'/auth.php';