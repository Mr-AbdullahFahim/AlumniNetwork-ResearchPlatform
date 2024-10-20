<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Fetch statistical data
        $totalUsers = User::count();
        $approvedUsers = User::where('status', 'approved')->count();
        $pendingRequests = User::where('status', 'pending')->count();
        $deniedRequests = User::where('status', 'denied')->count();
        $pendingRequestsCount = $pendingRequests;

        // Fetch pending requests
        $pendingRequests = User::where('status', 'pending')->get();

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

    public function approveUser(User $user)
    {
        $user->status = 'approved';
        $user->save();

        return redirect()->route('admin.users')->with('success', 'User approved successfully!');
    }

        public function removeUser(User $user)
    {
        // Change the user's status to rejected when "removing"
        $user->status = 'rejected';
        $user->save();

        return redirect()->route('admin.users')->with('success', 'User has been removed and status changed to rejected.');
    }


    // User management methods

    public function indexUsers(Request $request)
    {
        // Fetch and filter users by role
        $role = $request->query('role');
        $users = User::when($role, function ($query) use ($role) {
            return $query->where('role', $role);
        })->get();

        return view('admin.users.index', compact('users'));
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }
}
