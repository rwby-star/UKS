<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\MedicalCheckUp;
use Faker\Provider\Medical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class MedicalCheckUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mcu = MedicalCheckUp::orderBy('created_at', 'desc')->paginate(10);
        $jabatan = Jabatan::all();
        // return dd($pasien, $jabatan);
        return view('medical-check-up.index', compact('mcu', 'jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        MedicalCheckUp::create([
            'nama' => $request->nama,
            'id_jabatan' => $request->id_jabatan,
            'mcu' => $request->file('mcu')->store('Medical Check Up'),
        ]);

        Alert::success('Berhasil', 'Medical Check Up berhasil ditambahkan');
        return redirect('/medical-check-up');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mcu = MedicalCheckUp::find($id);
        return view('medical-check-up.detail', compact('mcu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mcu = MedicalCheckUp::find($id);
        $jabatan = Jabatan::all();
        return view('medical-check-up.edit', compact('mcu', 'jabatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mcu = MedicalCheckUp::find($id);

        $input = $request->all();
        $mcu->update($input);
        return redirect('/medical-check-up');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
