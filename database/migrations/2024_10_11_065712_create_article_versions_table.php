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
        Schema::create('article_versions', function (Blueprint $table) {
            $table->id(); // This is also an unsigned big integer by default
            $table->unsignedBigInteger('article_id'); // This should match the type of `id` in research_articles
            $table->string('file_path'); // Store path to the article PDF
            $table->integer('version'); // Version number
            $table->timestamps(); // This includes created_at and updated_at

            // Foreign key constraint
            $table->foreign('article_id')
                ->references('id')
                ->on('research_articles')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_versions');
    }
};
