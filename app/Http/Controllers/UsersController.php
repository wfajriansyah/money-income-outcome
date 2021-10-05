<?php

namespace App\Http\Controllers;

use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function pageLogin()
    {
        return view('login');
    }

    public function doSignin(Request $request)
    {
        $rules = [
            'username' => 'required|string|exists:users,username',
            'password' => 'required|string',
        ];
        $messages = [
            'username.required' => 'Username wajib diisi.',
            'username.exists' => 'Username tidak terdaftar didatabase.',
            'password.required' => 'Password wajib diisi.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
        $data = [
            'username'     => $request->input('username'),
            'password'  => $request->input('password'),
        ];

        Auth::attempt($data);
        if(Auth::check()) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->withErrors(['errors' => 'Password salah.']);
        }
    }
}
