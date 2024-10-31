<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Filter by role (user, admin, alumni)
        if ($request->has('role') && in_array($request->role, ['user', 'admin', 'alumni'])) {
            $query->where('role', $request->role);
        }

        // Filter by follow status
        if ($request->has('followed')) {
            $followedIds = Auth::user()->follows->pluck('id');
            
            // If 'followed' is 1, only show followed users
            if ($request->followed == 1) {
                $query->whereIn('id', $followedIds);
            } 
            // If 'followed' is 0, only show non-followed users
            elseif ($request->followed == 0) {
                $query->whereNotIn('id', $followedIds);
            }
        }

        $users = $query->get();
        return view('users.index', compact('users'));
    }

    public function follow($id)
    {
        Auth::user()->follows()->attach($id);
        return back()->with('success', 'You are now following this user.');
    }

    public function unfollow($id)
    {
        Auth::user()->follows()->detach($id);
        return back()->with('success', 'You have unfollowed this user.');
    }
}
