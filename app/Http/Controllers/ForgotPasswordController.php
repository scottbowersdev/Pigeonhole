<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function index() {
        return view('auth.forgot-password');
    }

    public function store() {
       
        request()->validate(['email' => 'required|email']);
 
        $status = Password::sendResetLink(
            request()->only('email')
        );
        
        return $status === Password::ResetLinkSent
                        ? back()->with(['status' => __($status)])
                        : back()->withErrors(['email' => __($status)]);

    }

    public function view($token) {
       
        return view('auth.reset-password', ['token' => $token]);

    }

    public function update() {

        request()->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::min(6)->numbers()->letters()->mixedCase()]
            
        ]);
     
        $status = Password::reset(
            request()->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(\Illuminate\Support\Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PasswordReset
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }

}
