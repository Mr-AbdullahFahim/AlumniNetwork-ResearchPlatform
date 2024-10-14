<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResearchArticleController;
use App\Http\Controllers\AdminDashboardController;

Route::get('/', [JobController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/jobs',[JobController::class,'index'])->name('jobs.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

 // Admin Dashboard route with role middleware
 Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
 ->name('admin.dashboard')
 ->middleware('role:admin');

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


Route::prefix('admin')->group(function () {
    Route::get('/home', [AdminController::class, 'index'])->name('admin.home');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/approvals', [AdminController::class, 'approvals'])->name('admin.approvals');
    Route::get('/reports', [AdminController::class, 'reports'])->name('admin.reports');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::post('/approve/{id}', [AdminController::class, 'approve'])->name('admin.approve');
    Route::post('/deny/{id}', [AdminController::class, 'deny'])->name('admin.deny');
    Route::get('/notifications', [AdminController::class, 'notifications'])->name('admin.notifications');
});


require __DIR__.'/auth.php';
