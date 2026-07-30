<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class InterviewSchedule extends Model {
    protected $table = 'interview_schedules';
    protected $fillable = [
        'application_id', 'interview_type', 'scheduled_at',
        'interviewer', 'location_or_link', 'notes', 'status', 'created_by',
    ];
    protected $casts = ['scheduled_at' => 'datetime'];
    public function application() { return $this->belongsTo(JobApplication::class, 'application_id'); }
    public function creator()     { return $this->belongsTo(User::class, 'created_by'); }
}
