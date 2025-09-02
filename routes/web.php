<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\MonthController;
use App\Http\Controllers\OutgoingsController;
use App\Http\Controllers\OutgoingsRecurringController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\UserController;
use App\Models\Month;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Dashboard
Route::get('/', function () {

    Auth::user()->generateMonths();

    $now   = now(); 
    $year  = (int) $now->year;
    $month = (int) $now->month;

    return view('index', [
        'months' => Month::where('user_id', Auth::id())
            ->where(function ($q) use ($year, $month) {
                $q->where('year', '>', $year)
                    ->orWhere(function ($q) use ($year, $month) {
                        $q->where('year', $year)
                            ->where('month', '>=', $month);
                    });
            })
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->with('outgoings')
            ->get()
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

Route::patch('/month/{month}', [MonthController::class, 'update'])
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
Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');

Route::get('/login', [SessionController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [SessionController::class, 'store'])->middleware('guest');

Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'view'])->middleware('guest')->name('password.reset');
Route::patch('/reset-password', [ForgotPasswordController::class, 'update'])->middleware('guest')->name('password.update');

Route::get('/logout', [SessionController::class, 'destroy'])->middleware('auth');

// Profile
Route::get('/profile', [UserController::class, 'index'])->middleware('auth');
Route::patch('/profile', [UserController::class, 'update'])->middleware('auth');
