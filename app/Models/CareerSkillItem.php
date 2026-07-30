<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CareerSkillItem extends Model {
    public $timestamps = false;
    protected $fillable = ['career_id', 'skill_id', 'proficiency', 'sort_order'];
    public function career() { return $this->belongsTo(Career::class, 'career_id'); }
    public function skill()  { return $this->belongsTo(Skill::class, 'skill_id'); }
}
