<?php

namespace App\Http\Controllers;

use App\Catatan;
use Auth;
use Validator;
use Illuminate\Http\Request;

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

}
