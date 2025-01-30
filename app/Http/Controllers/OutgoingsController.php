<?php

namespace App\Http\Controllers;

use App\Models\Month;
use App\Models\Outgoing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OutgoingsController extends Controller
{
    public function index() {}

    public function create(Month $month)
    {

        Gate::define('access', function ($user, $month) {
            return $month->user->is($user);
        });

        Gate::authorize('access', $month);

        return view('outgoings.create', [
            'month' => $month
        ]);
    }

    public function show() {}

    public function store($id)
    {
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
    }

    public function edit(Outgoing $outgoing)
    {
        return view('outgoings.edit', [
            'outgoing' => $outgoing,
            'month' => $outgoing->month
        ]);
    }

    public function update(Outgoing $outgoing)
    {
        // Validate
        request()->validate([
            'day' => ['required', 'numeric', 'min:1', 'max:31'],
            'title' => ['required'],
            'cost' => ['required', 'numeric', 'min:0.01']
        ]);

        // Authorise

        // Update
        $month = $outgoing->month;
        $outgoing->update([
            'day' => request('day'),
            'title' => request('title'),
            'cost' => request('cost'),
        ]);

        // Redirect
        return redirect('/month/' . $month->id)->withSuccess('Your outgoing has been updated successfully.');
    }

    public function destroy(Outgoing $outgoing)
    {
        // Authorise

        // Delete
        $month = $outgoing->month;
        $outgoing->delete();

        // Redirect
        return redirect('/month/' . $month->id)->withSuccess('Your outgoing has been deleted successfully.');
    }

    public function delete(Outgoing $outgoing)
    {
        // Authorise

        // Delete
        $month = $outgoing->month;
        $outgoing->delete();

        // Redirect
        return redirect('/month/' . $month->id)->withSuccess('Your outgoing has been deleted successfully.');
    }

    public function paid(Outgoing $outgoing)
    {
        // Authorise

        // Delete
        $month = $outgoing->month;
        $outgoing->update([
            'paid' => ($outgoing->paid == 1 ? 0 : 1)
        ]);

        // Redirect
        return redirect('/month/' . $month->id)->withSuccess('Your outgoing has been marked as ' . ($outgoing->paid == 1 ? 'paid' : 'unpaid') . '.');
    }
}
