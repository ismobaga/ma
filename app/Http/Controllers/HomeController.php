<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Product;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::where('is_active', true)->orderBy('sort_order')->get();
        $featuredCategories = Category::where('is_active', true)->orderBy('sort_order')->take(6)->get();
        $featuredProducts = Product::where('is_active', true)->where('is_featured', true)->take(8)->get();
        $newArrivals = Product::where('is_active', true)->where('is_new', true)->take(8)->get();
        $collections = Collection::where('is_active', true)->orderBy('sort_order')->take(4)->get();
        $testimonials = Testimonial::where('is_active', true)->take(6)->get();

        return view('pages.home', compact(
            'banners', 'featuredCategories', 'featuredProducts',
            'newArrivals', 'collections', 'testimonials'
        ));
    }
}
