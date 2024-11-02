<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jobsandintern', function (Blueprint $table) {
            $table->id();  // Primary key, auto-incrementing
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Foreign key referencing users table
            $table->string('title');  // Job title
            $table->string('company');  // Company name
            $table->enum('location_type', ['Onsite', 'Remote', 'Hybrid']);  // Location type
            $table->string('location')->nullable();  // Location (nullable if Remote)
            $table->text('description');  // Job or internship description
            $table->enum('type', ['job', 'internship']);  // Type (job or internship)
            $table->timestamp('posted_at');  // When the job was posted
            $table->string('job_link')->nullable();  // Job link (nullable)
            $table->timestamps();  // Created at and updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobsandintern');
    }
};
