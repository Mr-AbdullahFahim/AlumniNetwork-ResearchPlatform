<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

Route::get('/', [JobController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/jobs',[JobController::class,'index'])->name('jobs.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
