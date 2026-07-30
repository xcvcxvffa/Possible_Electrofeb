<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ForgotPasswordController;
use App\Http\Controllers\Admin\ResetPasswordController;
use App\Http\Controllers\Admin\ProfileController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/', '/admin/dashboard');
    
    // Guest Routes (Only accessible when NOT logged in)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');

        Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

        Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
    });

    // Protected Routes (Only accessible when logged in)
    Route::middleware(['auth', \App\Http\Middleware\PreventBackHistory::class])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Lock Screen Routes
        Route::post('/lock', [AuthController::class, 'lock'])->name('lock');
        Route::get('/lock-screen', [AuthController::class, 'lockScreen'])->name('lock.screen');
        Route::post('/unlock', [AuthController::class, 'unlock'])->name('lock.unlock');
        
        // Routes that require user to be unlocked
        Route::middleware([\App\Http\Middleware\CheckLockScreen::class])->group(function () {
        // Dashboard & Profile
    // Dashboard
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
        Route::post('/profile/admin-branding', [App\Http\Controllers\Admin\ProfileController::class, 'updateAdminBranding'])->name('profile.admin_branding');
        Route::post('/profile/delete-file', [App\Http\Controllers\Admin\ProfileController::class, 'deleteAdminFile'])->name('profile.delete_file');

        // System Routes
        Route::get('/system/clear-cache', [\App\Http\Controllers\Admin\SystemController::class, 'clearCache'])->name('system.clear-cache');
        Route::get('/system/search', [\App\Http\Controllers\Admin\SystemController::class, 'globalSearch'])->name('system.search');

        // Website Settings
        Route::get('/settings/website', [App\Http\Controllers\Admin\WebsiteSettingController::class, 'index'])->name('settings.website');
        Route::post('/settings/website/company-info', [App\Http\Controllers\Admin\WebsiteSettingController::class, 'updateCompanyInfo'])->name('settings.website.company_info');
        Route::post('/settings/website/branding', [App\Http\Controllers\Admin\WebsiteSettingController::class, 'updateBranding'])->name('settings.website.branding');
        Route::post('/settings/website/statistics', [App\Http\Controllers\Admin\WebsiteSettingController::class, 'updateStatistics'])->name('settings.website.statistics');
        Route::post('/settings/website/social-media', [App\Http\Controllers\Admin\WebsiteSettingController::class, 'updateSocialMedia'])->name('settings.website.social_media');
        Route::post('/settings/website/seo', [App\Http\Controllers\Admin\WebsiteSettingController::class, 'updateSeo'])->name('settings.website.seo');
        Route::post('/settings/website/contact-info', [App\Http\Controllers\Admin\WebsiteSettingController::class, 'updateContactInfo'])->name('settings.website.contact_info');
        Route::post('/settings/website/delete-file', [App\Http\Controllers\Admin\WebsiteSettingController::class, 'deleteFile'])->name('settings.website.delete_file');
        // Media Library
        Route::get('/media', [App\Http\Controllers\Admin\MediaController::class, 'index'])->name('media.index');
        Route::post('/media/upload', [App\Http\Controllers\Admin\MediaController::class, 'store'])->name('media.store');
        Route::put('/media/{mediaFile}', [App\Http\Controllers\Admin\MediaController::class, 'update'])->name('media.update');
        Route::post('/media/{mediaFile}/move', [App\Http\Controllers\Admin\MediaController::class, 'move'])->name('media.move');
        Route::delete('/media/{mediaFile}', [App\Http\Controllers\Admin\MediaController::class, 'destroy'])->name('media.destroy');
        Route::post('/media/bulk-delete', [App\Http\Controllers\Admin\MediaController::class, 'bulkDestroy'])->name('media.bulk_destroy');
        Route::post('/media/bulk-move', [App\Http\Controllers\Admin\MediaController::class, 'bulkMove'])->name('media.bulk_move');
        
        // Folders
        Route::post('/folders', [App\Http\Controllers\Admin\FolderController::class, 'store'])->name('folders.store');
        Route::put('/folders/{mediaFolder}', [App\Http\Controllers\Admin\FolderController::class, 'update'])->name('folders.update');
        Route::delete('/folders/{mediaFolder}', [App\Http\Controllers\Admin\FolderController::class, 'destroy'])->name('folders.destroy');
        
        // Products Module
        Route::resource('product-categories', App\Http\Controllers\Admin\ProductCategoryController::class);
        Route::resource('products', App\Http\Controllers\Admin\ProductController::class);

        // Blog Module
        Route::resource('blog-categories', App\Http\Controllers\Admin\BlogCategoryController::class);
        Route::get('blogs/trash', [App\Http\Controllers\Admin\BlogController::class, 'trash'])->name('blogs.trash');
        Route::post('blogs/{id}/restore', [App\Http\Controllers\Admin\BlogController::class, 'restore'])->name('blogs.restore');
        Route::delete('blogs/{id}/force-delete', [App\Http\Controllers\Admin\BlogController::class, 'forceDelete'])->name('blogs.force_delete');
        Route::post('blogs/bulk-action', [App\Http\Controllers\Admin\BlogController::class, 'bulkAction'])->name('blogs.bulk_action');
        Route::resource('blogs', App\Http\Controllers\Admin\BlogController::class);

        // Career Module
        Route::resource('career-categories', App\Http\Controllers\Admin\CareerCategoryController::class);
        Route::resource('departments', App\Http\Controllers\Admin\DepartmentController::class);
        Route::resource('job-locations', App\Http\Controllers\Admin\JobLocationController::class);
        Route::resource('job-types', App\Http\Controllers\Admin\JobTypeController::class);
        
        Route::get('careers/trash', [App\Http\Controllers\Admin\CareerController::class, 'trash'])->name('careers.trash');
        Route::post('careers/{id}/restore', [App\Http\Controllers\Admin\CareerController::class, 'restore'])->name('careers.restore');
        Route::delete('careers/{id}/force-delete', [App\Http\Controllers\Admin\CareerController::class, 'forceDelete'])->name('careers.force_delete');
        Route::post('careers/bulk-action', [App\Http\Controllers\Admin\CareerController::class, 'bulkAction'])->name('careers.bulk_action');
        Route::resource('careers', App\Http\Controllers\Admin\CareerController::class);
        
        Route::get('job-applications', [App\Http\Controllers\Admin\JobApplicationController::class, 'index'])->name('job-applications.index');
        Route::get('job-applications/{id}', [App\Http\Controllers\Admin\JobApplicationController::class, 'show'])->name('job-applications.show');
        Route::put('job-applications/{id}/status', [App\Http\Controllers\Admin\JobApplicationController::class, 'updateStatus'])->name('job-applications.update_status');
        Route::post('job-applications/{id}/note', [App\Http\Controllers\Admin\JobApplicationController::class, 'addNote'])->name('job-applications.add_note');
        Route::delete('job-applications/{id}', [App\Http\Controllers\Admin\JobApplicationController::class, 'destroy'])->name('job-applications.destroy');

        // Contact Inquiries
        Route::put('contact-inquiries/{id}/status', [App\Http\Controllers\Admin\ContactInquiryController::class, 'updateStatus'])->name('contact-inquiries.update_status');
        Route::post('contact-inquiries/{id}/restore', [App\Http\Controllers\Admin\ContactInquiryController::class, 'restore'])->name('contact-inquiries.restore');
        Route::resource('contact-inquiries', App\Http\Controllers\Admin\ContactInquiryController::class)->except(['create', 'store', 'edit', 'update']);
        }); // End of CheckLockScreen middleware
    });

    // Error Route
    Route::get('/404', function () {
        return view('admin.errors.404');
    })->name('error');
});
