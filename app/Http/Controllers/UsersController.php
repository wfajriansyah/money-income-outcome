<?php

namespace App\Http\Controllers;

use App\Users;
use App\Income;
use App\Outcome;
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
        $my_data = Auth::user();
        $total_user = count(Users::all());
        $total_catatan_masuk = count(Income::all());
        $total_catatan_keluar = count(Outcome::all());
        return view('dashboard', ['my_data' => $my_data, 'total_user' => $total_user, 'total_catatan_masuk' => $total_catatan_masuk, 'total_catatan_keluar' => $total_catatan_keluar]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
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

    public function pageCatatUangMasuk()
    {
        $my_data = Auth::user();
        $total_user = count(Users::all());
        $total_catatan_masuk = count(Income::all());
        $total_catatan_keluar = count(Outcome::all());
        return view('catat_uang_masuk', ['my_data' => $my_data, 'total_user' => $total_user, 'total_catatan_masuk' => $total_catatan_masuk, 'total_catatan_keluar' => $total_catatan_keluar]);
    }

    public function pageCatatUangKeluar()
    {
        $my_data = Auth::user();
        $total_user = count(Users::all());
        $total_catatan_masuk = count(Income::all());
        $total_catatan_keluar = count(Outcome::all());
        return view('catat_uang_keluar', ['my_data' => $my_data, 'total_user' => $total_user, 'total_catatan_masuk' => $total_catatan_masuk, 'total_catatan_keluar' => $total_catatan_keluar]);
    }

    public function pagePerkembangan()
    {

    }

    public function pageLaporanKeseluruhan()
    {

    }
}
