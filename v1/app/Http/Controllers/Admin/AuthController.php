<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class AuthController extends Controller
{
    public function index()
    {
        $title = 'Login Admin';
        return view('admin.login', compact('title'));
    }

    public function check(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:5|max:10'
        ], $this->messages);

        if ($validator->fails()) return back()->withErrors($validator)->withInput();

        // dd(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]));

        try {
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect('/admin')->with('success', 'Selamat Datang');
            }
            
        } catch (\Throwable $e) {
            return env('APP_ENV') === 'dev' ?
            redirect('/login')->with('error', $e->getMessage())
            : redirect('/login')->with('error', "Login Gagal");
        }
    }

    function logout(){
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
