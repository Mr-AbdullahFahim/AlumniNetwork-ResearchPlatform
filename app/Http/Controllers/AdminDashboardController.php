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

    public function promoteToAdmin(User $user)
    {
        if ($user->role !== 'admin') {
            // Store the current role before promotion
            $user->previous_role = $user->role;
            $user->role = 'admin';
            $user->save();

            return redirect()->route('admin.users')->with('success', 'User promoted to admin successfully!');
        }

        return redirect()->route('admin.users')->with('error', 'User is already an admin.');
    }

    public function depromoteFromAdmin(User $user)
    {
        if ($user->role === 'admin' && $user->previous_role) {
            // Restore the previous role
            $user->role = $user->previous_role;
            $user->previous_role = null;
            $user->save();

            return redirect()->route('admin.users')->with('success', 'Admin depromoted to their previous role successfully!');
        }

        return redirect()->route('admin.users')->with('error', 'Cannot depromote this user.');
    }
    public function reports()
    {
        // Example data aggregation
        $userCountByRole = User::select('role')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('role')
            ->get();

        $userCountByStatus = User::select('status')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('status')
            ->get();

        // Pass the data to the view
        return view('admin.reports', [
            'userCountByRole' => $userCountByRole,
            'userCountByStatus' => $userCountByStatus,
        ]);
    }
}
