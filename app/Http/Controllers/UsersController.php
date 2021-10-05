<?php

namespace App\Http\Controllers;

use App\Users;
use App\Catatan;
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
        $total_catatan_masuk = count(Catatan::where('id', 'LIKE', '%INC%')->get());
        $total_catatan_keluar = count(Catatan::where('id', 'LIKE', '%OUT%')->get());
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
        $total_catatan_masuk = count(Catatan::where('id', 'LIKE', '%INC%')->get());
        $total_catatan_keluar = count(Catatan::where('id', 'LIKE', '%OUT%')->get());
        return view('catat_uang_masuk', ['my_data' => $my_data, 'total_user' => $total_user, 'total_catatan_masuk' => $total_catatan_masuk, 'total_catatan_keluar' => $total_catatan_keluar]);
    }

    public function pageCatatUangKeluar()
    {
        $my_data = Auth::user();
        $total_user = count(Users::all());
        $total_catatan_masuk = count(Catatan::where('id', 'LIKE', '%INC%')->get());
        $total_catatan_keluar = count(Catatan::where('id', 'LIKE', '%OUT%')->get());
        return view('catat_uang_keluar', ['my_data' => $my_data, 'total_user' => $total_user, 'total_catatan_masuk' => $total_catatan_masuk, 'total_catatan_keluar' => $total_catatan_keluar]);
    }

    public function pageRiwayat()
    {
        $my_data = Auth::user();
        $total_user = count(Users::all());
        $total_catatan_masuk = count(Catatan::where('id', 'LIKE', '%INC%')->get());
        $total_catatan_keluar = count(Catatan::where('id', 'LIKE', '%OUT%')->get());
        $my_history = Catatan::join('users', 'users.id', '=', 'catatans.users_id')->where('users_id', Auth::user()->id)->orderBy('catatans.created_at', 'desc')->get(['users.fullname', 'catatans.id AS idnya', 'catatans.*']);
        return view('riwayat', ['my_data' => $my_data, 'total_user' => $total_user, 'total_catatan_masuk' => $total_catatan_masuk, 'total_catatan_keluar' => $total_catatan_keluar, 'history' => $my_history]);
    }

    public function pageEditRiwayat($id)
    {
        $my_data = Auth::user();
        $total_user = count(Users::all());
        $total_catatan_masuk = count(Catatan::where('id', 'LIKE', '%INC%')->get());
        $total_catatan_keluar = count(Catatan::where('id', 'LIKE', '%OUT%')->get());
        $history = Catatan::where('id', $id)->firstOrFail(['catatans.*', 'id as idnya']);
        return view('editRiwayat', ['my_data' => $my_data, 'total_user' => $total_user, 'total_catatan_masuk' => $total_catatan_masuk, 'total_catatan_keluar' => $total_catatan_keluar, 'history' => $history]);
    }

    public function pageLaporan()
    {
        $my_data = Auth::user();
        $total_user = count(Users::all());
        $total_catatan_masuk = count(Catatan::where('id', 'LIKE', '%INC%')->get());
        $total_catatan_keluar = count(Catatan::where('id', 'LIKE', '%OUT%')->get());
        $history = Catatan::where('users_id', Auth::user()->id)->get();
        return view('laporanRiwayat', ['my_data' => $my_data, 'total_user' => $total_user, 'total_catatan_masuk' => $total_catatan_masuk, 'total_catatan_keluar' => $total_catatan_keluar, 'history' => $history]);
    }

    public function pagePerkembangan()
    {

    }

    public function pageLaporanKeseluruhan()
    {

    }
}
