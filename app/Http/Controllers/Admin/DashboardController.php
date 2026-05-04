<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard.
     */
    public function index()
    {
        $totalProducts = Product::count();
        $inStockProducts = Product::where('stock_quantity', '>', 0)->count();
        $outOfStockProducts = Product::where('stock_quantity', 0)->count();
        $laptops = Product::where('category', 'Ordinateur')->count();
        $phones = Product::where('category', 'Téléphone')->count();
        $recentProducts = Product::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'inStockProducts',
            'outOfStockProducts',
            'laptops',
            'phones',
            'recentProducts'
        ));
    }
}
