<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\MediaFolder;

class MediaFile extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'uuid', 'file_name', 'original_name', 'file_type', 'mime_type', 'extension',
        'file_size', 'file_path', 'thumbnail_path', 'folder_id', 'alt_text',
        'title', 'description', 'width', 'height', 'uploaded_by', 'is_public', 'status'
    ];

    protected $appends = ['url', 'thumbnail_url'];

    protected $casts = [
        'is_public' => 'boolean',
        'status'    => 'boolean',
        'file_size' => 'integer',
        'width'     => 'integer',
        'height'    => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
            if (empty($model->uploaded_by) && auth()->check()) {
                $model->uploaded_by = auth()->id();
            }
        });
    }

    public function folder()
    {
        return $this->belongsTo(MediaFolder::class, 'folder_id');
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
    
    public function getUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }
    
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail_path) {
            return asset('storage/' . $this->thumbnail_path);
        }
        return $this->url;
    }
}
