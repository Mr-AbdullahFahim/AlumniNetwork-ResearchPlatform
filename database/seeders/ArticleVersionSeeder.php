<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ArticleVersion;

class ArticleVersionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $versions = [
            [
                'article_id' => 1,
                'file_path' => 'public/research_articles/ai-and-ml-v1.pdf',
                'version' => 1,
            ],
            [
                'article_id' => 1,
                'file_path' => 'public/research_articles/ai-and-ml-v2.pdf',
                'version' => 2,
            ],
            [
                'article_id' => 2,
                'file_path' => 'public/research_articles/quantum-computing-v1.pdf',
                'version' => 1,
            ],
            [
                'article_id' => 3,
                'file_path' => 'public/research_articles/cybersecurity-v1.pdf',
                'version' => 1,
            ],
            [
                'article_id' => 4,
                'file_path' => 'public/research_articles/big-data-v1.pdf',
                'version' => 1,
            ],
            [
                'article_id' => 5,
                'file_path' => 'public/research_articles/blockchain-v1.pdf',
                'version' => 1,
            ],
        ];

        foreach ($versions as $version) {
            ArticleVersion::create($version);
        }
    }
}
