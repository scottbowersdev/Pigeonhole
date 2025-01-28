<?php

use App\Http\Controllers\OutgoingsController;
use App\Http\Controllers\OutgoingsRecurringController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\WishlistController;
use App\Models\Month;
use App\Models\OutgoingsRecurring;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Route;

//Dashboard
Route::get('/', function () {
    return view('index', [
        'months' => Month::where('year', '>=', date('Y'))->where('month', '>=', date('n'))->orderBy('year', 'asc')->orderBy('month', 'asc')->with('outgoings')->get(),
        'user' => User::find(1)
    ]);
});

// Months
Route::get('/month/{id}', function ($id) {
    return view('outgoings.index', [
        'month' => Month::find($id),
    ]);
});

//Outgoings
Route::controller(OutgoingsController::class)->group(function () {
    Route::get('/month/{month}/new-outgoing', 'create');
    Route::post('/outgoings/{id}', 'store');
    Route::get('/edit-outgoing/{outgoing}', 'edit');
    Route::patch('/outgoings/{outgoing}', 'update');
    Route::delete('/outgoings/{outgoing}', 'destroy');
    Route::get('/outgoings/delete/{outgoing}', 'delete');
    Route::get('/outgoings/paid/{outgoing}', 'paid');
});

// Wishlist
Route::controller(WishlistController::class)->group(function () {
    Route::get('/wishlist', 'index');
    Route::get('/wishlist/new', 'create');
    Route::post('/wishlist', 'store');
    Route::get('/wishlist/edit/{wishlist}', 'edit');
    Route::patch('/wishlist/{wishlist}', 'update');
    Route::delete('/wishlist/{wishlist}', 'destroy');
    Route::get('/wishlist/delete/{wishlist}', 'delete');
    Route::get('/wishlist/paid/{wishlist}', 'paid');
});

// Recurring Outgoings
Route::controller(OutgoingsRecurringController::class)->group(function () {
    Route::get('/recurring-outgoings', 'index');
    Route::get('/recurring-outgoings/new', 'create');
    Route::post('/recurring-outgoings', 'store');
    Route::get('/recurring-outgoings/edit/{outgoingsRecurring}', 'edit');
    Route::patch('/recurring-outgoings/{outgoingsRecurring}', 'update');
    Route::delete('/recurring-outgoings/{outgoingsRecurring}', 'destroy');
    Route::get('/recurring-outgoings/delete/{outgoingsRecurring}', 'delete');
});

// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);
