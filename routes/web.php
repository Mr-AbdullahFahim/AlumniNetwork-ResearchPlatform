<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResearchArticleController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AlumniProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;

// Home route
Route::get('/', [JobController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

// Job listing route
Route::get('/jobs',[JobController::class,'index'])->name('jobs.index');
Route::post('/jobs/store', [JobController::class, 'store'])->name('jobs.store');

// Define the About page route
Route::get('/about', [PageController::class, 'about'])->name('about');

// Profile routes (authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Registration Routes
Route::get('register', [RegisteredUserController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store'])->name('register.store');


// Login Routes using AuthenticatedSessionController
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/{id}/follow', [UserController::class, 'follow'])->name('users.follow');
    Route::post('/users/{id}/unfollow', [UserController::class, 'unfollow'])->name('users.unfollow');
});

// Admin Dashboard Routes (Role-based access)
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware('role:admin')  // Ensure this middleware is correctly configured
    ->name('admin.dashboard');

// Route to redirect to admin dashboard
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});

// Research Articles Routes
Route::get('/research-articles', [ResearchArticleController::class, 'index'])->name('research.index');
Route::post('/research-article', [ResearchArticleController::class, 'store'])->name('research-article.store');
Route::get('/research-article/create', [ResearchArticleController::class, 'create'])->name('research-article.create');
Route::get('/research-articles/{id}/versions', [ResearchArticleController::class, 'versionHistory'])->name('research.version_history');
Route::post('/research-articles/{id}/version', [ResearchArticleController::class, 'uploadNewVersion'])->name('research-article.version.store'); // Updated route name



// Admin Routes under prefix
Route::prefix('admin')->group(function () {
    Route::get('/home', [AdminDashboardController::class, 'index'])->name('admin.home');
    Route::get('/approvals', [AdminDashboardController::class, 'approvals'])->name('admin.approvals');
    Route::get('/reports', [AdminDashboardController::class, 'reports'])->name('admin.reports');
    Route::get('/settings', [AdminDashboardController::class, 'settings'])->name('admin.settings');
    Route::get('/profile', [AdminDashboardController::class, 'profile'])->name('admin.profile');
    Route::post('/approve/{id}', [AdminDashboardController::class, 'approve'])->name('admin.approve');
    Route::post('/deny/{id}', [AdminDashboardController::class, 'deny'])->name('admin.deny');
    Route::get('/notifications', [AdminDashboardController::class, 'notifications'])->name('admin.notifications');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('admin.logout')->middleware('auth:admin');
    Route::get('/inbox', [AdminDashboardController::class, 'index'])->name('admin.inbox')->middleware('auth:admin');
});

// Admin Users Management Routes
Route::get('admin/users', [AdminDashboardController::class, 'indexUsers'])->name('admin.users');
Route::delete('admin/users/{id}', [AdminDashboardController::class, 'destroyUser'])->name('admin.users.destroy');
Route::post('admin/users/approve/{user}', [AdminDashboardController::class, 'approveUser'])->name('admin.users.approve');
Route::patch('admin/users/remove/{user}', [AdminDashboardController::class, 'removeUser'])->name('admin.users.remove');

// Waiting Room (pending approval)
Route::get('/waiting-room', function () {
    return view('auth.waiting');
})->name('waiting-room');


Route::get('/alumni/profile', [AlumniProfileController::class, 'show'])->name('alumni.profile');

// Include the default auth routes
require __DIR__.'/auth.php';
