<?php

use App\Models\Month;
use App\Models\Outgoing;
use App\Models\OutgoingsRecurring;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Route;

/* =============
    DASHBOARD
/* ============= */

Route::get('/', function () {
    return view('index', [
        'months' => Month::orderBy('year', 'asc')->orderBy('month', 'asc')->with('outgoings')->get()
    ]);
});

/* =============
    OUTGOINGS
/* ============= */
// New - View
Route::get('/month/{id}/new-outgoing', function ($id) {

    return view('outgoings.create', [
        'month' => Month::find($id)
    ]);
});

// New - Create
Route::post('/outgoings/{id}', function ($id) {

    request()->validate([
        'day' => ['required', 'numeric', 'min:1', 'max:31'],
        'title' => ['required'],
        'cost' => ['required', 'numeric', 'min:0.01']
    ]);

    Outgoing::create([
        'month_id' => $id,
        'recurring' => 0,
        'day' => request('day'),
        'title' => request('title'),
        'cost' => request('cost'),
        'paid' => 0
    ]);
    return redirect('/month/' . $id)->withSuccess('Your outgoing has been added successfully.');
});

// Edit - View
Route::get('/edit-outgoing/{id}', function ($id) {
    return view('outgoings.edit', [
        'outgoing' => Outgoing::find($id),
        'month' => Outgoing::find($id)->month
    ]);
});

// Edit - Patch
Route::patch('/outgoings/{id}', function ($id) {

    // Validate
    request()->validate([
        'day' => ['required', 'numeric', 'min:1', 'max:31'],
        'title' => ['required'],
        'cost' => ['required', 'numeric', 'min:0.01']
    ]);

    // Authorise

    // Update
    $outgoing = Outgoing::FindOrFail($id);
    $month = $outgoing->month;
    $outgoing->update([
        'day' => request('day'),
        'title' => request('title'),
        'cost' => request('cost'),
    ]);

    // Redirect
    return redirect('/month/' . $month->id)->withSuccess('Your outgoing has been updated successfully.');
});

// Delete - Delete
Route::delete('/outgoings/{id}', function ($id) {

    // Authorise

    // Delete
    $outgoing = Outgoing::FindOrFail($id);
    $month = $outgoing->month;
    $outgoing->delete();

    // Redirect
    return redirect('/month/' . $month->id)->withSuccess('Your outgoing has been deleted successfully.');
});

// Delete - View
Route::get('/outgoings/delete/{id}', function ($id) {

    // Authorise

    // Delete
    $outgoing = Outgoing::FindOrFail($id);
    $month = $outgoing->month;
    $outgoing->delete();

    // Redirect
    return redirect('/month/' . $month->id)->withSuccess('Your outgoing has been deleted successfully.');
});

// Mark as paid - View
Route::get('/outgoings/paid/{id}', function ($id) {

    // Authorise

    // Delete
    $outgoing = Outgoing::FindOrFail($id);
    $month = $outgoing->month;
    $outgoing->update([
        'paid' => ($outgoing->paid == 1 ? 0 : 1)
    ]);

    // Redirect
    return redirect('/month/' . $month->id)->withSuccess('Your outgoing has been marked as ' . ($outgoing->paid == 1 ? 'paid' : 'unpaid') . '.');
});

/* =============
    MONTHS
/* ============= */
Route::get('/month/{id}', function ($id) {
    return view('outgoings.index', [
        'month' => Month::find($id),
    ]);
});

/* =============
    WISHLIST
/* ============= */
Route::get('/wishlist/new', function () {
    return view('wishlist.create');
});

Route::get('/wishlist', function () {

    return view('wishlist.index', [
        'wishlist' => Wishlist::where('purchased', '0')->orderBy('priority', 'asc')->orderBy('cost', 'asc')->paginate(10),
        'wishlist_tot' => Wishlist::where('purchased', '0')->sum('cost')
    ]);
});

// New - Create
Route::post('/wishlist/new', function () {

    request()->validate([
        'priority' => ['required', 'numeric'],
        'title' => ['required'],
        'cost' => ['required', 'numeric', 'min:0.01']
    ]);

    Wishlist::create([
        'user_id' => 1,
        'priority' => request('priority'),
        'title' => request('title'),
        'cost' => request('cost'),
        'url' => request('url'),
        'purchased' => 0
    ]);
    return redirect('/wishlist')->withSuccess('Your wishlist item has been added successfully.');
});

// Edit - View
Route::get('/wishlist/edit/{id}', function ($id) {
    return view('wishlist.edit', [
        'wishlist' => Wishlist::find($id)
    ]);
});

// Edit - Patch
Route::patch('/wishlist/{id}', function ($id) {

    // Validate
    request()->validate([
        'priority' => ['required', 'numeric'],
        'title' => ['required'],
        'cost' => ['required', 'numeric', 'min:0.01']
    ]);

    // Authorise

    // Update
    $wishlist = Wishlist::FindOrFail($id);
    $wishlist->update([
        'priority' => request('priority'),
        'title' => request('title'),
        'cost' => request('cost'),
        'url' => request('url'),
    ]);

    // Redirect
    return redirect('/wishlist')->withSuccess('Your wishlist item has been updated successfully.');
});

// Delete - Delete
Route::delete('/wishlist/{id}', function ($id) {

    // Authorise

    // Delete
    $wishlist = Wishlist::FindOrFail($id);
    $wishlist->delete();

    // Redirect
    return redirect('/wishlist')->withSuccess('Your wishlist item has been deleted successfully.');
});

// Delete - View
Route::get('/wishlist/delete/{id}', function ($id) {

    // Authorise

    // Delete
    $wishlist = Wishlist::FindOrFail($id);
    $wishlist->delete();

    // Redirect
    return redirect('/wishlist')->withSuccess('Your wishlist item has been deleted successfully.');
});

// Mark as paid - View
Route::get('/wishlist/paid/{id}', function ($id) {

    // Authorise

    // Delete
    $wishlist = Wishlist::FindOrFail($id);
    $wishlist->update([
        'purchased' => 1,
        'date_purchased' => date('Y-m-d H:i:s')
    ]);

    // Redirect
    return redirect('/wishlist')->withSuccess('Your wishlist item has been marked as purchased');
});

/* =============
    RECURRING OUTGOINGS
/* ============= */
Route::get('/recurring-outgoings', function () {
    return view('recurring-outgoings.index', [
        'recurring_outgoings' => OutgoingsRecurring::orderBy('day', 'asc')->orderBy('cost', 'asc')->get()
    ]);
});

Route::get('/recurring-outgoings/new', function () {
    return view('recurring-outgoings.create');
});

// New - Create
Route::post('/recurring-outgoings/new', function () {

    request()->validate([
        'day' => ['required', 'numeric', 'min:1', 'max:31'],
        'title' => ['required'],
        'cost' => ['required', 'numeric', 'min:0.01']
    ]);

    OutgoingsRecurring::create([
        'user_id' => 1,
        'day' => request('day'),
        'title' => request('title'),
        'cost' => request('cost')
    ]);
    return redirect('/recurring-outgoings')->withSuccess('Your recurring outgoing has been added successfully.');
});

// Edit - View
Route::get('/recurring-outgoings/edit/{id}', function ($id) {
    return view('recurring-outgoings.edit', [
        'recurring_outgoings' => OutgoingsRecurring::find($id)
    ]);
});

// Edit - Patch
Route::patch('/recurring-outgoings/{id}', function ($id) {

    request()->validate([
        'day' => ['required', 'numeric', 'min:1', 'max:31'],
        'title' => ['required'],
        'cost' => ['required', 'numeric', 'min:0.01']
    ]);

    // Authorise

    // Update
    $recurring_outgoing = OutgoingsRecurring::FindOrFail($id);
    $recurring_outgoing->update([
        'day' => request('day'),
        'title' => request('title'),
        'cost' => request('cost'),
    ]);

    // Redirect
    return redirect('/recurring-outgoings')->withSuccess('Your recurring outgoing has been updated successfully.');
});

// Delete - Delete
Route::delete('/recurring-outgoings/{id}', function ($id) {

    // Authorise

    // Delete
    $recurring_outgoing = OutgoingsRecurring::FindOrFail($id);
    $recurring_outgoing->delete();

    // Redirect
    return redirect('/recurring-outgoings')->withSuccess('Your recurring outgoing has been deleted successfully.');
});

// Delete - View
Route::get('/recurring-outgoings/delete/{id}', function ($id) {

    // Authorise

    // Delete
    $recurring_outgoing = OutgoingsRecurring::FindOrFail($id);
    $recurring_outgoing->delete();

    // Redirect
    return redirect('/recurring-outgoings')->withSuccess('Your recurring outgoing has been deleted successfully.');
});
