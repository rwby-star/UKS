<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Petugas;
use App\Models\DataSakit;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index_rawat()
    {
        $data_sakit = DataSakit::where('status_pasien', 'Rawat')->paginate(10);
        $pasien = Pasien::all();
        $petugas = Petugas::all();
        return view('status-pasien.rawat', compact('data_sakit', 'pasien','petugas'));
    }

    public function index_rawat_jalan()
    {
        $data_sakit = DataSakit::where('status_pasien', 'Rawat Jalan')->paginate(10);
        $pasien = Pasien::all();
        $petugas = Petugas::all();
        return view('status-pasien.rawat-jalan', compact('data_sakit', 'pasien','petugas'));
    }

    public function index_dirujuk()
    {
        $data_sakit = DataSakit::where('status_pasien', 'Dirujuk')->paginate(10);
        $pasien = Pasien::all();
        $petugas = Petugas::all();
        return view('status-pasien.dirujuk', compact('data_sakit', 'pasien','petugas'));
    }

    public function index_sembuh()
    {
        $data_sakit = DataSakit::where('status_pasien', 'Sembuh')->paginate(10);
        $pasien = Pasien::all();
        $petugas = Petugas::all();
        return view('status-pasien.sembuh', compact('data_sakit', 'pasien','petugas'));
    }
}
