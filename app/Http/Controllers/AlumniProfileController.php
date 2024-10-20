<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Job;
use App\Models\ResearchArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlumniProfileController extends Controller
{
    public function show()
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if not authenticated
        }

        // Get the authenticated user's ID
        $id = Auth::user()->id;

        // Find the user by their ID
        $user = User::findOrFail($id);

        // Retrieve the user's jobs and research articles
        $jobsAndInterns = Job::where('user_id', $user->id)->get();
        $researchArticles = ResearchArticle::where('user_id', $user->id)->get();

        // Return the view and pass the user's profile data along with jobs and articles
        return view('alumni.profile', compact('user', 'jobsAndInterns', 'researchArticles'));
    }
}