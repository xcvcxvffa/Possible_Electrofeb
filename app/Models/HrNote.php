<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class HrNote extends Model {
    protected $table = 'hr_notes';
    protected $fillable = ['application_id', 'note', 'created_by'];
    public function application() { return $this->belongsTo(JobApplication::class, 'application_id'); }
    public function creator()     { return $this->belongsTo(User::class, 'created_by'); }
}
