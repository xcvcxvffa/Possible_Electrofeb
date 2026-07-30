<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'category_id',
        'author_id',
        'title',
        'slug',
        'excerpt',
        'short_description',
        'content',
        'featured_image_media_id',
        'banner_image_media_id',
        'reading_time',
        'status',
        'featured',
        'trending',
        'allow_comments',
        'published_at',
        'sort_order',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'status' => 'boolean',
        'featured' => 'boolean',
        'trending' => 'boolean',
        'allow_comments' => 'boolean',
        'reading_time' => 'integer',
        'sort_order' => 'integer',
        'published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function featuredMedia()
    {
        return $this->belongsTo(MediaFile::class, 'featured_image_media_id');
    }

    public function bannerMedia()
    {
        return $this->belongsTo(MediaFile::class, 'banner_image_media_id');
    }


    public function gallery()
    {
        return $this->hasMany(BlogGallery::class, 'blog_id')->orderBy('sort_order', 'asc');
    }

    public function documents()
    {
        return $this->hasMany(BlogDocument::class, 'blog_id')->orderBy('sort_order', 'asc');
    }

    public function relatedBlogs()
    {
        return $this->belongsToMany(Blog::class, 'blog_related', 'blog_id', 'related_blog_id');
    }

    public function seo()
    {
        return $this->hasOne(BlogSeo::class, 'blog_id');
    }

    public function faqs()
    {
        return $this->hasMany(BlogFaq::class, 'blog_id')->orderBy('sort_order', 'asc');
    }

    public function slugHistory()
    {
        return $this->hasMany(BlogSlugHistory::class, 'blog_id')->latest();
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class, 'blog_id')->latest();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
