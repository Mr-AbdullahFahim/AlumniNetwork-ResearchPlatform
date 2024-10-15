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
}
