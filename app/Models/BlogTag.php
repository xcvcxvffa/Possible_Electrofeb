<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'blog_tag_items', 'tag_id', 'blog_id');
    }
}
