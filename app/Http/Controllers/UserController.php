<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {
        return view('profile');
    }

    public function update() {

        $user = Auth::user();
        $monthly_income_current = $user->monthly_income;

        // Update user
        $attributes = request()->validate([
            'first_name' => ['required'],
            'surname' => ['required'],
            'monthly_income' => ['required', 'numeric'],
            'email' => ['required', 'email'],
        ]);
        $user->update($attributes);

        // Update monthly for all future months
        if($monthly_income_current != $attributes['monthly_income']) {
            $user->months()->where('year', '>=', date('Y'))->where('month', '>', date('n'))->update([
                'income' => $attributes['monthly_income'],
            ]);
        }

        Auth::setUser($user);

        return redirect('/profile')->withSuccess('Your profile has been updated successfully.');

    }
}
