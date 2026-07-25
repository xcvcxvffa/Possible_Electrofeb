<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PagesController extends Controller
{
    // Home Demos
    public function home(): View { return view('pages.home'); }
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

    // Product Demos
    public function products(): View { return view('pages.products'); }
    public function product2(): View { return view('pages.product-2'); }
    public function product3(): View { return view('pages.product-3'); }
    public function productDetails(string $slug = 'lt-pcc-panels'): View 
    { 
        return view('pages.product-details', ['slug' => $slug]); 
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

    // Blog Demos
    public function blogs(): View { return view('pages.blogs'); }
    public function blogGrid(): View { return view('pages.blog-grid'); }
    public function blogList(): View { return view('pages.blog-list'); }
    public function blogStandard(): View { return view('pages.blog-standard'); }
    public function blogSingle(): View { return view('pages.blog-single'); }

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
    public function careers(): View { return view('pages.careers'); }
    public function comingSoon(): View { return view('pages.coming-soon'); }
    public function errorPage(): View { return view('pages.404'); }
}
