<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;

class LoginController extends Controller
{
    public function showFormLogin()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required'
        ];
    
        $message = [
            'required' => ':attribute tidak boleh kosong.'
        ];

        $this->validate($request, $rules, $message);

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return redirect()->route('backoffice.dashboard');
        }else{
            return redirect()->back()->with('error','Login Gagal');
        }
        
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('backoffice.login');
    }
}
