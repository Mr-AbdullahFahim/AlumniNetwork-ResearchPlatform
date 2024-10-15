<?php

namespace App\Http\Controllers;

use App\Models\ResearchArticle;
use App\Models\ArticleVersion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResearchArticleController extends Controller
{
    // Store a new research article
    public function store(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'author' => 'required',
        'file' => 'required|mimes:pdf|max:10000', // Max 10MB
    ]);

    // Ensure the directory exists
    if (!Storage::exists('public/research_articles')) {
        Storage::makeDirectory('public/research_articles');
    }

    // Handle file upload
    $file = $request->file('file');
    $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
    $filePath = $file->storeAs('public/research_articles', $fileName);

    // Check if the file was stored successfully
    if (Storage::exists($filePath)) {
        // Save article metadata to the database
        $article = ResearchArticle::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'author' => $request->input('author'),
        ]);

        // Create an initial version in the ArticleVersion table
        ArticleVersion::create([
            'article_id' => $article->id,
            'file_path' => $filePath,
            'version' => 1,
        ]);
        echo "inside the function";
    } 
}


    public function create()
    {
        return view('research.create'); // The form view for uploading articles
    }


    // Show all articles
    public function index()
    {
        // Eager load both latestVersion and all versions for each article
        $articles = ResearchArticle::with(['latestVersion', 'versions'])->get();
        return view('research.index', compact('articles'));
    }


    // Show the version history for an article
    public function versionHistory($id)
    {
        $article = ResearchArticle::findOrFail($id);
        $versions = $article->versions;
        return view('research.version_history', compact('article', 'versions'));
    }

    // Upload a new version of the article
    public function uploadNewVersion(Request $request, $articleId)
    {
        $request->validate(['file' => 'required|mimes:pdf|max:10000']);
        $article = ResearchArticle::findOrFail($articleId);
        $newVersion = $article->versions()->max('version') + 1;

        $file = $request->file('file');
        $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('public/research_articles', $fileName);

        ArticleVersion::create([
            'article_id' => $article->id,
            'file_path' => $filePath,
            'version' => $newVersion,
        ]);

        return redirect()->back()->with('success', 'New version uploaded successfully!');
    }
}
