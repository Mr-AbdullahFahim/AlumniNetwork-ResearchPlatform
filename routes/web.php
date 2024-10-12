<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResearchArticleController;

Route::get('/', [JobController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/jobs',[JobController::class,'index'])->name('jobs.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route to list all research articles
Route::get('/research-articles', [ResearchArticleController::class, 'index'])->name('research.index');

// Route to store a new article
Route::post('/research-article', [ResearchArticleController::class, 'store'])->name('research-article.store');

// Route to display the form for adding a research article
Route::get('/research-article/create', [ResearchArticleController::class, 'create'])->name('research-article.create');


// Route to view version history
Route::get('/research-articles/{id}/versions', [ResearchArticleController::class, 'versionHistory'])->name('research.version_history');

// Route to upload a new version
Route::post('/research-articles/{id}/new-version', [ResearchArticleController::class, 'uploadNewVersion'])->name('research-articles.upload-version');

require __DIR__.'/auth.php';
