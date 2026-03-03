<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\FrontendController;

/*
|--------------------------------------------------------------------------
| FRONTEND WEBSITE (TEMPLATE)
|--------------------------------------------------------------------------
| Halaman publik untuk pengunjung
*/
Route::get('/', function () {
    return view('frontend.pages.home');
})->name('home');

Route::get('/order', [FrontendController::class, 'orderPage'])
    ->name('order.page');
    
Route::get('/', [FrontendController::class,'home'])->name('home');

Route::post('/order-public', [OrderController::class, 'storePublic'])
    ->name('order.public');

Route::post('/order-public', [OrderController::class, 'storePublic'])
    ->name('order.public');


/*
|--------------------------------------------------------------------------
| AUTH ROUTES (LOGIN, REGISTER, DLL)
|--------------------------------------------------------------------------
| Sudah disediakan oleh Laravel Breeze/Fortify
*/
require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| ADMIN PANEL (HARUS LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Master Data
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);

    // Orders
    Route::resource('orders', OrderController::class);
    Route::get('orders/{order}/whatsapp',
    [OrderController::class,'whatsapp']
)->name('orders.whatsapp');

    // Payments
    Route::get('orders/{order}/payment/create', [PaymentController::class, 'create'])
        ->name('payments.create');

    Route::post('orders/{order}/payment', [PaymentController::class, 'store'])
        ->name('payments.store');
});
