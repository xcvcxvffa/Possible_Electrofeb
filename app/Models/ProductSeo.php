<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSeo extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'meta_title', 'meta_description', 'meta_keywords', 'canonical_url', 'og_image_media_id', 'schema_json'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
