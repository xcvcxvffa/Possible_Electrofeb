<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['name', 'slug', 'category', 'status'];

    protected $casts = ['status' => 'boolean'];

    public function scopeActive($query)
    {
        return $query->where('status', true)->orderBy('name');
    }

    public function careerItems()
    {
        return $this->hasMany(CareerSkillItem::class, 'skill_id');
    }
}
