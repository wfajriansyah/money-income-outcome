<?php

namespace App\Http\Controllers;

use App\Catatan;
use App\Users;
use Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CatatanController extends Controller
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

    public function prosesCatatUangMasuk(Request $request)
    {
        $rules = [
            'nominal' => 'required|integer',
            'notes' => 'required|string'
        ];

        $messages = [
            'nominal.required' => 'Nominal harus diisi.',
            'notes.required' => 'Note harus diisi.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $input = new Catatan();
        $input->id = "INC-".generateRandomNumber(15);
        $input->users_id = Auth::user()->id;
        $input->nominal = $request->nominal;
        $input->notes = $request->notes;
        $input->save();

        return redirect()->back()->with(['success' => 'Data berhasil disimpan.']);
    }

    public function prosesCatatUangKeluar(Request $request)
    {
        $rules = [
            'nominal' => 'required|integer',
            'notes' => 'required|string'
        ];

        $messages = [
            'nominal.required' => 'Nominal harus diisi.',
            'notes.required' => 'Note harus diisi.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $input = new Catatan();
        $input->id = "OUT-".generateRandomNumber(15);
        $input->users_id = Auth::user()->id;
        $input->nominal = $request->nominal;
        $input->notes = $request->notes;
        $input->save();

        return redirect()->back()->with(['success' => 'Data berhasil disimpan.']);
    }

    public function prosesEditCatatan(Request $request)
    {
        $rules = [
            'id' => 'required|string|exists:catatans,id',
            'nominal' => 'required|integer',
            'notes' => 'required|string'
        ];

        $messages = [
            'id.exists' => 'ID Tidak ada.',
            'nominal.required' => 'Nominal harus diisi.',
            'notes.required' => 'Note harus diisi.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $catatan = Catatan::where('id', $request->id)->firstOrFail();
        $catatan->nominal = $request->nominal;
        $catatan->notes = $request->notes;
        $catatan->save();

        return redirect()->back()->with(['success' => 'Data berhasil disimpan.']);
    }

    public function prosesPeriodeRiwayat(Request $request)
    {
        $my_data = Auth::user();
        $total_user = count(Users::all());
        $total_catatan_masuk = count(Catatan::where('id', 'LIKE', '%INC%')->get());
        $total_catatan_keluar = count(Catatan::where('id', 'LIKE', '%OUT%')->get());
        $isPeriode = $request->periode;

        if($isPeriode == 99) {
            $sub = Carbon::now();
            $submonth = $sub->format('m');
        } else {
            $sub = Carbon::now()->subMonths($isPeriode);
            $submonth = $sub->format('m');
        }
        $history = Catatan::where('users_id', Auth::user()->id)->whereMonth('created_at', $submonth)->orderBy('created_at', 'desc')->get(['id as idnya', 'catatans.*']);
        $total_menabung = Catatan::where('users_id', Auth::user()->id)->where('id', 'LIKE', '%INC%')->whereMonth('created_at', $submonth)->sum('nominal');
        $total_pengeluaran = Catatan::where('users_id', Auth::user()->id)->where('id', 'LIKE', '%OUT%')->whereMonth('created_at', $submonth)->sum('nominal');

        $isProfit = "Tidak";
        if($total_menabung > $total_pengeluaran) {
            $isProfit = "Ya";
        }

        $isRugi = "Tidak";
        if(($total_menabung < $total_pengeluaran) || $total_menabung == 0) {
            $isRugi = "Ya";
        }

        $isBalance = "Tidak";
        if(($total_menabung + $total_pengeluaran) == 1000000) {
            $isBalance = "Ya";
        }

        $isKekurangan = "Tidak";
        if((1000000 - $total_menabung) < 0) {
            $isKekurangan = "Tidak";
        } else {
            $isKekurangan = convertRupiah(1000000 - $total_menabung);
        }
        return view('laporanRiwayat', [
            'my_data' => $my_data,
            'total_user' => $total_user,
            'total_catatan_masuk' => $total_catatan_masuk,
            'total_catatan_keluar' => $total_catatan_keluar,
            'history' => $history,
            'isPeriode' => $isPeriode,
            'menabung' => $total_menabung,
            'pengeluaran' => $total_pengeluaran,
            'isProfit' => $isProfit,
            'isRugi' => $isRugi,
            'isBalance' => $isBalance,
            'isKekurangan' => $isKekurangan,
        ]);
    }

    public function prosesLaporanKeseluruhan(Request $request)
    {
        $my_data = Auth::user();
        $total_user = count(Users::all());
        $total_catatan_masuk = count(Catatan::where('id', 'LIKE', '%INC%')->get());
        $total_catatan_keluar = count(Catatan::where('id', 'LIKE', '%OUT%')->get());
        $isPeriode = $request->periode;

        if($isPeriode == 99) {
            $sub = Carbon::now();
            $submonth = $sub->format('m');
        } else {
            $sub = Carbon::now()->subMonths($isPeriode);
            $submonth = $sub->format('m');
        }
        $history = Catatan::whereMonth('created_at', $submonth)->orderBy('created_at', 'desc')->get(['id as idnya', 'catatans.*']);
        $total_menabung = Catatan::where('id', 'LIKE', '%INC%')->whereMonth('created_at', $submonth)->sum('nominal');
        $total_pengeluaran = Catatan::where('id', 'LIKE', '%OUT%')->whereMonth('created_at', $submonth)->sum('nominal');

        $catatans = DB::select(DB::raw("SELECT MONTH(created_at) as bulan, ( SELECT SUM(nominal) FROM catatans WHERE MONTH(created_at) = bulan AND id LIKE '%INC%' ) as nominals_masuk, ( SELECT SUM(nominal) FROM catatans WHERE MONTH(created_at) = bulan AND id LIKE '%OUT%' ) as nominals_keluar FROM catatans GROUP BY bulan, nominals_masuk, nominals_keluar"));

        $rata_rata_tabungan = 0;
        $rata_rata_tabungans = 0;
        foreach($catatans as $cats) {
            $rata_rata_tabungan += ($cats->nominals_masuk + $cats->nominals_keluar);
            $rata_rata_tabungans += $cats->nominals_keluar;
        }
        $rata_rata_tabungan = $rata_rata_tabungan / count($catatans);
        $rata_rata_tabungans = $rata_rata_tabungans / count($catatans);

        $isProfit = "Tidak";
        if($total_menabung > $total_pengeluaran) {
            $isProfit = "Ya";
        }

        $isRugi = "Tidak";
        if(($total_menabung < $total_pengeluaran) || $total_menabung == 0) {
            $isRugi = "Ya";
        }

        $isBalance = "Tidak";
        if(($total_menabung + $total_pengeluaran) == $rata_rata_tabungan) {
            $isBalance = "Ya";
        }

        $isKekurangan = "Tidak";
        if(($rata_rata_tabungan - $total_menabung) < 0) {
            $isKekurangan = "Tidak";
        } else {
            $isKekurangan = convertRupiah($rata_rata_tabungan - $total_menabung);
        }
        return view('admin_laporan', [
            'my_data' => $my_data,
            'total_user' => $total_user,
            'total_catatan_masuk' => $total_catatan_masuk,
            'total_catatan_keluar' => $total_catatan_keluar,
            'history' => $history,
            'isPeriode' => $isPeriode,
            'menabung' => $total_menabung,
            'pengeluaran' => $total_pengeluaran,
            'isProfit' => $isProfit,
            'isRugi' => $isRugi,
            'isBalance' => $isBalance,
            'isKekurangan' => $isKekurangan,
            'rata_tabungan' => $rata_rata_tabungan,
            'rata_pengeluaran' => $rata_rata_tabungans,
        ]);
    }

}
