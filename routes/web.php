<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// PUBLIC
use App\Http\Controllers\Public\LandingController;
use App\Http\Controllers\Public\ProdukController as PublicProdukController;
use App\Http\Controllers\Public\PageController as PublicPageController;

// ADMIN
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LandingSectionController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\BannerController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (LANDING PAGE)
|--------------------------------------------------------------------------
*/

Route::get('/', [LandingController::class, 'index'])->name('landing');

// PAGE
Route::get('/Xk92LmQa', [PublicPageController::class, 'profil'])->name('profil');
Route::get('/Pz81QaRt', [PublicPageController::class, 'visiMisi'])->name('visi-misi');
Route::get('/Ab71YtUi', [PublicPageController::class, 'kontak'])->name('kontak');

// PRODUK
Route::get('/Jh84KlWs', [PublicProdukController::class, 'index'])->name('produk.index');
Route::get('/Yp52NcVz/{slug}', [PublicProdukController::class, 'show'])->name('produk.show');

// DYNAMIC PAGE - untuk halaman custom lainnya (HARUS PALING AKHIR)

/*
|--------------------------------------------------------------------------
| AUTH DASHBOARD (DEFAULT BREEZE)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| ADMIN CMS ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('landing-sections', LandingSectionController::class);
    Route::resource('menus', MenuController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('pages', PageController::class);
    Route::resource('banners', BannerController::class);
    
    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::get('/settings/edit', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::patch('/settings', [SettingsController::class, 'update'])->name('settings.update');
  
    // Profile routes for admin
    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [AdminProfileController::class, 'destroy'])->name('profile.destroy');
    

});


/*
|--------------------------------------------------------------------------
| USER PROFILE (BREEZE DEFAULT)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
Route::get('/{slug}', [PublicPageController::class, 'show'])->name('page.show');
