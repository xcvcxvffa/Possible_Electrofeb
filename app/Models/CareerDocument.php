<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CareerDocument extends Model {
    public $timestamps = false;
    protected $fillable = ['career_id', 'media_id', 'title', 'document_type', 'sort_order'];
    public function career() { return $this->belongsTo(Career::class, 'career_id'); }
    public function media()  { return $this->belongsTo(MediaFile::class, 'media_id'); }
}
