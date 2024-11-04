<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ProfileController;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function dashboard()
    {
        $recentJobs = Job::orderBy('created_at', 'desc')->take(3)->get();
        $user=auth()->user()->name;
        return view('dashboard', compact('recentJobs','user'));
    }

    public function index()
    {
        $jobs = Job::all();
        return view('jobs.index', compact('jobs'));
    }
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'locationType' => 'required|in:Onsite,Remote,Hybrid',
            'location' => 'nullable|string|max:255',
            'description' => 'required|string',
            'job_link' => 'nullable|string|max:255',
            'type' => 'required|in:job,internship',
        ]);

        $emailPattern = '/^[\w\.\-]+@[\w\.\-]+\.[a-zA-Z]{2,7}$/';

        // Regular expression for web URLs (supports http, https, www)
        $urlPattern = '/^(https?:\/\/|www\.)[a-zA-Z0-9\-\._~:\/?#\[\]@!$&\'()*+,;=%]+$/';

        $url="";

        if (preg_match($emailPattern, $request->input('job_link'))) {
            $url="mailto::".($request->input('job_link'));
        } elseif (preg_match($urlPattern, $request->input('job_link'))) {
            $url=$request->input('job_link');
        }

        // Handle the special case of 'Remote' where location is not required
        $location = $request->input('locationType') === 'Remote' ? null : $request->input('location');

        // Store the job or internship in the database
        Job::create([
            'user_id' => Auth::id(),  // Assuming the logged-in user is submitting the form
            'title' => $request->input('title'),
            'company' => $request->input('company'),
            'location_type' => $request->input('locationType'),
            'location' => $location, // Save location only if provided
            'description' => $request->input('description'),
            'type' => $request->input('type'),
            'job_link' => $url,
            'posted_at' => now(), // Assuming you want to set the current timestamp as the posted date
        ]);

        // Redirect or return a success response
        return redirect()->back()->with('success', 'Job or Internship added successfully.');
    }
}
