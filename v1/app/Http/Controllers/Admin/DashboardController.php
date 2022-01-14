<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard Admin';
        $productCount = Product::count();
        $productCategoryCount = ProductCategory::where('is_delete', 0)->count();
    
        return view('admin.dashboard', compact('title', 'productCount', 'productCategoryCount'));
    }
}
