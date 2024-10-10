<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Job::create([
            'title' => 'Software Engineer',
            'description' => 'We are looking for a talented software engineer...',
            'company' => 'TechCorp',
            'location' => 'San Francisco, CA',
            'type' => 'job',
            'posted_at' => now(),
        ]);

        Job::create([
            'title' => 'Web Development Intern',
            'description' => 'Join our internship program and learn web development skills.',
            'company' => 'WebStart',
            'location' => 'Remote',
            'type' => 'internship',
            'posted_at' => now(),
        ]);

        Job::create([
            'title' => 'Software Engineer',
            'description' => 'Looking for a skilled Software Engineer to join our team.',
            'company' => 'Tech Solutions',
            'location' => 'New York, NY',
            'type' => 'job',
            'posted_at' => now(),
        ]);

        Job::create([
            'title' => 'Marketing Intern',
            'description' => 'Assisting the marketing team in various campaigns.',
            'company' => 'MarketMakers',
            'location' => 'Los Angeles, CA',
            'type' => 'internship',
            'posted_at' => now(),
        ]);

        Job::create([
            'title' => 'Data Analyst',
            'description' => 'Analyze data to help make business decisions.',
            'company' => 'Data Insights',
            'location' => 'Chicago, IL',
            'type' => 'job',
            'posted_at' => now(),
        ]);

        Job::create([
            'title' => 'Graphic Design Intern',
            'description' => 'Help create visual content for our marketing efforts.',
            'company' => 'Creative Co.',
            'location' => 'Remote',
            'type' => 'internship',
            'posted_at' => now(),
        ]);

        Job::create([
            'title' => 'Project Manager',
            'description' => 'Lead project teams to deliver high-quality results.',
            'company' => 'Project Pros',
            'location' => 'Seattle, WA',
            'type' => 'job',
            'posted_at' => now(),
        ]);

        Job::create([
            'title' => 'Content Writer Intern',
            'description' => 'Write articles and blogs for our website.',
            'company' => 'WriteOn',
            'location' => 'Remote',
            'type' => 'internship',
            'posted_at' => now(),
        ]);

        Job::create([
            'title' => 'System Administrator',
            'description' => 'Manage and maintain our IT infrastructure.',
            'company' => 'TechHub',
            'location' => 'Austin, TX',
            'type' => 'job',
            'posted_at' => now(),
        ]);

        Job::create([
            'title' => 'SEO Intern',
            'description' => 'Assist with SEO strategies and content optimization.',
            'company' => 'SearchSuccess',
            'location' => 'Miami, FL',
            'type' => 'internship',
            'posted_at' => now(),
        ]);

        Job::create([
            'title' => 'Full Stack Developer',
            'description' => 'Develop both frontend and backend systems for our applications.',
            'company' => 'Innovative Tech',
            'location' => 'San Francisco, CA',
            'type' => 'job',
            'posted_at' => now(),
        ]);
    }
}
