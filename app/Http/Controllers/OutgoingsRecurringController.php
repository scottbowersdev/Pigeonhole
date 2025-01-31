<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\OutgoingsRecurring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OutgoingsRecurringController extends Controller
{
    public function index()
    {
        return view('recurring-outgoings.index', [
            'recurring_outgoings' => OutgoingsRecurring::where('user_id', Auth::id())->orderBy('day', 'asc')->orderBy('cost', 'asc')->get(),
        ]);
    }

    public function create()
    {
        return view('recurring-outgoings.create', [
            'categories' => Category::where('user_id', Auth::id())->get()
        ]);
    }

    public function store()
    {
        request()->validate([
            'day' => ['required', 'numeric', 'min:1', 'max:31'],
            'title' => ['required'],
            'cost' => ['required', 'numeric', 'min:0.01']
        ]);

        $outgoingRecurring = OutgoingsRecurring::create([
            'user_id' => Auth::id(),
            'day' => request('day'),
            'title' => request('title'),
            'cost' => request('cost')
        ]);

        if(request('category') != null) {
            $outgoingRecurring->categories()->attach(request('category'));
        }


        return redirect('/recurring-outgoings')->withSuccess('Your recurring outgoing has been added successfully.');
    }

    public function edit(OutgoingsRecurring $outgoingsRecurring)
    {
        return view('recurring-outgoings.edit', [
            'recurring_outgoings' => $outgoingsRecurring, 
            'categories' => Category::where('user_id', Auth::id())->get()
        ]);
    }

    public function update(OutgoingsRecurring $outgoingsRecurring)
    {
        request()->validate([
            'day' => ['required', 'numeric', 'min:1', 'max:31'],
            'title' => ['required'],
            'cost' => ['required', 'numeric', 'min:0.01']
        ]);

        // Authorise

        // Update
        $outgoingsRecurring->update([
            'day' => request('day'),
            'title' => request('title'),
            'cost' => request('cost'),
        ]);

        if(request('category') != null) {
            $outgoingsRecurring->categories()->detach();
            $outgoingsRecurring->categories()->attach(request('category'));
        }

        // Redirect
        return redirect('/recurring-outgoings')->withSuccess('Your recurring outgoing has been updated successfully.');
    }

    public function destroy(OutgoingsRecurring $outgoingsRecurring)
    {
        // Authorise

        // Delete
        $outgoingsRecurring->delete();

        // Redirect
        return redirect('/recurring-outgoings')->withSuccess('Your recurring outgoing has been deleted successfully.');
    }

    public function delete(OutgoingsRecurring $outgoingsRecurring)
    {
        // Authorise

        // Delete
        $outgoingsRecurring->delete();

        // Redirect
        return redirect('/recurring-outgoings')->withSuccess('Your recurring outgoing has been deleted successfully.');
    }
}
