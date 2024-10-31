<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage; // Import the Storage facade
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Update the user's profile information
        $user->fill($request->validated());

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Validate and store the uploaded image
            $request->validate([
                'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust size and types as necessary
            ]);

            // Store the image and get the path
            $path = $request->file('profile_image')->store('profile_images', 'public');

            // Save the path to the user's profile
            $user->profile_image = $path;
        }

        // Check if the email has changed and reset email verification
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Save the user
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
