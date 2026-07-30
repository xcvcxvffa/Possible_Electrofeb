<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['name', 'slug', 'description', 'status', 'sort_order'];

    protected $casts = [
        'status'     => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true)->orderBy('sort_order');
    }

    public function careers()
    {
        return $this->hasMany(Career::class, 'department_id');
    }
}
