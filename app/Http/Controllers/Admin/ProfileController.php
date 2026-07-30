<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use App\Models\WebsiteSetting;
use App\Http\Requests\UpdateAdminBrandingRequest;
class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|max:255|unique:users,email,' . Auth::id(),
            'current_password' => 'required_with:password|nullable|current_password',
            'password' => 'nullable|min:8|confirmed',
            'avatar' => 'nullable|file|extensions:jpeg,png,jpg,gif,webp,svg|max:2048'
        ], [
            'avatar.extensions' => 'Please upload a valid image file (jpeg, png, jpg, gif, webp, svg).'
        ]);

        $user = Auth::user();
        if ($request->filled('name')) {
            $user->name = $request->name;
        }
        if ($request->filled('email')) {
            $user->email = $request->email;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $user->avatar = $request->file('avatar')->store('users/avatars', 'public');
        }

        $user->save();

        return back()->with('status', 'Profile updated successfully.');
    }

    public function updateAdminBranding(UpdateAdminBrandingRequest $request)
    {
        $setting = WebsiteSetting::first() ?? new WebsiteSetting();
        $data = $request->validated();
        
        $fileData = $this->handleFiles($request, $setting, [
            'admin_logo' => 'settings/admin-logo',
            'admin_mini_logo' => 'settings/admin-mini-logo',
            'admin_login_logo' => 'settings/admin-login-logo',
            'admin_login_background' => 'settings/admin-login-background',
            'admin_favicon' => 'settings/admin-favicon'
        ]);

        $this->saveSettings($setting, array_merge($data, $fileData));
        return redirect()->back()->with('success', 'Admin branding updated successfully.');
    }

    public function deleteAdminFile(Request $request)
    {
        $request->validate([
            'field' => 'required|string|in:admin_logo,admin_mini_logo,admin_login_logo,admin_login_background,admin_favicon'
        ]);

        $field = $request->field;
        $setting = WebsiteSetting::first();

        if ($setting && $setting->$field) {
            if (Storage::disk('public')->exists($setting->$field)) {
                Storage::disk('public')->delete($setting->$field);
            }
            $setting->$field = null;
            $setting->save();
            Cache::forget('website_settings');
            return redirect()->back()->with('success', 'File deleted successfully.');
        }

        return redirect()->back()->with('error', 'File not found.');
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
}
