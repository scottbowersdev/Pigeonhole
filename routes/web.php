<?php

use App\Models\Month;
use App\Models\OutgoingsRecurring;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index', [
        'months' => Month::orderBy('year', 'asc')->orderBy('month', 'asc')->get()
    ]);
});

Route::get('/view/{id}', function ($id) {
    return view('view', [
        'month' => Month::find($id)
    ]);
});

Route::get('/wishlist', function () {
    return view('wishlist', [
        'wishlist' => Wishlist::orderBy('priority', 'asc')->orderBy('cost', 'asc')->get()
    ]);
});

Route::get('/recurring-outgoings', function () {
    return view('recurring-outgoings', [
        'recurring_outgoings' => OutgoingsRecurring::orderBy('priority', 'asc')->orderBy('cost', 'asc')->get()
    ]);
});
