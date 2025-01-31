<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Outgoing;
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

        // Add new recurring outgoing to all future monthly outgoings
        $user = Auth::user();
        $months = $user->months()->where('year', '>=', date('Y'))->where('month', '>', date('n'))->get();

        foreach($months as $month) {
            $new_outgoing = $month->outgoings()->create([
                'title' => $outgoingRecurring->title,
                'cost' => $outgoingRecurring->cost,
                'day' => $outgoingRecurring->day,
                'recurring' => 1
            ]);

            if(request('category') != null) {
                $new_outgoing->categories()->attach(request('category'));
            }
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

        // Update recurring outgoing for all future monthly outgoings
        $user = Auth::user();
        $months = $user->months()->whereHas('outgoings', function($query) use($outgoingsRecurring) {
                $query->where('recurring', 1)->where('day', $outgoingsRecurring->day)->where('title', $outgoingsRecurring->title)->where('cost', $outgoingsRecurring->cost);
            })->where('year', '>=', date('Y'))->where('month', '>', date('n'))->get();

        foreach($months as $month) {

            $existing_outgoing = Outgoing::where('month_id', $month->id)->where('recurring', 1)->where('day', $outgoingsRecurring->day)->where('title', $outgoingsRecurring->title)->where('cost', $outgoingsRecurring->cost)->first();
            
            $existing_outgoing->update([
                'title' => request('title'),
                'cost' => request('cost'),
                'day' => request('day')
            ]);

            if(request('category') != null && (request('category') != $outgoingsRecurring->categories()->first()->id)) {
                $existing_outgoing->categories()->detach();
                $existing_outgoing->categories()->attach(request('category'));
            }

        }

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

        // Update recurring outgoing for all future monthly outgoings
        $user = Auth::user();
        $months = $user->months()->whereHas('outgoings', function($query) use($outgoingsRecurring) {
                $query->where('recurring', 1)->where('day', $outgoingsRecurring->day)->where('title', $outgoingsRecurring->title)->where('cost', $outgoingsRecurring->cost);
            })->where('year', '>=', date('Y'))->where('month', '>', date('n'))->get();

        foreach($months as $month) {

            $existing_outgoing = Outgoing::where('month_id', $month->id)->where('recurring', 1)->where('day', $outgoingsRecurring->day)->where('title', $outgoingsRecurring->title)->where('cost', $outgoingsRecurring->cost)->first();
            
            $existing_outgoing->delete();
            $existing_outgoing->categories()->detach();

        }

        // Delete
        $outgoingsRecurring->delete();

        // Redirect
        return redirect('/recurring-outgoings')->withSuccess('Your recurring outgoing has been deleted successfully.');
    }

    public function delete(OutgoingsRecurring $outgoingsRecurring)
    {

        // Update recurring outgoing for all future monthly outgoings
        $user = Auth::user();
        $months = $user->months()->whereHas('outgoings', function($query) use($outgoingsRecurring) {
                $query->where('recurring', 1)->where('day', $outgoingsRecurring->day)->where('title', $outgoingsRecurring->title)->where('cost', $outgoingsRecurring->cost);
            })->where('year', '>=', date('Y'))->where('month', '>', date('n'))->get();

        foreach($months as $month) {

            $existing_outgoing = Outgoing::where('month_id', $month->id)->where('recurring', 1)->where('day', $outgoingsRecurring->day)->where('title', $outgoingsRecurring->title)->where('cost', $outgoingsRecurring->cost)->first();
            
            $existing_outgoing->delete();
            $existing_outgoing->categories()->detach();

        }

        // Delete
        $outgoingsRecurring->delete();

        // Redirect
        return redirect('/recurring-outgoings')->withSuccess('Your recurring outgoing has been deleted successfully.');
    }
}
