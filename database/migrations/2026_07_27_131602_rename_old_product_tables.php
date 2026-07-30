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
        $tablesToRename = [
            'products' => 'products_old',
            'product_features' => 'product_features_old',
            'product_highlights' => 'product_highlights_old',
            'product_applications' => 'product_applications_old',
            'product_specification_groups' => 'product_specification_groups_old',
            'product_specifications' => 'product_specifications_old',
            'product_documents' => 'product_documents_old',
            'product_gallery' => 'product_gallery_old',
            'product_related' => 'product_related_old',
            'product_seo' => 'product_seo_old',
            'product_faqs' => 'product_faqs_old',
            'product_slug_history' => 'product_slug_history_old',
        ];

        foreach ($tablesToRename as $old => $new) {
            if (Schema::hasTable($old) && !Schema::hasTable($new)) {
                Schema::rename($old, $new);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tablesToRename = [
            'products_old' => 'products',
            'product_features_old' => 'product_features',
            'product_highlights_old' => 'product_highlights',
            'product_applications_old' => 'product_applications',
            'product_specification_groups_old' => 'product_specification_groups',
            'product_specifications_old' => 'product_specifications',
            'product_documents_old' => 'product_documents',
            'product_gallery_old' => 'product_gallery',
            'product_related_old' => 'product_related',
            'product_seo_old' => 'product_seo',
            'product_faqs_old' => 'product_faqs',
            'product_slug_history_old' => 'product_slug_history',
        ];

        foreach ($tablesToRename as $old => $new) {
            if (Schema::hasTable($old) && !Schema::hasTable($new)) {
                Schema::rename($old, $new);
            }
        }
    }
};
