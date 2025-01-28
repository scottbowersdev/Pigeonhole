<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create() {
        return view('auth.register');
    }

    public function store() {
       
        $attributes = request()->validate([
            'first_name' => ['required'],
            'surname' => ['required'],
            'monthly_income' => ['required', 'numeric'],
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(6)->numbers()->letters()->mixedCase(), 'confirmed'],
        ]);

        $user = User::create($attributes);

        Auth::login($user);

        return redirect('/');

    }
}
