<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ProfileController;
use App\Models\Job;
use Illuminate\Http\Request;

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
}
