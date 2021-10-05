<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Outcome;
use Illuminate\Http\Request;

class OutcomeController extends Controller
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

        $input = new Outcome();
        $input->id = "OUT-".generateRandomNumber(15);
        $input->users_id = Auth::user()->id;
        $input->nominal = $request->nominal;
        $input->notes = $request->notes;
        $input->save();

        return redirect()->back()->with(['success' => 'Data berhasil disimpan.']);
    }
}
