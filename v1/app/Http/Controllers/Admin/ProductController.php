<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Daftar Produk';
        $startNumber = 1;
        if ($request->p > 1) {
            $startNumber = (($request->p - 1) * $this->perPage) + 1;
        }

        $select = ['product.id', 'product.name', 'product.description', 'product.price', 'product.category_id', 'prc.name as category'];
        $products = Product::join('product_category as prc', 'prc.id', '=', 'product.category_id')
        ->select($select)
        ->paginate($this->perPage, ['*'], 'p')->withQueryString();
        
        return view('admin.product.index', compact('title', 'products', 'startNumber'));
    }

    public function add(Request $request)
    {
        $title = 'Produk Baru';

        if ($request->ajax()) {
            $keyword = $request->q;
            $category = ProductCategory::where('name', 'LIKE', "%$keyword%")
            ->where('is_delete', 0)
            ->limit(10)
            ->get();

            return $category;
        }

        return view('admin.product.add', compact('title'));
    }

    public function show($id)
    {
        $title = 'Detail Produk';
        
        try {
            $select = ['product.id', 'product.name', 'product.description', 'product.price', 'product.category_id', 'prc.name as category'];
            $product = Product::join('product_category as prc', 'prc.id', '=', 'product.id')            
            ->select($select)
            ->where('product.id', $id)
            ->first();

            $productImage = Image::where('product_id', $id)->get();

            // dd($product);

            return view('admin.product.add', compact('title', 'product', 'productImage'));
        } catch (\Throwable $e) {
            return env('APP_VERS') === 'dev' ?
            redirect('/admin/produk')->with('error', $e->getMessage())
            : redirect('/admin/produk')->with('error', 'Data Tidak Ditemukan');
        }
    }

    public function store(Request $request)
    {        
        $rules = [
            'nama' => 'required|string|min:5:max:255|unique:product,name',
            'kategori' => 'required|numeric',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|digits_between:3,14',
            'gambar' => 'required',
            'gambar.*' => 'string'
        ];
        
        if($request->has('id')) $rules['nama'] .= ','.$request->id;

        $validator = Validator::make($request->all(), $rules, $this->messages);

        if ($validator->fails()) return back()->withErrors($validator)->withInput();
            
        $product = null;
        $actionType = null;

        try {
            if ($request->has('id')) {
                $actionType = 'Diubah';
                $product = Product::find($request->id);
            } else {
                $actionType = 'Disimpan';
                $product = new Product;
                $product->added_by = Auth::user()->id;
            }
            
            $product->category_id = $request->kategori;            
            $product->name = $request->nama;
            $product->price = $request->harga;
            $product->description = $request->deskripsi;
            $product->save();
            
            // ini baris kode untuk simpan data gambar dan thumbnail product
            Image::whereIn('path', $request->gambar)->update(['product_id' => $product->id]);

            return redirect('/admin/produk')->with('success', "Data Berhasil $actionType");

        } catch (\Throwable $e) {
            return env('APP_VERS') === 'dev' ?
            redirect('/admin/produk')->with('error', $e->getMessage())
            : redirect('/admin/produk')->with('error', "Data Gagal $actionType");
        }
    }

    public function delete($id)
    {
        try {            
            $image = Image::where('product_id', $id);

            foreach($image->get() as $img) {
                // delete image file
                @unlink($img->path);
            }
            // delete image data from database
            $image->delete();

            // delete product data
            $product = Product::find($id);
            $product->delete();

            return redirect('/admin/produk')->with('success', 'Data Berhasil Dihapus');
        } catch (\Throwable $e) {
            return env('APP_VERS') === 'dev' ?
            redirect('/admin/produk')->with('error', $e->getMessage())
            : redirect('/admin/produk')->with('error', 'Data Gagal Dihapus');
        }
    }
}
