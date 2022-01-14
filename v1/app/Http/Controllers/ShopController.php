<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $title = 'Produk';
        try {
            $select = ['product.id', 'product.name', 'product.price', 'product.description', 'image.path'];
            $products = Product::leftJoin('image', 'product_id', '=', 'product.id')
            ->select($select)
            ->groupBy('product.name')
            ->paginate(4, ['*'], 'p')->withQueryString();
            // dd($products);

            return view('shop.index', compact('title', 'products'));
        } catch (\Throwable $e) {
            return env('APP_VERS') === 'dev' ?
            redirect('/admin')->with('error', $e->getMessage())
            : redirect('/admin')->with('error', 'Data Tidak Ditemukan');
        }
        
    }
}
