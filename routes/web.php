<?php

use App\Models\Month;
use App\Models\Outgoing;
use App\Models\OutgoingsRecurring;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index', [
        'months' => Month::orderBy('year', 'asc')->orderBy('month', 'asc')->with('outgoings')->get()
    ]);
});

Route::get('/view/{id}/new', function ($id) {

    return view('outgoings.create', [
        'month' => Month::find($id)
    ]);
});

Route::post('/view/{id}/new', function ($id) {

    Outgoing::create([
        'month_id' => $id,
        'recurring' => 0,
        'day' => request('day'),
        'title' => request('title'),
        'cost' => request('cost'),
        'paid' => 0
    ]);
    return redirect('/view/' . $id);
});

Route::get('/view/{id}', function ($id) {
    return view('outgoings.index', [
        'month' => Month::find($id),
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
