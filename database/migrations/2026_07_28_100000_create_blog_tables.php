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
        // 1. blog_categories
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('parent_id')->nullable();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->foreignId('image_media_id')->nullable()->constrained('media_files')->onDelete('set null');
            $table->boolean('status')->default(true);
            $table->integer('sort_order')->default(0);
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('deleted_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('parent_id')->references('id')->on('blog_categories')->onDelete('set null');
        });

        // 2. blogs
        Schema::create('blogs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('category_id')->nullable();
            $table->foreignId('author_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('content')->nullable();
            $table->foreignId('featured_image_media_id')->nullable()->constrained('media_files')->onDelete('set null');
            $table->foreignId('banner_image_media_id')->nullable()->constrained('media_files')->onDelete('set null');
            $table->integer('reading_time')->default(3);
            $table->boolean('status')->default(true);
            $table->boolean('featured')->default(false);
            $table->boolean('trending')->default(false);
            $table->boolean('allow_comments')->default(true);
            $table->timestamp('published_at')->nullable();
            $table->integer('sort_order')->default(0);
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('deleted_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('blog_categories')->onDelete('set null');
        });

        // 3. blog_tags
        Schema::create('blog_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        // 4. blog_tag_items
        Schema::create('blog_tag_items', function (Blueprint $table) {
            $table->id();
            $table->uuid('blog_id');
            $table->foreignId('tag_id')->constrained('blog_tags')->onDelete('cascade');
            $table->timestamps();

            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
        });

        // 5. blog_gallery
        Schema::create('blog_gallery', function (Blueprint $table) {
            $table->id();
            $table->uuid('blog_id');
            $table->foreignId('media_id')->constrained('media_files')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('alt_text')->nullable();
            $table->text('caption')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
        });

        // 6. blog_documents
        Schema::create('blog_documents', function (Blueprint $table) {
            $table->id();
            $table->uuid('blog_id');
            $table->foreignId('media_id')->constrained('media_files')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('document_type')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
        });

        // 7. blog_related
        Schema::create('blog_related', function (Blueprint $table) {
            $table->id();
            $table->uuid('blog_id');
            $table->uuid('related_blog_id');
            $table->timestamps();

            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
            $table->foreign('related_blog_id')->references('id')->on('blogs')->onDelete('cascade');
        });

        // 8. blog_seo
        Schema::create('blog_seo', function (Blueprint $table) {
            $table->id();
            $table->uuid('blog_id');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('canonical_url')->nullable();
            $table->foreignId('og_image_media_id')->nullable()->constrained('media_files')->onDelete('set null');
            $table->json('schema_json')->nullable();
            $table->timestamps();

            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
        });

        // 9. blog_faqs
        Schema::create('blog_faqs', function (Blueprint $table) {
            $table->id();
            $table->uuid('blog_id');
            $table->string('question');
            $table->text('answer');
            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
        });

        // 10. blog_slug_history
        Schema::create('blog_slug_history', function (Blueprint $table) {
            $table->id();
            $table->uuid('blog_id');
            $table->string('old_slug');
            $table->timestamps();

            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
        });

        // 11. blog_comments (Database ready for future comments)
        Schema::create('blog_comments', function (Blueprint $table) {
            $table->id();
            $table->uuid('blog_id');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('name');
            $table->string('email');
            $table->text('comment');
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_comments');
        Schema::dropIfExists('blog_slug_history');
        Schema::dropIfExists('blog_faqs');
        Schema::dropIfExists('blog_seo');
        Schema::dropIfExists('blog_related');
        Schema::dropIfExists('blog_documents');
        Schema::dropIfExists('blog_gallery');
        Schema::dropIfExists('blog_tag_items');
        Schema::dropIfExists('blog_tags');
        Schema::dropIfExists('blogs');
        Schema::dropIfExists('blog_categories');
    }
};
