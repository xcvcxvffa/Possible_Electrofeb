<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductApplication extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'application_text',
        'sort_order',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
