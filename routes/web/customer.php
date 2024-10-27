<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BelianController;
use App\Http\Controllers\StripeController;

Route::prefix('customer')->name('customer.')->group(function () {

    //belian purchase
    Route::get('/belian',[BelianController::class,'index'])->name('belian');
    Route::get('/belian/{orders_id}',[BelianController::class,'viewOrderDetails'])->name('view-order-details');
    Route::put('/orders/{id}/update-status', [BelianController::class, 'updateStatus'])->name('updateStatus');

    //view cart
    Route::get('/cart', [CartController::class, 'view'])->name('view');
    Route::post('/cart/add', [CartController::class, 'add'])->name('addtocart');


    //payment
    Route::post('/checkout', [StripeController::class, 'stripeCheckout'])->name('payment');
    Route::get('/checkout/success', [StripeController::class, 'success'])->name('payment.success');
    Route::get('/checkout/canceled', [StripeController::class, 'cancel'])->name('payment.cancel');


});
