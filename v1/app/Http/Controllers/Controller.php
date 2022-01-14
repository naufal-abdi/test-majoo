<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $perPage;
    public $messages;

    public function __construct()
    {   
        $this->perPage = env('APP_VERS') === 'dev' ? 5 : 20;
        $this->messages = [
            'required' => ':attribute harus diisi',
            'email' => 'Masukkan email yang valid',
            'string' => 'Jenis data yang dimasukkan harus berupa string',
            'min' => 'Panjang :attribute minimal :min karakter',
            'max' => 'Panjang :attribute maksimal :max karakter',
            'unique' => ':attribute sudah digunakan, silahkan gunakan :attribute lain',
            'digits_between' => ':attribute minimal harus :min digit dan maksimal :max digit'
        ];
    }

    // public function message()
    // {
    //     return [
    //         'required' => ':attribute harus diisi',
    //         'email' => 'Masukkan email yang valid',
    //         'min' => 'Panjang :attribute minimal :min karakter',
    //         'max' => 'Panjang :attribute minimal :max karakter'
    //     ];
        
    // }
}
