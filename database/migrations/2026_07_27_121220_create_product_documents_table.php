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
        Schema::create('product_documents', function (Blueprint $table) {
            $table->id();
            $table->uuid('product_id');
            $table->foreignId('media_id')->constrained('media_files')->onDelete('cascade');
            $table->enum('document_type', ['Brochure', 'Catalogue', 'Datasheet', 'Manual', 'Certificate', 'Warranty', 'Drawing', 'Test Report']);
            $table->string('title')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_documents');
    }
};
