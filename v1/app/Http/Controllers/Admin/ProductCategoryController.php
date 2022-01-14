<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Daftar Kategori Produk';
        try {
            $startNumber = 1;
            if ($request->p > 1) {
                $startNumber = (($request->p - 1) * $this->perPage) + 1;
            }

            $categories = ProductCategory::where('is_delete', 0)->paginate($this->perPage, ['*'], 'p')->withQueryString();

            return view('admin.categories.index', compact('title', 'categories', 'startNumber'));
        } catch (\Throwable $e) {
            return env('APP_VERS') === 'dev' ?
            redirect('/admin')->with('error', $e->getMessage())
            : redirect('/admin')->with('error', 'Data Tidak Ditemukan');
        }
    }

    public function add()
    {
        $title = 'Katagori Baru';
        
        return view('admin.categories.add', compact('title'));
    }

    public function show($id)
    {
        $title = 'Detail Kategori';
        try {
            $category = ProductCategory::find($id);
            
            return view('admin.categories.add', compact('title', 'category'));
        } catch (\Throwable $e) {
            return env('APP_VERS') === 'dev' ?
            redirect('/admin/kategori')->with('error', $e->getMessage())
            : redirect('/admin/kategori')->with('error', 'Data Tidak Ditemukan');
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|min:5|max:50',
            'deskripsi' => 'nullable|string|max:255'
        ], $this->messages);

        if ($validator->fails()) return back()->withErrors($validator)->withInput();

        $category = null;
        $actionType = null;

        try {
            if ($request->has('id')) {
                $actionType = 'Diubah';                
                $category = ProductCategory::find($request->id);
            } else {
                $actionType = 'Disimpan';
                $category = new ProductCategory;
                $category->added_by = Auth::user()->id;
            }

            $category->name = $request->nama;
            if ($request->has('deskripsi')) $category->description = $request->deskripsi;
            $category->save();

            return redirect('/admin/kategori')->with('success', "Data Berhasil $actionType");
        } catch (\Throwable $e) {
            return env('APP_VERS') === 'dev' ?
            redirect('/admin/kategori')->with('error', $e->getMessage())
            : redirect('/admin/kategori')->with('error', "Data Gagal $actionType");
        }
    }

    public function delete($id)
    {   
        try {
            ProductCategory::find($id)
            ->update([
                'is_delete' => 1
            ]);

            return redirect('/admin/kategori')->with('success', 'Data Berhasil Dihapus');
        } catch (\Throwable $e) {
            return env('APP_VERS') === 'dev' ?
            redirect('/admin/kategori')->with('error', $e->getMessage())
            : redirect('/admin/kategori')->with('error', 'Data Gagal Dihapus');
        }
    }
}
