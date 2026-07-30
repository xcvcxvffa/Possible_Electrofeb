<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogSlugHistory extends Model
{
    protected $table = 'blog_slug_history';

    protected $fillable = [
        'blog_id',
        'old_slug',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }
}
