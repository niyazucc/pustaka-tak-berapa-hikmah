<?php
use App\Http\Controllers\BookController;
use App\Http\Controllers\DiscountController;
use App\Livewire\CreateBook;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get("dashboard", function () {
        return view("admin.dashboard");
    })->name('dashboard');
    Route::get("profile", function () {
        return view("profile.showadmin");
    })->name('showadmin');
    //book routes
    Route::get('/books', [BookController::class, 'listallbooks'])->name('listbook');
    Route::get('/books/create', [BookController::class, 'create'])->name('create');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('edit');
    Route::post('/books', [BookController::class, 'store'])->name('store');
    Route::put('/books', [BookController::class, 'update'])->name('update');

    //discount routes
    Route::get('/discount', [DiscountController::class, 'listalldiscount'])->name('discount');

    // Route::get('books/create', CreateBook::class);

});
