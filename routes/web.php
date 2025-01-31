<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OutgoingsController;
use App\Http\Controllers\OutgoingsRecurringController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\WishlistController;
use App\Models\Category;
use App\Models\Month;
use App\Models\OutgoingsRecurring;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Dashboard
Route::get('/', function () {
    Auth::user()->generateMonths();
    return view('index', [
        'months' => Month::where('year', '>=', date('Y'))->where('month', '>=', date('n'))->where('user_id', Auth::id())->orderBy('year', 'asc')->orderBy('month', 'asc')->with('outgoings')->get(),
    ]);
})->middleware('auth');

// Months
Route::get('/month/{month}', function (Month $month) {
    return view('outgoings.index', [
        'month' => $month,
    ]);
})
->middleware('auth')
->can('access', 'month');

//Categories
Route::get('/categories', [CategoryController::class, 'index'])
    ->middleware('auth');

Route::get('/categories/new', [CategoryController::class, 'create'])
    ->middleware('auth');

Route::post('/categories', [CategoryController::class, 'store'])
    ->middleware('auth');

Route::get('/categories/edit/{category}', [CategoryController::class, 'edit'])
    ->middleware('auth')
    ->can('access', 'category');

Route::patch('/categories/{category}', [CategoryController::class, 'update'])
    ->middleware('auth')
    ->can('access', 'category');

Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
    ->middleware('auth')
    ->can('access', 'category');

Route::get('/categories/delete/{category}', [CategoryController::class, 'delete'])
    ->middleware('auth')
    ->can('access', 'category');

//Outgoings
Route::get('/month/{month}/new-outgoing', [OutgoingsController::class, 'create'])
    ->middleware('auth');

Route::post('/outgoings/{id}', [OutgoingsController::class, 'store'])
    ->middleware('auth');

Route::get('/outgoings/edit/{outgoing}', [OutgoingsController::class, 'edit'])
    ->middleware('auth')
    ->can('access', 'outgoing');

Route::patch('/outgoings/{outgoing}', [OutgoingsController::class, 'update'])
    ->middleware('auth')
    ->can('access', 'outgoing');

Route::delete('/outgoings/{outgoing}', [OutgoingsController::class, 'destroy'])
    ->middleware('auth')
    ->can('access', 'outgoing');

Route::get('/outgoings/delete/{outgoing}', [OutgoingsController::class, 'delete'])
    ->middleware('auth')
    ->can('access', 'outgoing');

Route::get('/outgoings/paid/{outgoing}', [OutgoingsController::class, 'paid'])
    ->middleware('auth')
    ->can('access', 'outgoing');


// Wishlist
Route::get('/wishlist', [WishlistController::class, 'index'])
    ->middleware('auth');

Route::get('/wishlist/new', [WishlistController::class, 'create'])
    ->middleware('auth');

Route::post('/wishlist', [WishlistController::class, 'store'])
    ->middleware('auth');

Route::get('/wishlist/edit/{wishlist}', [WishlistController::class, 'edit'])
    ->middleware('auth')
    ->can('access', 'wishlist');

Route::patch('/wishlist/{wishlist}', [WishlistController::class, 'update'])
    ->middleware('auth')
    ->can('access', 'wishlist');

Route::delete('/wishlist/{wishlist}', [WishlistController::class, 'destroy'])
    ->middleware('auth')
    ->can('access', 'wishlist');

Route::get('/wishlist/delete/{wishlist}', [WishlistController::class, 'delete'])
    ->middleware('auth')
    ->can('access', 'wishlist');

Route::get('/wishlist/paid/{wishlist}', [WishlistController::class, 'paid'])
    ->middleware('auth')
    ->can('access', 'wishlist');


// Recurring Outgoings
Route::get('/recurring-outgoings', [OutgoingsRecurringController::class, 'index'])
    ->middleware('auth');

Route::get('/recurring-outgoings/new', [OutgoingsRecurringController::class, 'create'])
    ->middleware('auth');

Route::post('/recurring-outgoings', [OutgoingsRecurringController::class, 'store'])
    ->middleware('auth');

Route::get('/recurring-outgoings/edit/{outgoingsRecurring}', [OutgoingsRecurringController::class, 'edit'])
    ->middleware('auth')
    ->can('access', 'outgoingsRecurring');

Route::patch('/recurring-outgoings/{outgoingsRecurring}', [OutgoingsRecurringController::class, 'update'])
    ->middleware('auth')
    ->can('access', 'outgoingsRecurring');

Route::delete('/recurring-outgoings/{outgoingsRecurring}', [OutgoingsRecurringController::class, 'destroy'])
    ->middleware('auth')
    ->can('access', 'outgoingsRecurring');

Route::get('/recurring-outgoings/delete/{outgoingsRecurring}', [OutgoingsRecurringController::class, 'delete'])
    ->middleware('auth')
    ->can('access', 'outgoingsRecurring');

// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);

Route::post('/logout', [SessionController::class, 'destroy']);
