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
        Schema::create('user_follows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('follower_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('followee_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_image')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_alumni')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_follows');
    }
};
