<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch statistical data
        // $totalUsers = User::count();
        // $approvedUsers = User::where('status', 'approved')->count();
        // $pendingRequests = User::where('status', 'pending')->count();
        // $deniedRequests = User::where('status', 'denied')->count();
        // $pendingRequestsCount = $pendingRequests;

        // // Fetch pending requests
        // $pendingRequests = User::where('status', 'pending')->get();

        // return view('admin.dashboard', compact('totalUsers', 'approvedUsers', 'pendingRequests', 'deniedRequests', 'pendingRequestsCount'));
        // Dummy values for testing
        // Dummy values for testing
        $totalUsers = 100;  // Total number of users
        $approvedUsers = 60;  // Number of users with 'approved' status
        $pendingRequestsCount = 30;  // Number of users with 'pending' status
        $deniedRequests = 10;  // Number of users with 'denied' status

        // Create dummy users for pending requests with name, email, and type
        $pendingRequests = collect([
            (object)[
                'id' => 1, 
                'name' => 'User 1', 
                'email' => 'user1@example.com', 
                'type' => 'Student', 
                'status' => 'pending'
            ],
            (object)[
                'id' => 2, 
                'name' => 'User 2', 
                'email' => 'user2@example.com', 
                'type' => 'Lecturer', 
                'status' => 'pending'
            ],
            (object)[
                'id' => 3, 
                'name' => 'User 3', 
                'email' => 'user3@example.com', 
                'type' => 'Alumni', 
                'status' => 'pending'
            ],
        ]);

        return view('admin.dashboard', compact('totalUsers', 'approvedUsers', 'pendingRequests', 'deniedRequests', 'pendingRequestsCount'));

    }

    public function approve($id)
    {
        $user = User::find($id);
        $user->status = 'approved';
        $user->save();

        return redirect()->route('admin.home')->with('success', 'User approved successfully');
    }

    public function deny($id)
    {
        $user = User::find($id);
        $user->status = 'denied';
        $user->save();

        return redirect()->route('admin.home')->with('error', 'User denied successfully');
    }
}
