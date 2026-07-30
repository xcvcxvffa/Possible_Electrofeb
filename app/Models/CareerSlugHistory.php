<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CareerSlugHistory extends Model {
    protected $table = 'career_slug_history';
    protected $fillable = ['career_id', 'old_slug'];
    public function career() { return $this->belongsTo(Career::class, 'career_id'); }
}
