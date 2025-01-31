<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        return view('wishlist.index', [
            'wishlist' => Wishlist::where('purchased', '0')->where('user_id', Auth::id())->orderBy('priority', 'asc')->orderBy('cost', 'asc')->paginate(10),
        ]);
    }

    public function create()
    {
        return view('wishlist.create', [
            'categories' => Category::where('user_id', Auth::id())->get()
        ]);
    }

    public function store()
    {
        request()->validate([
            'priority' => ['required', 'numeric'],
            'title' => ['required'],
            'cost' => ['required', 'numeric', 'min:0.01']
        ]);

        $wishlist = Wishlist::create([
            'user_id' => Auth::id(),
            'priority' => request('priority'),
            'title' => request('title'),
            'cost' => request('cost'),
            'url' => request('url'),
            'purchased' => 0
        ]);

        if(request('category') != null) {
            $wishlist->categories()->attach(request('category'));
        }

        return redirect('/wishlist')->withSuccess('Your wishlist item has been added successfully.');
    }

    public function show() {}

    public function edit(Wishlist $wishlist)
    {
        return view('wishlist.edit', [
            'wishlist' => $wishlist, 
            'categories' => Category::where('user_id', Auth::id())->get()
        ]);
    }

    public function update(Wishlist $wishlist)
    {
        // Validate
        request()->validate([
            'priority' => ['required', 'numeric'],
            'title' => ['required'],
            'cost' => ['required', 'numeric', 'min:0.01']
        ]);

        // Authorise

        // Update
        $wishlist->update([
            'priority' => request('priority'),
            'title' => request('title'),
            'cost' => request('cost'),
            'url' => request('url'),
        ]);

        if(request('category') != null) {
            $wishlist->categories()->detach();
            $wishlist->categories()->attach(request('category'));
        }


        // Redirect
        return redirect('/wishlist')->withSuccess('Your wishlist item has been updated successfully.');
    }

    public function destroy(Wishlist $wishlist)
    {
        // Authorise

        // Delete
        $wishlist->delete();

        // Redirect
        return redirect('/wishlist')->withSuccess('Your wishlist item has been deleted successfully.');
    }

    public function delete(Wishlist $wishlist)
    {
        // Authoris

        // Delete
        $wishlist->delete();

        // Redirect
        return redirect('/wishlist')->withSuccess('Your wishlist item has been deleted successfully.');
    }

    public function paid(Wishlist $wishlist)
    {
        // Authorise

        // Delete
        $wishlist->update([
            'purchased' => 1,
            'date_purchased' => date('Y-m-d H:i:s')
        ]);

        // Redirect
        return redirect('/wishlist')->withSuccess('Your wishlist item has been marked as purchased');
    }
}
