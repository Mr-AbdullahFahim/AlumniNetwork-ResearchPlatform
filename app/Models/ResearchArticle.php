<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchArticle extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'author'];

    // Relation to versions of the article
    public function versions()
    {
        return $this->hasMany(ArticleVersion::class, 'article_id');
    }

    // Get the latest version of the article
    public function latestVersion()
    {
        return $this->hasOne(ArticleVersion::class, 'article_id')->latestOfMany();
    }
}
