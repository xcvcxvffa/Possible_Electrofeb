<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CareerRequirement extends Model {
    public $timestamps = false;
    protected $fillable = ['career_id', 'item', 'sort_order'];
    public function career() { return $this->belongsTo(Career::class, 'career_id'); }
}
