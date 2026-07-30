<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogSeo extends Model
{
    protected $table = 'blog_seo';

    protected $fillable = [
        'blog_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'og_image_media_id',
        'schema_json',
    ];

    protected $casts = [
        'schema_json' => 'array',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }

    public function ogImageMedia()
    {
        return $this->belongsTo(MediaFile::class, 'og_image_media_id');
    }
}
