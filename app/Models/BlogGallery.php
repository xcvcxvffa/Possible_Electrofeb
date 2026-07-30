<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogGallery extends Model
{
    protected $table = 'blog_gallery';

    protected $fillable = [
        'blog_id',
        'media_id',
        'title',
        'alt_text',
        'caption',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }

    public function media()
    {
        return $this->belongsTo(MediaFile::class, 'media_id');
    }
}
