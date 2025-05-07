<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get recent categories with product count
        $categories = Category::withCount('products')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get recent products
        $products = Product::with('category')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get products with low stock (less than 5)
        $lowStockProducts = Product::where('stock', '<', 5)
            ->where('is_active', true)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        // Get total counts for stats
        $totalCategories = Category::count();
        $totalProducts = Product::count();

        return view('dashboard', compact(
            'categories',
            'products',
            'lowStockProducts',
            'totalCategories',
            'totalProducts'
        ));
    }
}
