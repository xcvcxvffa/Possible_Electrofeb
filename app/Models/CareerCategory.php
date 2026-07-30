<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CareerCategory extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'parent_id', 'name', 'slug', 'description',
        'icon_media_id', 'banner_media_id',
        'status', 'sort_order',
        'created_by', 'updated_by', 'deleted_by',
    ];

    protected $casts = [
        'status'     => 'boolean',
        'sort_order' => 'integer',
    ];

    // ── Scopes ──────────────────────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }

    // ── Relationships ────────────────────────────────────────────────────────

    public function parent()
    {
        return $this->belongsTo(CareerCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(CareerCategory::class, 'parent_id')->orderBy('sort_order');
    }

    public function careers()
    {
        return $this->hasMany(Career::class, 'career_category_id');
    }

    public function iconMedia()
    {
        return $this->belongsTo(MediaFile::class, 'icon_media_id');
    }

    public function bannerMedia()
    {
        return $this->belongsTo(MediaFile::class, 'banner_media_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
