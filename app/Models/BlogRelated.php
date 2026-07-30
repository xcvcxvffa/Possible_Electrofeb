<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogRelated extends Model
{
    protected $table = 'blog_related';

    protected $fillable = [
        'blog_id',
        'related_blog_id',
    ];
}
