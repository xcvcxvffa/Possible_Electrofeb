<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogTagItem extends Model
{
    protected $table = 'blog_tag_items';

    protected $fillable = [
        'blog_id',
        'tag_id',
    ];
}
