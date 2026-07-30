<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CareerFaq extends Model {
    public $timestamps = false;
    protected $fillable = ['career_id', 'question', 'answer', 'sort_order', 'status'];
    protected $casts = ['status' => 'boolean'];
    public function career() { return $this->belongsTo(Career::class, 'career_id'); }
}
