<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    protected $fillable = [
        'company_name',
        'company_email',
        'company_phone',
        'company_address',
        'company_tagline',
        'google_map_url',
        'logo',
        'dark_logo',
        'footer_logo',
        'favicon',
        'apple_touch_icon',
        'company_profile_pdf',
        'admin_logo',
        'admin_mini_logo',
        'admin_login_logo',
        'admin_login_background',
        'admin_favicon',
        'years_of_experience',
        'completed_projects',
        'happy_clients',
        'products_delivered',
        'facebook_url',
        'instagram_url',
        'linkedin_url',
        'youtube_url',
        'twitter_url',
        'default_meta_title',
        'default_meta_description',
        'default_og_image',
        'office_address',
        'office_email',
        'office_phone',
        'working_hours',
    ];

    protected function casts(): array
    {
        return [
            'years_of_experience' => 'integer',
            'completed_projects' => 'integer',
            'happy_clients' => 'integer',
            'products_delivered' => 'integer',
        ];
    }
}
