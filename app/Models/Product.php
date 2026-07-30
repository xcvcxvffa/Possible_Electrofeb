<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'banner_image',
        'card_image',
        'sort_order',
        'status',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    // Relationships
    public function bannerMedia()
    {
        return $this->belongsTo(MediaFile::class, 'banner_image');
    }

    public function cardMedia()
    {
        return $this->belongsTo(MediaFile::class, 'card_image');
    }

    public function features()
    {
        return $this->hasMany(ProductFeature::class)->orderBy('sort_order');
    }

    public function applications()
    {
        return $this->hasMany(ProductApplication::class)->orderBy('sort_order');
    }

    public function specifications()
    {
        return $this->hasMany(ProductSpecification::class)->orderBy('sort_order');
    }
}
