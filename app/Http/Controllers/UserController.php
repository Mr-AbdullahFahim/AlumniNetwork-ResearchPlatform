<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a list of users, with filtering by role and follow status.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filter by role (student, alumni, lecturer)
        if ($request->has('role') && in_array($request->role, ['student', 'alumni', 'lecturer'])) {
            $query->where('role', $request->role);
        }

        // Filter by follow status
        if ($request->has('followed')) {
            // Retrieve followed user IDs for the authenticated user
            $followedIds = Auth::user()->follows()->pluck('id');
            
            // If 'followed' is 1, show only followed users
            if ($request->followed == 1) {
                $query->whereIn('id', $followedIds);
            }
            // If 'followed' is 0, show only non-followed users
            elseif ($request->followed == 0) {
                $query->whereNotIn('id', $followedIds);
            }
        }

        $me = Auth::user();
        // Paginate the results for improved performance
        $users = $query->paginate(10);

        return view('users.index', compact('users', 'me'));
    }

    /**
     * Follow a user by attaching their ID to the authenticated user's follow list.
     */
    public function follow($id)
    {
        $user = Auth::user();
        $userToFollow = User::find($id);

        if (!$userToFollow) {
            return back()->withErrors(['User not found.']);
        }

        // Check if the user is already followed to avoid duplicate entries
        if (!$user->follows()->where('id', $id)->exists()) {
            $user->follows()->attach($id);
        }

        return back()->with('success', 'You are now following this user.');
    }

    /**
     * Unfollow a user by detaching their ID from the authenticated user's follow list.
     */
    public function unfollow($id)
    {
        $user = Auth::user();
        $userToUnfollow = User::find($id);

        if (!$userToUnfollow) {
            return back()->withErrors(['User not found.']);
        }

        // Check if the user is followed before trying to unfollow
        if ($user->follows()->where('id', $id)->exists()) {
            $user->follows()->detach($id);
        }

        return back()->with('success', 'You have unfollowed this user.');
    }
}
