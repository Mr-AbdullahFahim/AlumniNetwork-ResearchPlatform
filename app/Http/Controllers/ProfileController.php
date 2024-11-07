<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
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
     * Update the user's profile information, including handling profile picture upload.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Validate additional fields such as nic and indexNo
        $request->validate([
            'nic' => 'required|string|max:20',
            'indexNo' => 'nullable|string|max:20',
            'google_scholar' => 'nullable|url',
            'github' => 'nullable|url',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update the user's profile information with validated data
        $user->fill($request->only([
            'name', 'email', 'nic', 'indexNo', 'bio', 'google_scholar', 'github'
        ]));

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete the old profile image if it exists
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            // Store the new profile image and get its path
            $path = $request->file('profile_image')->store('profile_images', 'public');

            // Update the user model with the new image path
            $user->profile_image = $path;
        }

        // Update bio field if present in the request
        if ($request->filled('bio')) {
            $user->bio = $request->input('bio');
        }

        // Reset email verification if email has changed
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Set links for Google Scholar and GitHub if provided
        $user->google_scholar = $request->google_scholar;
        $user->github = $request->github;

        // Save the updated user information
        $user->save();

        return redirect()->back()->with('status', 'profile-updated');
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

        // Log out the user
        Auth::logout();

        // Delete the user's profile image from storage if it exists
        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
        }

        // Delete the user account
        $user->delete();

        // Invalidate and regenerate the session token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
