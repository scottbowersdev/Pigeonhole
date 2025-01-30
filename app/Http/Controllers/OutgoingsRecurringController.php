<?php

namespace App\Http\Controllers;

use App\Models\OutgoingsRecurring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OutgoingsRecurringController extends Controller
{
    public function index()
    {
        return view('recurring-outgoings.index', [
            'recurring_outgoings' => OutgoingsRecurring::where('user_id', Auth::id())->orderBy('day', 'asc')->orderBy('cost', 'asc')->get()
        ]);
    }

    public function create()
    {
        return view('recurring-outgoings.create');
    }

    public function store()
    {
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
    }

    public function edit(OutgoingsRecurring $outgoingsRecurring)
    {
        return view('recurring-outgoings.edit', [
            'recurring_outgoings' => $outgoingsRecurring
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
