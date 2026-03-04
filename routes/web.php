<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PaymentSettingController;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrdersExport;

/*
|--------------------------------------------------------------------------
| FRONTEND (CUSTOMER)
|--------------------------------------------------------------------------
*/

Route::get('/', [FrontendController::class,'home'])->name('home');

Route::get('/order', [FrontendController::class,'orderPage'])
    ->name('order.page');

Route::post('/order', [OrderController::class,'storePublic'])
    ->name('order.public');

Route::get('/payment/{order}', [OrderController::class,'paymentPage'])
    ->name('order.payment');

Route::get('/payment/{order}/whatsapp', [OrderController::class,'whatsapp'])
    ->name('order.whatsapp');


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','verified'])->group(function () {

    Route::get('/dashboard',[DashboardController::class,'index'])
        ->name('dashboard');

    /*
    | PROFILE
    */

    Route::get('/profile',[ProfileController::class,'edit'])
        ->name('profile.edit');

    Route::patch('/profile',[ProfileController::class,'update'])
        ->name('profile.update');

    Route::delete('/profile',[ProfileController::class,'destroy'])
        ->name('profile.destroy');


    /*
    | MASTER DATA
    */

    Route::resource('categories',CategoryController::class);
    Route::resource('products',ProductController::class);


    /*
    | ORDERS
    */

 Route::resource('orders', OrderController::class);

Route::get(
    'orders/{order}/whatsapp',
    [OrderController::class,'whatsapp']
)->name('orders.whatsapp');

Route::get(
    'orders/{order}/invoice',
    [OrderController::class,'invoice']
)->name('orders.invoice');
    

    /*
    | PAYMENT
    */

    Route::get(
        'orders/{order}/payment/create',
        [PaymentController::class,'create']
    )->name('payments.create');

    Route::post(
        'orders/{order}/payment',
        [PaymentController::class,'store']
    )->name('payments.store');

    Route::get('/payment-settings',[PaymentSettingController::class,'edit'])
    ->name('payment.settings');

Route::post('/payment-settings',[PaymentSettingController::class,'update'])
    ->name('payment.settings.update');

    /*
    | REPORTS
    */

    Route::get('/reports',[ReportController::class,'index'])
        ->name('reports.index');

    Route::get('/reports/export',function(){

        return Excel::download(
            new OrdersExport,
            'laporan-penjualan.xlsx'
        );

    })->name('reports.export');

});