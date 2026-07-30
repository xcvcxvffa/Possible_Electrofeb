<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDocument extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'media_id', 'document_type', 'title', 'sort_order'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
