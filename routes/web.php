<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::get('/', [BookController::class, 'index'])->name('home');
Route::get('/category/{type}', [BookController::class, 'showByType'])->name('books.byType');

Route::get('/book/{id}', [BookController::class, 'viewBookDetails'])->name('bookDetails');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {

        if (auth()->user()->role == 'admin') {
            return to_route('admin.dashboard');
        }

        return to_route('home');
    })->name('dashboard');

    include_once __DIR__.'/web/admin.php';
    include_once __DIR__.'/web/customer.php';


});
