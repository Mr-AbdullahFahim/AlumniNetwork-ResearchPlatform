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
use Illuminate\Validation\Rules\Password;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => [
                'required', 
                'confirmed', 
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->uncompromised(),
            ],
            'role' => ['required', 'in:student,alumni,lecturer'],
            'nic' => ['required', 'string', 'max:12','unique:'.User::class],
            'indexNo' => ['nullable', 'string', 'max:20'],
        ], [
            'password.min' => 'The password must be at least 8 characters.',
            'password.mixedCase' => 'The password must contain both uppercase and lowercase letters.',
            'password.letters' => 'The password must contain at least one letter.',
            'password.numbers' => 'The password must contain at least one number.',
            'password.uncompromised' => 'The password is too common and has been compromised. Please choose a different password.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'nic' => $request->nic,
            'indexNo' => $request->indexNo,
        ]);

        event(new Registered($user));

        return redirect()->route('login')->with('status', 'Registration successful! Please log in after admin approved.');
    }
}
