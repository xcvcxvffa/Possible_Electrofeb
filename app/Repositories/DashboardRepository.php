<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Career;
use App\Models\JobApplication;
use App\Models\ContactInquiry;
use App\Models\MediaFile;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class DashboardRepository
{
    protected $cacheTime = 600; // 10 minutes (600 seconds)

    /**
     * Get aggregate statistics for the dashboard cards.
     */
    public function getStats()
    {
        return Cache::remember('dashboard_stats', $this->cacheTime, function () {
            return [
                'total_products' => Product::count(),
                'published_products' => Product::where('status', 1)->count(),
                'product_categories' => ProductCategory::count(),
                
                'total_blogs' => Blog::count(),
                'published_blogs' => Blog::where('status', 1)->count(),
                'blog_categories' => BlogCategory::count(),
                
                'total_careers' => Career::count(),
                'open_jobs' => Career::where('status', 1)->count(),
                'closed_jobs' => Career::where('status', 0)->count(),
                'total_applications' => JobApplication::count(),
                
                'total_inquiries' => ContactInquiry::count(),
                'pending_inquiries' => ContactInquiry::where('status', 'pending')->orWhere('status', 'new')->count(),
                'closed_inquiries' => ContactInquiry::where('status', 'closed')->orWhere('status', 'resolved')->count(),
                
                'media_files' => MediaFile::count(),
                'storage_used' => MediaFile::sum('file_size') ?? 0,
                
                'total_admin_users' => User::count(),
            ];
        });
    }

    /**
     * Get monthly data for the last 12 months for charts.
     */
    public function getChartData()
    {
        return Cache::remember('dashboard_charts', $this->cacheTime, function () {
            $months = [];
            for ($i = 11; $i >= 0; $i--) {
                $months[] = now()->subMonths($i)->format('M Y');
            }

            return [
                'labels' => $months,
                'products' => $this->getMonthlyData(Product::class, 'created_at'),
                'blogs' => $this->getMonthlyData(Blog::class, 'published_at', 1),
                'applications' => $this->getMonthlyData(JobApplication::class, 'created_at'),
                'inquiries' => $this->getMonthlyData(ContactInquiry::class, 'created_at'),
            ];
        });
    }

    private function getMonthlyData($modelClass, $dateColumn, $status = null)
    {
        $data = [];
        for ($i = 11; $i >= 0; $i--) {
            $start = now()->subMonths($i)->startOfMonth();
            $end = now()->subMonths($i)->endOfMonth();
            
            $query = $modelClass::whereBetween($dateColumn, [$start, $end]);
            if ($status !== null) {
                $query->where('status', $status);
            }
            $data[] = $query->count();
        }
        return $data;
    }

    // Recent activity queries (Not cached to always show latest)
    
    public function getRecentInquiries($limit = 10)
    {
        return ContactInquiry::latest()->take($limit)->get();
    }

    public function getRecentJobApplications($limit = 10)
    {
        return JobApplication::with('career')->latest()->take($limit)->get();
    }

    public function getRecentBlogs($limit = 5)
    {
        return Blog::with(['category', 'creator'])->latest()->take($limit)->get();
    }

    public function getRecentProducts($limit = 5)
    {
        return Product::latest()->take($limit)->get();
    }
    
    public function getRecentActivityStream($limit = 10)
    {
        $activities = collect();
        
        $products = Product::latest()->take($limit)->get()->map(function($item) {
            return [
                'title' => $item->name,
                'module' => 'Product',
                'created_by' => 'Admin', // Static for now, as Product might not have created_by
                'created_at' => $item->created_at,
                'icon' => 'box'
            ];
        });
        
        $blogs = Blog::with('creator')->latest()->take($limit)->get()->map(function($item) {
            return [
                'title' => $item->title,
                'module' => 'Blog',
                'created_by' => $item->creator ? $item->creator->name : 'Admin',
                'created_at' => $item->created_at,
                'icon' => 'file-text'
            ];
        });
        
        $applications = JobApplication::with('career')->latest()->take($limit)->get()->map(function($item) {
            return [
                'title' => 'Application from ' . $item->first_name . ' ' . $item->last_name,
                'module' => 'Job Application',
                'created_by' => $item->first_name . ' ' . $item->last_name,
                'created_at' => $item->created_at,
                'icon' => 'briefcase'
            ];
        });
        
        $inquiries = ContactInquiry::latest()->take($limit)->get()->map(function($item) {
            return [
                'title' => 'Inquiry: ' . ($item->subject ?? 'General'),
                'module' => 'Contact',
                'created_by' => $item->full_name,
                'created_at' => $item->created_at,
                'icon' => 'mail'
            ];
        });
        
        $media = MediaFile::latest()->take($limit)->get()->map(function($item) {
            return [
                'title' => $item->file_name,
                'module' => 'Media',
                'created_by' => 'Admin',
                'created_at' => $item->created_at,
                'icon' => 'image'
            ];
        });
        
        return $activities->concat($products)
                          ->concat($blogs)
                          ->concat($applications)
                          ->concat($inquiries)
                          ->concat($media)
                          ->sortByDesc('created_at')
                          ->take($limit)
                          ->values();
    }
}
