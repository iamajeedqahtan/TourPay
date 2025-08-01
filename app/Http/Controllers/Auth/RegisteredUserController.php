<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): View
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nationality' => ['required', 'string', 'max:100'],
            'passport_country_code' => ['required', 'string', 'max:10'],
            'passport_number' => ['required', 'string', 'max:50'],
            'phone_country_code' => ['required', 'string', 'max:10'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Combine phone parts
        $fullPhone = $request->input('phone_country_code') . $request->input('phone');

        $user = User::create([
            'name' => $request->input('name'),
            'nationality' => $request->input('nationality'),
            'passport_country_code' => $request->input('passport_country_code'),
            'passport_number' => $request->input('passport_number'),
            'phone' => $fullPhone,
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        event(new Registered($user));

        Auth::login($user);

        #return redirect(route('dashboard', absolute: false));
        return view('auth.post-register');
    }
}
