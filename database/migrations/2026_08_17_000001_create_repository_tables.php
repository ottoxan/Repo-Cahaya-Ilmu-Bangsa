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
        Schema::create('repository_articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('journal_id');
            $table->text('title');
            $table->string('slug')->unique();
            $table->text('abstract');
            $table->json('authors');
            $table->text('keywords');
            $table->string('publisher')->default('Cahaya Ilmu Bangsa');
            $table->string('doi')->nullable();
            $table->string('volume')->nullable();
            $table->string('issue')->nullable();
            $table->string('pages')->nullable();
            $table->date('published_date')->nullable();
            $table->string('pdf_path')->nullable();
            $table->string('ojs_url')->nullable();
            $table->string('category')->default('Pendidikan');
            $table->string('status')->default('published');
            $table->timestamps();

            // Indexing for faster search/query
            $table->index('journal_id');
            $table->index('user_id');
        });

        Schema::create('repository_views', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id');
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index('article_id');
        });

        Schema::create('repository_download_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id');
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index('article_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repository_download_logs');
        Schema::dropIfExists('repository_views');
        Schema::dropIfExists('repository_articles');
    }
};
