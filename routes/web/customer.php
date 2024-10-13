<?php
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Livewire\CreateBook;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeController;

Route::prefix('customer')->name('customer.')->group(function () {


    //view cart
    Route::get('/cart', [CartController::class, 'view'])->name('view');

    //payment
    Route::post('/checkout', [StripeController::class, 'stripeCheckout'])->name('payment');
    Route::get('/checkout/success', [StripeController::class, 'success'])->name('payment.success');
    Route::get('/checkout/canceled', [StripeController::class, 'cancel'])->name('payment.cancel');

    // Route::get('/books', [BookController::class, 'listallbooks'])->name('listbook');
    // Route::get('/books/create', [BookController::class, 'create'])->name('create');
    // Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('edit');
    // Route::post('/books', [BookController::class, 'store'])->name('store');
    // Route::get('/books/{book}/edit', CreateBook::class)->name('edit');
    // Route::get('books/create', CreateBook::class);

});
