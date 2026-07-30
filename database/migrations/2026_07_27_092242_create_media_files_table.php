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
        Schema::create('media_files', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('file_name');
            $table->string('original_name');
            $table->string('file_type'); // image, document, video, etc
            $table->string('mime_type');
            $table->string('extension');
            $table->unsignedBigInteger('file_size');
            $table->string('file_path');
            $table->string('thumbnail_path')->nullable();
            
            $table->foreignId('folder_id')->nullable()->constrained('media_folders')->nullOnDelete();
            
            $table->string('alt_text')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            
            // Image specifics
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            
            $table->boolean('is_public')->default(true);
            $table->boolean('status')->default(true);
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_files');
    }
};
