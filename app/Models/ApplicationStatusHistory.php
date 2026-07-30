<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ApplicationStatusHistory extends Model {
    protected $table = 'application_status_history';
    public $timestamps = false;
    protected $fillable = ['application_id', 'from_status', 'to_status', 'note', 'changed_by', 'changed_at'];
    protected $casts = ['changed_at' => 'datetime'];
    public function application() { return $this->belongsTo(JobApplication::class, 'application_id'); }
    public function changedBy()   { return $this->belongsTo(User::class, 'changed_by'); }
}
