<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OrderController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    route::resource('categories', CategoryController::class);
    route::resource('products', ProductController::class);
});


// Order Routes
Route::resource('orders', OrderController::class);
Route::get('orders/{order}/payment/create',[PaymentController::class,'create'])->name('payments.create');
Route::post('orders/{order}/payment',[PaymentController::class,'store'])->name('payments.store');


require __DIR__.'/auth.php';
