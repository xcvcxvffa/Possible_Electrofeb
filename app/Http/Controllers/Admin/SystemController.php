<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Models\Product;
use App\Models\Blog;
use App\Models\ProductCategory;
use App\Models\Career;
use App\Models\JobApplication;
use App\Models\ContactInquiry;

class SystemController extends Controller
{
    /**
     * Clear application cache.
     */
    public function clearCache()
    {
        try {
            Artisan::call('optimize:clear');
            return redirect()->back()->with('success', 'System cache cleared successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to clear cache. Check logs for details.');
        }
    }

    /**
     * Global AJAX Search.
     */
    public function globalSearch(Request $request)
    {
        $query = $request->input('query');
        if (empty($query)) {
            return response()->json([]);
        }

        $results = [];

        // Search Products
        $products = Product::where('name', 'LIKE', "%{$query}%")->limit(5)->get();
        if ($products->count() > 0) {
            $results['Products'] = $products->map(function($item) {
                return [
                    'title' => $item->name,
                    'url' => route('admin.products.edit', $item->id),
                    'icon' => 'box'
                ];
            });
        }

        // Search Blogs
        $blogs = Blog::where('title', 'LIKE', "%{$query}%")->limit(5)->get();
        if ($blogs->count() > 0) {
            $results['Blogs'] = $blogs->map(function($item) {
                return [
                    'title' => $item->title,
                    'url' => route('admin.blogs.edit', $item->id),
                    'icon' => 'file-text'
                ];
            });
        }

        // Search Careers
        $careers = Career::where('title', 'LIKE', "%{$query}%")->limit(3)->get();
        if ($careers->count() > 0) {
            $results['Careers'] = $careers->map(function($item) {
                return [
                    'title' => $item->title,
                    'url' => route('admin.careers.edit', $item->id),
                    'icon' => 'briefcase'
                ];
            });
        }

        // Search Inquiries
        $inquiries = ContactInquiry::where('full_name', 'LIKE', "%{$query}%")
                                   ->orWhere('subject', 'LIKE', "%{$query}%")
                                   ->limit(3)->get();
        if ($inquiries->count() > 0) {
            $results['Inquiries'] = $inquiries->map(function($item) {
                return [
                    'title' => $item->full_name . ' - ' . $item->subject,
                    'url' => route('admin.contact-inquiries.show', $item->id),
                    'icon' => 'mail'
                ];
            });
        }

        return response()->json($results);
    }
}
