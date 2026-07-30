<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class JobApplication extends Model
{
    use HasUuids;

    // ── Status Constants ─────────────────────────────────────────────────────
    const STATUS_APPLIED             = 'applied';
    const STATUS_UNDER_REVIEW        = 'under_review';
    const STATUS_SHORTLISTED         = 'shortlisted';
    const STATUS_INTERVIEW_SCHEDULED = 'interview_scheduled';
    const STATUS_SELECTED            = 'selected';
    const STATUS_REJECTED            = 'rejected';
    const STATUS_HOLD                = 'hold';
    const STATUS_WITHDRAWN           = 'withdrawn';

    const STATUSES = [
        self::STATUS_APPLIED             => 'Applied',
        self::STATUS_UNDER_REVIEW        => 'Under Review',
        self::STATUS_SHORTLISTED         => 'Shortlisted',
        self::STATUS_INTERVIEW_SCHEDULED => 'Interview Scheduled',
        self::STATUS_SELECTED            => 'Selected',
        self::STATUS_REJECTED            => 'Rejected',
        self::STATUS_HOLD                => 'Hold',
        self::STATUS_WITHDRAWN           => 'Withdrawn',
    ];

    const STATUS_COLORS = [
        self::STATUS_APPLIED             => '#3b82f6',
        self::STATUS_UNDER_REVIEW        => '#f59e0b',
        self::STATUS_SHORTLISTED         => '#8b5cf6',
        self::STATUS_INTERVIEW_SCHEDULED => '#0891b2',
        self::STATUS_SELECTED            => '#16a34a',
        self::STATUS_REJECTED            => '#ef4444',
        self::STATUS_HOLD                => '#9ca3af',
        self::STATUS_WITHDRAWN           => '#374151',
    ];

    protected $fillable = [
        'career_id', 'full_name', 'email', 'phone', 'country', 'city',
        'resume_media_id', 'cover_letter', 'linkedin_url', 'portfolio_url',
        'current_company', 'experience', 'current_salary', 'expected_salary',
        'notice_period', 'application_status', 'remarks', 'duplicate_flag', 'applied_at',
    ];

    protected $casts = [
        'applied_at'     => 'datetime',
        'duplicate_flag' => 'boolean',
    ];

    // ── Scopes ───────────────────────────────────────────────────────────────

    public function scopeByStatus($query, $status)
    {
        return $query->where('application_status', $status);
    }

    public function scopeNoDuplicates($query)
    {
        return $query->where('duplicate_flag', false);
    }

    // ── Relationships ────────────────────────────────────────────────────────

    public function career()
    {
        return $this->belongsTo(Career::class, 'career_id');
    }

    public function resumeMedia()
    {
        return $this->belongsTo(MediaFile::class, 'resume_media_id');
    }

    public function statusHistory()
    {
        return $this->hasMany(ApplicationStatusHistory::class, 'application_id')->latest('changed_at');
    }

    public function interviews()
    {
        return $this->hasMany(InterviewSchedule::class, 'application_id')->orderBy('scheduled_at');
    }

    public function hrNotes()
    {
        return $this->hasMany(HrNote::class, 'application_id')->latest();
    }

    // ── Accessors ────────────────────────────────────────────────────────────

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->application_status] ?? 'Unknown';
    }

    public function getStatusColorAttribute(): string
    {
        return self::STATUS_COLORS[$this->application_status] ?? '#9ca3af';
    }
}
