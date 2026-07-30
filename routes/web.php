<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;

/*
|--------------------------------------------------------------------------
| Web Routes - Phase 1 Pure Frontend
|--------------------------------------------------------------------------
*/

// Home Demos
Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('/home-2', [PagesController::class, 'home2'])->name('home-2');
Route::get('/home-3', [PagesController::class, 'home3'])->name('home-3');
Route::get('/home-4', [PagesController::class, 'home4'])->name('home-4');
Route::get('/home-5', [PagesController::class, 'home5'])->name('home-5');
Route::get('/home-6', [PagesController::class, 'home6'])->name('home-6');
Route::get('/home-7', [PagesController::class, 'home7'])->name('home-7');
Route::get('/home-8', [PagesController::class, 'home8'])->name('home-8');
Route::get('/home-9', [PagesController::class, 'home9'])->name('home-9');
Route::get('/home-10', [PagesController::class, 'home10'])->name('home-10');

// About
Route::get('/about', [PagesController::class, 'about'])->name('about');

// Products
Route::get('/products', [PagesController::class, 'products'])->name('products');
Route::get('/product-2', [PagesController::class, 'product2'])->name('product-2');
Route::get('/product-3', [PagesController::class, 'product3'])->name('product-3');
Route::get('/product/{slug?}', [PagesController::class, 'productDetails'])->name('product.single');
Route::get('/product-details', [PagesController::class, 'productDetails']);

// Legacy Service Route Aliases (pointing to Product routes)
Route::get('/services', [PagesController::class, 'products'])->name('services');
Route::get('/service-2', [PagesController::class, 'product2'])->name('service-2');
Route::get('/service-3', [PagesController::class, 'product3'])->name('service-3');
Route::get('/service-details', [PagesController::class, 'productDetails'])->name('service.single');

// Projects / Portfolio
Route::get('/projects', [PagesController::class, 'projects'])->name('projects');
Route::get('/portfolio-2', [PagesController::class, 'portfolio2'])->name('portfolio-2');
Route::get('/portfolio-3', [PagesController::class, 'portfolio3'])->name('portfolio-3');
Route::get('/project-details', [PagesController::class, 'projectDetails'])->name('project.detail');

// Blog Demos & Enterprise Dynamic Routes
Route::get('/blogs', [PagesController::class, 'blogs'])->name('blogs');
Route::get('/blog-grid', [PagesController::class, 'blogGrid'])->name('blog.grid');
Route::get('/blog-list', [PagesController::class, 'blogList'])->name('blog.list');
Route::get('/blog-standard', [PagesController::class, 'blogStandard'])->name('blog.standard');
Route::get('/blog/{slug?}', [PagesController::class, 'blogSingle'])->name('blog.show');
Route::get('/blog-single', [PagesController::class, 'blogSingle'])->name('blog.single');

// Galleries & Misc
Route::get('/gallery-1', [PagesController::class, 'gallery1'])->name('gallery-1');
Route::get('/gallery-2', [PagesController::class, 'gallery2'])->name('gallery-2');
Route::get('/pricing', [PagesController::class, 'pricing'])->name('pricing');
Route::get('/faq', [PagesController::class, 'faq'])->name('faq');

// Team Demos
Route::get('/team', [PagesController::class, 'team'])->name('team');
Route::get('/team-details', [PagesController::class, 'teamDetails'])->name('team.details');

// Shop Demos
Route::get('/shop', [PagesController::class, 'shop'])->name('shop');
Route::get('/shop-details', [PagesController::class, 'shopDetails'])->name('shop.details');

// Contact, Careers & Utility
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::post('/contact/submit', [PagesController::class, 'submitContact'])->name('contact.submit');
Route::get('/careers', [PagesController::class, 'careers'])->name('careers');
Route::post('/careers/apply', [PagesController::class, 'applyCareer'])->name('careers.apply');

Route::get('/coming-soon', [PagesController::class, 'comingSoon'])->name('coming-soon');
Route::get('/404', [PagesController::class, 'errorPage'])->name('error-404');

// Serve Storage Files Bypass (Hostinger Git Deploy Fix)
Route::get('storage/{path}', function ($path) {
    $filePath = storage_path('app/public/' . $path);
    if (!file_exists($filePath)) {
        abort(404);
    }
    return response()->file($filePath);
})->where('path', '.*');

Route::fallback(function (\Illuminate\Http\Request $request) {
    if ($request->is('admin') || $request->is('admin/*')) {
        return response()->view('admin.errors.404', [], 404);
    }
    return response()->view('pages.404', [], 404);
});
