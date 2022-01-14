<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    public function store(Request $request) {
        // return response()->json($request->all());
        $validator = Validator::make($request->all(), [
            'pilih_gambar' => 'required|image|max:1024'
        ]);

        

        if ($validator->fails()) return response()->json(['errors' => $validator->errors()->all()]);

        $image = $request->file('pilih_gambar');

        $filename = Carbon::now()->timestamp . '-' . uniqid() . '.' .
        $image->getClientOriginalExtension();

        $imgPath = 'img/test_upload/';
        if (!file_exists($imgPath)) {
            mkdir($imgPath, 0755, true);
        }
        $path = $imgPath . $filename;
        $publicPath = url($path);
        $image->move($imgPath, $filename);

        $gambar = new Image;
        $gambar->path = $path;
        $gambar->save();

        $response = [
            'success' => 'Gambar Berhasil Di Upload',
            'images' => '
                <div class="image-box-item">
                    <div class="image-box-item-btn btn-group btn-group-sm" role="group">
                        <span class="btn btn-danger btn-sm" onclick="deleteImage($(this).parent().parent())">
                            <i class="bi bi-trash-fill"></i>
                        </span>
                    </div>
                    <img src="'.$publicPath.'" alt="preview">
                </div>
            ',
            'input_gambar' => "<input type='hidden' name='gambar[]' value='$path'>"
        ];

        return response()->json($response);
    }

    public function delete(Request $request) 
    {
        // return response()->json($request->all());
        $validator = Validator::make($request->all(), [
            'gambar' => 'required|string'
        ]);

        if ($validator->fails()) return response()->json(['errors' => $validator->errors()->all()]);

        try {
            Image::where('path', $request->gambar)->delete();
            return response()->json([
                'success' => 'Data Berhasil Dihapus'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'errors' => 'Data Gagal Dihapus'
            ]);
        }
    }
}
