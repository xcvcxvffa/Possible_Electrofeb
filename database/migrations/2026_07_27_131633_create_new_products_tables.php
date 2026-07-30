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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('banner_image')->nullable();
            $table->unsignedBigInteger('card_image')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
            
            $table->foreign('banner_image', 'fk_new_prod_banner')->references('id')->on('media_files')->nullOnDelete();
            $table->foreign('card_image', 'fk_new_prod_card')->references('id')->on('media_files')->nullOnDelete();
        });

        Schema::create('product_features', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('feature_text');
            $table->integer('sort_order')->default(0);
            $table->foreign('product_id', 'fk_new_prod_feat')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('product_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('application_text');
            $table->integer('sort_order')->default(0);
            $table->foreign('product_id', 'fk_new_prod_app')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('product_specifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('spec_label');
            $table->string('spec_value')->nullable();
            $table->integer('sort_order')->default(0);
            $table->foreign('product_id', 'fk_new_prod_spec')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_specifications');
        Schema::dropIfExists('product_applications');
        Schema::dropIfExists('product_features');
        Schema::dropIfExists('products');
    }
};
