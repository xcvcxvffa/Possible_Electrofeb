<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('website_settings', function (Blueprint $table) {
            $table->string('company_tagline')->nullable()->after('company_address');
            $table->text('google_map_url')->nullable()->after('company_tagline');
            
            $table->string('footer_logo')->nullable()->after('dark_logo');
            $table->string('apple_touch_icon')->nullable()->after('favicon');
            
            $table->string('admin_logo')->nullable()->after('company_profile_pdf');
            $table->string('admin_mini_logo')->nullable()->after('admin_logo');
            $table->string('admin_login_logo')->nullable()->after('admin_mini_logo');
            $table->string('admin_login_background')->nullable()->after('admin_login_logo');
            $table->string('admin_favicon')->nullable()->after('admin_login_background');
            
            $table->string('facebook_url')->nullable()->after('products_delivered');
            $table->string('instagram_url')->nullable()->after('facebook_url');
            $table->string('linkedin_url')->nullable()->after('instagram_url');
            $table->string('youtube_url')->nullable()->after('linkedin_url');
            $table->string('twitter_url')->nullable()->after('youtube_url');
            
            $table->string('default_meta_title')->nullable()->after('twitter_url');
            $table->text('default_meta_description')->nullable()->after('default_meta_title');
            $table->string('default_og_image')->nullable()->after('default_meta_description');
            
            $table->text('office_address')->nullable()->after('default_og_image');
            $table->string('office_email')->nullable()->after('office_address');
            $table->string('office_phone')->nullable()->after('office_email');
            $table->string('working_hours')->nullable()->after('office_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('website_settings', function (Blueprint $table) {
            $table->dropColumn([
                'company_tagline', 'google_map_url',
                'footer_logo', 'apple_touch_icon',
                'admin_logo', 'admin_mini_logo', 'admin_login_logo', 'admin_login_background', 'admin_favicon',
                'facebook_url', 'instagram_url', 'linkedin_url', 'youtube_url', 'twitter_url',
                'default_meta_title', 'default_meta_description', 'default_og_image',
                'office_address', 'office_email', 'office_phone', 'working_hours'
            ]);
        });
    }
};
