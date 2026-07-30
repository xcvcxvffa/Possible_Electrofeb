<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CareerSeo extends Model {
    protected $table = 'career_seo';
    protected $fillable = [
        'career_id', 'meta_title', 'meta_description', 'meta_keywords',
        'canonical_url', 'og_image_media_id', 'schema_json',
    ];
    protected $casts = ['schema_json' => 'array'];
    public function career()     { return $this->belongsTo(Career::class, 'career_id'); }
    public function ogImageMedia(){ return $this->belongsTo(MediaFile::class, 'og_image_media_id'); }
}
