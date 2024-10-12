<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleVersion extends Model
{
    use HasFactory;
    protected $fillable = ['article_id', 'file_path', 'version'];

    // Relation to the parent research article
    public function article()
    {
        return $this->belongsTo(ResearchArticle::class, 'article_id');
    }
}
