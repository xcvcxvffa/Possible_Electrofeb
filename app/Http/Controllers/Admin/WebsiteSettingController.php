<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

// Requests
use App\Http\Requests\UpdateCompanyInfoRequest;
use App\Http\Requests\UpdateWebsiteBrandingRequest;
use App\Http\Requests\UpdateAdminBrandingRequest;
use App\Http\Requests\UpdateStatisticsRequest;
use App\Http\Requests\UpdateSocialMediaRequest;
use App\Http\Requests\UpdateSeoRequest;
use App\Http\Requests\UpdateContactInfoRequest;

class WebsiteSettingController extends Controller
{
    public function index()
    {
        $setting = WebsiteSetting::first() ?? new WebsiteSetting();
        return view('admin.settings.website.index', compact('setting'));
    }

    private function getSetting()
    {
        return WebsiteSetting::first() ?? new WebsiteSetting();
    }

    private function handleFiles(Request $request, $setting, array $filesConfig)
    {
        $data = [];
        foreach ($filesConfig as $field => $path) {
            if ($request->hasFile($field)) {
                // Delete old file
                if ($setting->$field && Storage::disk('public')->exists($setting->$field)) {
                    Storage::disk('public')->delete($setting->$field);
                }
                // Store new file
                $data[$field] = $request->file($field)->store($path, 'public');
            }
        }
        return $data;
    }

    private function saveSettings($setting, array $data)
    {
        // Filter nulls (so we don't overwrite with nulls unless explicit)
        $data = array_filter($data, function($value) {
            return $value !== null;
        });
        
        $setting->fill($data);
        $setting->save();
        Cache::forget('website_settings');
    }

    public function updateCompanyInfo(UpdateCompanyInfoRequest $request)
    {
        $setting = $this->getSetting();
        $this->saveSettings($setting, $request->validated());
        return redirect()->back()->with('success', 'Company information updated successfully.');
    }

    public function updateBranding(UpdateWebsiteBrandingRequest $request)
    {
        $setting = $this->getSetting();
        $data = $request->validated();
        
        $fileData = $this->handleFiles($request, $setting, [
            'logo' => 'settings/logo',
            'dark_logo' => 'settings/dark-logo',
            'footer_logo' => 'settings/footer-logo',
            'favicon' => 'settings/favicon',
            'apple_touch_icon' => 'settings/apple-touch-icon',
            'company_profile_pdf' => 'settings/company-profile'
        ]);

        $this->saveSettings($setting, array_merge($data, $fileData));
        return redirect()->back()->with('success', 'Website branding updated successfully.');
    }


    public function updateStatistics(UpdateStatisticsRequest $request)
    {
        $setting = $this->getSetting();
        $this->saveSettings($setting, $request->validated());
        return redirect()->back()->with('success', 'Statistics updated successfully.');
    }

    public function updateSocialMedia(UpdateSocialMediaRequest $request)
    {
        $setting = $this->getSetting();
        $this->saveSettings($setting, $request->validated());
        return redirect()->back()->with('success', 'Social media links updated successfully.');
    }

    public function updateSeo(UpdateSeoRequest $request)
    {
        $setting = $this->getSetting();
        $data = $request->validated();
        
        $fileData = $this->handleFiles($request, $setting, [
            'default_og_image' => 'settings/og-image'
        ]);

        $this->saveSettings($setting, array_merge($data, $fileData));
        return redirect()->back()->with('success', 'SEO defaults updated successfully.');
    }

    public function updateContactInfo(UpdateContactInfoRequest $request)
    {
        $setting = $this->getSetting();
        $this->saveSettings($setting, $request->validated());
        return redirect()->back()->with('success', 'Contact information updated successfully.');
    }

    public function deleteFile(Request $request)
    {
        $request->validate([
            'field' => 'required|string'
        ]);

        $field = $request->input('field');
        $setting = WebsiteSetting::first();

        if (!$setting || !in_array($field, $setting->getFillable())) {
            return redirect()->back()->with('error', 'Invalid file field.');
        }

        if ($setting->$field) {
            if (Storage::disk('public')->exists($setting->$field)) {
                Storage::disk('public')->delete($setting->$field);
            }
            $setting->$field = null;
            $setting->save();
            Cache::forget('website_settings');
        }

        return redirect()->back()->with('success', 'File deleted successfully.');
    }
}
