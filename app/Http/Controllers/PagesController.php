<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    // Home Demos
    public function home(): View {
        $latestBlogs = \App\Models\Blog::with(['featuredMedia', 'category', 'author'])
            ->where('status', true)
            ->orderByDesc('published_at')
            ->take(6)
            ->get();
        return view('pages.home', compact('latestBlogs'));
    }
    public function home2(): View { return view('pages.home-2'); }
    public function home3(): View { return view('pages.home-3'); }
    public function home4(): View { return view('pages.home-4'); }
    public function home5(): View { return view('pages.home-5'); }
    public function home6(): View { return view('pages.home-6'); }
    public function home7(): View { return view('pages.home-7'); }
    public function home8(): View { return view('pages.home-8'); }
    public function home9(): View { return view('pages.home-9'); }
    public function home10(): View { return view('pages.home-10'); }

    // About Us
    public function about(): View { return view('pages.about'); }

    public function products(): View { 
        $categories = \App\Models\ProductCategory::where('status', true)->orderBy('sort_order')->get();
        $products = \App\Models\Product::with('cardMedia')->where('status', true)->orderBy('sort_order')->paginate(12);
        return view('pages.products', compact('categories', 'products')); 
    }
    public function product2(): View { return view('pages.product-2'); }
    public function product3(): View { return view('pages.product-3'); }
    public function productDetails(?string $slug = null): View 
    { 
        $query = \App\Models\Product::with([
            'bannerMedia', 'cardMedia', 'features', 'applications', 'specifications'
        ])->where('status', true);
        
        $product = $slug ? $query->where('slug', $slug)->firstOrFail() : $query->orderBy('sort_order')->firstOrFail();
        $categories = \App\Models\ProductCategory::where('status', true)->orderBy('sort_order')->get();
        
        return view('pages.product-details', compact('product', 'categories')); 
    }

    // Legacy Service Aliases
    public function services(): View { return $this->products(); }
    public function service2(): View { return $this->product2(); }
    public function service3(): View { return $this->product3(); }
    public function serviceDetails(string $slug = 'lt-pcc-panels'): View { return $this->productDetails($slug); }

    // Project / Portfolio Demos
    public function projects(): View { return view('pages.projects'); }
    public function portfolio2(): View { return view('pages.portfolio-2'); }
    public function portfolio3(): View { return view('pages.portfolio-3'); }
    public function projectDetails(): View { return view('pages.project-details'); }

    // Blog Demos & Enterprise Dynamic Integration
    protected function getBlogIndexData(Request $request): array
    {
        $query = \App\Models\Blog::with(['featuredMedia', 'category', 'author'])
            ->where('status', true);

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }


        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $blogs = $query->orderByDesc('published_at')->paginate(6)->withQueryString();

        $categories = \App\Models\BlogCategory::withCount(['blogs' => function ($q) {
            $q->where('status', true);
        }])->where('status', true)->orderBy('sort_order')->get();

        $recentBlogs = \App\Models\Blog::with('featuredMedia')
            ->where('status', true)
            ->orderByDesc('published_at')
            ->take(4)
            ->get();

        return compact('blogs', 'categories', 'recentBlogs');
    }

    public function blogs(Request $request): View { 
        return view('pages.blogs', $this->getBlogIndexData($request)); 
    }
    public function blogGrid(Request $request): View { 
        return view('pages.blog-grid', $this->getBlogIndexData($request)); 
    }
    public function blogList(Request $request): View { 
        return view('pages.blog-list', $this->getBlogIndexData($request)); 
    }
    public function blogStandard(Request $request): View { 
        return view('pages.blog-standard', $this->getBlogIndexData($request)); 
    }
    public function blogSingle(?string $slug = null): View { 
        $query = \App\Models\Blog::with([
            'category', 'author', 'featuredMedia', 'bannerMedia', 'gallery.media', 'documents.media', 'faqs', 'relatedBlogs.featuredMedia', 'seo'
        ])->where('status', true);

        $blog = $slug ? $query->where('slug', $slug)->firstOrFail() : $query->orderByDesc('published_at')->firstOrFail();

        $categories = \App\Models\BlogCategory::withCount(['blogs' => function ($q) {
            $q->where('status', true);
        }])->where('status', true)->orderBy('sort_order')->get();

        $recentBlogs = \App\Models\Blog::with('featuredMedia')
            ->where('status', true)
            ->where('id', '!=', $blog->id)
            ->orderByDesc('published_at')
            ->take(4)
            ->get();

        return view('pages.blog-single', compact('blog', 'categories', 'recentBlogs')); 
    }

    // Galleries & Misc
    public function gallery1(): View { return view('pages.gallery-1'); }
    public function gallery2(): View { return view('pages.gallery-2'); }
    public function pricing(): View { return view('pages.pricing'); }
    public function faq(): View { return view('pages.faq'); }

    // Team Demos
    public function team(): View { return view('pages.team'); }
    public function teamDetails(): View { return view('pages.team-details'); }

    // Shop Demos
    public function shop(): View { return view('pages.shop'); }
    public function shopDetails(): View { return view('pages.shop-details'); }

    // Contact, Careers & Utility
    public function contact(): View { return view('pages.contact'); }
    
    public function careers(\Illuminate\Http\Request $request, \App\Repositories\CareerRepository $careerRepo): View { 
        $filters = $request->only(['department_id', 'job_location_id', 'job_type_id', 'search']);
        $careers = $careerRepo->getPublicCareers($filters);
        
        $departments = \App\Models\Department::active()->get();
        $locations = \App\Models\JobLocation::active()->get();
        $jobTypes = \App\Models\JobType::active()->get();
        
        return view('pages.careers', compact('careers', 'departments', 'locations', 'jobTypes', 'filters')); 
    }
    
    public function applyCareer(\App\Http\Requests\StoreJobApplicationRequest $request, \App\Services\JobApplicationService $appService) {
        $data = $request->validated();
        
        // Merge names
        $data['full_name'] = trim($data['first_name'] . ' ' . $data['last_name']);
        
        // Handle Resume Upload
        if ($request->hasFile('resume')) {
            // Re-use MediaController logic or standard upload
            // We need to create a MediaFile for the resume
            $file = $request->file('resume');
            $path = $file->store('resumes', 'public');
            
            $media = \App\Models\MediaFile::create([
                'folder_id' => null, // root or specific folder
                'file_name' => basename($path),
                'original_name' => $file->getClientOriginalName(),
                'file_type' => 'document',
                'mime_type' => $file->getMimeType(),
                'extension' => $file->getClientOriginalExtension(),
                'file_size' => $file->getSize(),
                'file_path' => $path,
                'uploaded_by' => null, // Guest upload
            ]);
            
            $data['resume_media_id'] = $media->id;
        }

        $application = $appService->createApplication($data);
        
        // Trigger emails if needed...

        return redirect()->back()->with('success', 'Your application has been submitted successfully! Our HR team will contact you soon.');
    }
    
    public function submitContact(\App\Http\Requests\StoreContactInquiryRequest $request, \App\Services\ContactInquiryService $inquiryService) {
        $data = $request->validated();
        
        // Map frontend fields to backend
        $inquiryData = [
            'full_name' => $data['fullname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'subject' => $data['service'],
            'message' => $data['message'] ?? null,
        ];
        
        // Attempt to find product_id if the selected service matches a product name
        if ($data['service'] !== 'General Inquiry') {
            $product = \App\Models\Product::where('name', 'like', $data['service'])->first();
            if ($product) {
                $inquiryData['product_id'] = $product->id;
            }
        }

        $inquiryService->createInquiry($inquiryData);

        return redirect()->back()->with('success', 'Your message has been sent successfully! We will get back to you soon.');
    }

    public function comingSoon(): View { return view('pages.coming-soon'); }
    public function errorPage(): View { return view('pages.404'); }
}
