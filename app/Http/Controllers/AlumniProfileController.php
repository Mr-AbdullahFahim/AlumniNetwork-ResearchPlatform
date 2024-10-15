<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlumniProfileController extends Controller
{
    // Display the alumni profile with dummy data
    public function index()
    {
        // Dummy alumni data
        $alumni = (object) [
            'name' => 'John Doe',
            'bio' => 'A passionate software developer with a focus on web technologies.',
            'profile_pic' => 'https://via.placeholder.com/150',
        ];

        // Dummy jobs data
        $jobs = collect([
            (object) [
                'title' => 'Software Engineer',
                'company' => 'Tech Solutions Inc.',
                'duration' => 'June 2021 - Present',
            ],
            (object) [
                'title' => 'Intern',
                'company' => 'Web Innovations',
                'duration' => 'Jan 2020 - May 2021',
            ],
        ]);

        // Dummy research articles data
        $researchArticles = collect([
            (object) [
                'title' => 'The Future of Web Development',
                'publication' => 'Tech Journal',
                'link' => 'https://example.com/future-of-web-development',
            ],
            (object) [
                'title' => 'Artificial Intelligence in Daily Life',
                'publication' => 'AI Monthly',
                'link' => 'https://example.com/ai-in-daily-life',
            ],
        ]);

        return view('alumni.index', compact('alumni', 'jobs', 'researchArticles'));
    }

    // Store a new job or internship with dummy functionality
    public function storeJob(Request $request)
    {
        // Simulate storing job data
        return redirect()->back()->with('success', 'Job/Internship added successfully (dummy data).');
    }

    // Store a new research article with dummy functionality
    public function storeResearch(Request $request)
    {
        // Simulate storing research article data
        return redirect()->back()->with('success', 'Research article added successfully (dummy data).');
    }
}