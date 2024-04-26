<?php

namespace App\Http\Controllers;

use App\Exports\PasienExport;
use App\Models\Jabatan;
use App\Models\Pasien;
use App\Models\RekamMedis;
use App\Models\DataSakit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\PasienImport;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pasien = Pasien::orderBy('created_at', 'desc')->paginate(10);
        $jabatan = Jabatan::all();
        // return dd($pasien, $jabatan);
        return view('pasien.index', compact('pasien', 'jabatan'));
    }

    // public function pasienExport()
    // {
    //     return Excel::download(new PasienExport, 'Pasien.xlsx');
    // }

    public function pasienImport (Request $request)
    {
        $file = $request->file('file');
        Excel::import(new PasienImport, $file);
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

        $validator = Validator::make($request->all(), [
            'nama_pasien' => "unique:pasien,nama_pasien",
        ]);

        if ($validator->fails()) {
            Alert::error('Maaf', 'Data yang anda masukkan tidak sesuai/kurang lengkap. Mohon lengkapi kembali');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $pasien = Pasien::create([
            'nama_pasien' => $request->nama_pasien,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kelas' => $request->kelas,
            'id_jabatan' => $request->id_jabatan,
        ]);

        // RekamMedis::create([
        //     'id_pasien' => $pasien->id,
        //     'id_data-sakit' => 0,
        // ]);
        // Alert::success('Berhasil', 'Pasien berhasil ditambahkan');
        return redirect('/pasien');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pasien = Pasien::find($id);
        return view('pasien.detail', compact('pasien'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->role == 'visitor'){
            abort(403);
        }
        $pasien = Pasien::find($id);
        $jabatan = Jabatan::all();
        return view('pasien.edit', compact('pasien', 'jabatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pasien = Pasien::find($id);

        $input = $request->all();
        $input['tanggal_lahir'] = date('Y-m-d');
        $pasien->update($input);
        return redirect('/pasien');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pasien = Pasien::find($id);
        $data_sakit = DataSakit::find($id);
        if($data_sakit == null){
            $pasien->delete();
        }
        $pasien->delete();
        return back();
    }
}
