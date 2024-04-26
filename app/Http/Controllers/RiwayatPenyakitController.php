<?php

namespace App\Http\Controllers;

use App\Imports\RiwayatPenyakitImport;
use App\Models\Jabatan;
use App\Models\RiwayatPenyakit;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RiwayatPenyakitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $riwayat_penyakit = RiwayatPenyakit::orderBy('created_at', 'desc')->paginate(10);
        $jabatan = Jabatan::all();
        // return dd($pasien, $jabatan);
        return view('riwayat_penyakit.index', compact('riwayat_penyakit', 'jabatan'));
    }

    public function riwayatPenyakitImport (Request $request)
    {
        $file = $request->file('file');
        Excel::import(new RiwayatPenyakitImport, $file);
        return back();
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
        RiwayatPenyakit::create($input);
        return redirect('/riwayat-penyakit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $riwayat_penyakit = RiwayatPenyakit::find($id);
        return view('riwayat_penyakit.detail', compact('riwayat_penyakit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $riwayat_penyakit = RiwayatPenyakit::find($id);
        $jabatan = Jabatan::all();
        return view('riwayat_penyakit.edit', compact('riwayat_penyakit','jabatan'));
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
        $riwayat_penyakit = RiwayatPenyakit::find($id);

        $input = $request->all();
        $riwayat_penyakit->update($input);
        return redirect('/riwayat-penyakit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $riwayat_penyakit = RiwayatPenyakit::find($id);
        $riwayat_penyakit->delete();
        return back();
    }
}
