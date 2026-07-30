<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class JobType extends Model
{
    use HasUuids;

    protected $fillable = ['name', 'color', 'status'];

    protected $casts = ['status' => 'boolean'];

    public function scopeActive($query)
    {
        return $query->where('status', true)->orderBy('name');
    }

    public function careers()
    {
        return $this->hasMany(Career::class, 'job_type_id');
    }
}
