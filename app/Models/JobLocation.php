<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class JobLocation extends Model
{
    use HasUuids;

    protected $fillable = ['country', 'state', 'city', 'office_name', 'address', 'status'];

    protected $casts = ['status' => 'boolean'];

    public function scopeActive($query)
    {
        return $query->where('status', true)->orderBy('city');
    }

    public function getFullAddressAttribute(): string
    {
        $parts = array_filter([$this->city, $this->state, $this->country]);
        return implode(', ', $parts);
    }

    public function getDisplayNameAttribute(): string
    {
        $name = $this->office_name ? $this->office_name . ' — ' : '';
        return $name . $this->full_address;
    }

    public function careers()
    {
        return $this->hasMany(Career::class, 'job_location_id');
    }
}
