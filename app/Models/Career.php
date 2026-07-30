<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Career extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'career_category_id', 'department_id', 'job_location_id', 'job_type_id',
        'title', 'slug', 'job_code', 'short_description', 'description',
        'salary_type', 'salary_min', 'salary_max', 'currency',
        'experience', 'education', 'vacancies', 'application_deadline',
        'featured', 'urgent', 'status', 'published_at',
        'banner_media_id', 'brochure_media_id',
        'views_count', 'created_by', 'updated_by', 'deleted_by',
    ];

    protected $casts = [
        'status'               => 'boolean',
        'featured'             => 'boolean',
        'urgent'               => 'boolean',
        'salary_min'           => 'float',
        'salary_max'           => 'float',
        'vacancies'            => 'integer',
        'views_count'          => 'integer',
        'published_at'         => 'datetime',
        'application_deadline' => 'date',
    ];

    // ── Status Constants ─────────────────────────────────────────────────────

    const STATUS_ACTIVE  = true;
    const STATUS_DRAFT   = false;

    // ── Scopes ──────────────────────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeNotExpired($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('application_deadline')
              ->orWhere('application_deadline', '>=', now()->toDateString());
        });
    }

    public function scopeExpired($query)
    {
        return $query->whereNotNull('application_deadline')
                     ->where('application_deadline', '<', now()->toDateString());
    }

    public function scopeUrgent($query)
    {
        return $query->where('urgent', true);
    }

    // ── Relationships ────────────────────────────────────────────────────────

    public function category()
    {
        return $this->belongsTo(CareerCategory::class, 'career_category_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function location()
    {
        return $this->belongsTo(JobLocation::class, 'job_location_id');
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class, 'job_type_id');
    }

    public function bannerMedia()
    {
        return $this->belongsTo(MediaFile::class, 'banner_media_id');
    }

    public function brochureMedia()
    {
        return $this->belongsTo(MediaFile::class, 'brochure_media_id');
    }

    public function responsibilities()
    {
        return $this->hasMany(CareerResponsibility::class, 'career_id')->orderBy('sort_order');
    }

    public function requirements()
    {
        return $this->hasMany(CareerRequirement::class, 'career_id')->orderBy('sort_order');
    }

    public function benefits()
    {
        return $this->hasMany(CareerBenefit::class, 'career_id')->orderBy('sort_order');
    }

    public function skillItems()
    {
        return $this->hasMany(CareerSkillItem::class, 'career_id')->orderBy('sort_order')->with('skill');
    }

    public function faqs()
    {
        return $this->hasMany(CareerFaq::class, 'career_id')->orderBy('sort_order');
    }

    public function documents()
    {
        return $this->hasMany(CareerDocument::class, 'career_id')->orderBy('sort_order');
    }

    public function relatedCareers()
    {
        return $this->belongsToMany(
            Career::class, 'career_related', 'career_id', 'related_career_id'
        );
    }

    public function seo()
    {
        return $this->hasOne(CareerSeo::class, 'career_id');
    }

    public function slugHistory()
    {
        return $this->hasMany(CareerSlugHistory::class, 'career_id')->latest();
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'career_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // ── Accessors ────────────────────────────────────────────────────────────

    public function isExpired(): bool
    {
        return $this->application_deadline && $this->application_deadline->isPast();
    }

    public function getSalaryRangeAttribute(): string
    {
        if ($this->salary_type === 'not_disclosed') return 'Not Disclosed';
        if ($this->salary_type === 'negotiable')   return 'Negotiable';
        if ($this->salary_type === 'fixed')        return $this->currency . ' ' . number_format($this->salary_min);
        if ($this->salary_type === 'range' && $this->salary_min && $this->salary_max) {
            return $this->currency . ' ' . number_format($this->salary_min) . ' – ' . number_format($this->salary_max);
        }
        return 'Not Disclosed';
    }

    // ── Methods ──────────────────────────────────────────────────────────────

    public function incrementViews(): void
    {
        $this->increment('views_count');
    }
}
