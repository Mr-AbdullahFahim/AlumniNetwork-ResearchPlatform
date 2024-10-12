<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ResearchArticle;

class ResearchArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Understanding AI and Machine Learning',
                'description' => 'An in-depth exploration of artificial intelligence and machine learning concepts.',
                'author' => 'John Doe',
            ],
            [
                'title' => 'The Future of Quantum Computing',
                'description' => 'An overview of how quantum computing could revolutionize technology.',
                'author' => 'Alice Smith',
            ],
            [
                'title' => 'Cybersecurity Trends in 2024',
                'description' => 'A look at the latest trends in cybersecurity and how they impact organizations.',
                'author' => 'Michael Brown',
            ],
            [
                'title' => 'Big Data Analytics in Modern Businesses',
                'description' => 'How businesses can leverage big data analytics for decision making.',
                'author' => 'David Williams',
            ],
            [
                'title' => 'Blockchain: Beyond Cryptocurrency',
                'description' => 'Exploring the uses of blockchain technology beyond Bitcoin and other cryptocurrencies.',
                'author' => 'Jane Doe',
            ],
        ];

        foreach ($articles as $article) {
            ResearchArticle::create($article);
        }
    }
}
