<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the home page.
     */
    public function index()
    {
        // Get all featured products
        $featuredProducts = \App\Models\Product::inRandomOrder()->get();
        
        // Get stats
        $totalProducts = \App\Models\Product::count();
        $categories = \App\Models\Product::distinct('category')->pluck('category');

        return view('public.home', compact('featuredProducts', 'totalProducts', 'categories'));
    }

    /**
     * Show contact page.
     */
    public function contact()
    {
        return view('public.contact');
    }
}
