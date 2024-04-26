<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Petugas;
use App\Models\RekamMedis;
use App\Models\DataSakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataSakitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_sakit = DataSakit::orderBy('updated_at', 'desc')->paginate(10);
        $petugas = Petugas::all();
        $pasien = Pasien::all();
        return view('data_sakit.index', compact('data_sakit','pasien','petugas'));
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
        $input = $request->all();
        $data_sakit = DataSakit::create($input);
        // $rekam_medis = RekamMedis::where('id_pasien', $request->id_pasien)->first();
        // $rekam_medis -> create([
        //     'id_pasien' => $request->id_pasien,
        //     'id_data-sakit' => $data_sakit->id,
        // ]);
        return redirect('/data-sakit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data_sakit = DataSakit::find($id);
        $pasien = Pasien::all();
        return view('data_sakit.detail', compact('data_sakit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->role == 'visitor'){
            abort(403);
        }
        $data_sakit = DataSakit::find($id);
        $pasien = Pasien::all();
        $petugas = Petugas::all();
        return view('data_sakit.edit',compact('data_sakit','pasien','petugas'));
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
        $data_sakit = DataSakit::find($id);
        $data_sakit->update([
            'subject' => $request->subject,
            'tensi' => $request->tensi,
            'suhu' => $request->suhu,
            'nadi' => $request->nadi,
            'SPO2' => $request->SPO2,
            'assesment' => $request->assesment,
            'planning' => $request->planning,
            'terapi' => $request->terapi,
            'status_pasien' => $request->status_pasien,
        ]);
        return redirect('/data-sakit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data_sakit = DataSakit::find($id);
        $data_sakit->delete();
        return back();
    }
}
