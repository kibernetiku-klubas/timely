<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
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

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:30',
                'unique:users,name,' . strtolower($request->input('name')),
                'regex:/^[a-zA-Z0-9]+(?:\s[a-zA-Z0-9]+)*$/',
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $lowercaseName = strtolower($request->input('name'));

        if (User::where('name', $lowercaseName)->exists()) {
            return redirect()->back()->withErrors(['name' => 'This name is already taken. Please choose a different one.']);
        }

        $user = User::create([
            'name' => $lowercaseName,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
