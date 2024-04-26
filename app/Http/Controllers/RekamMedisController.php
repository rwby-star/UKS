<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\RekamMedis;
use App\Models\DataSakit;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    public function index()
    {
        $pasien = Pasien::orderBy('id','desc')->paginate(10);
        $data_sakit = DataSakit::all();
        return view('rekam-medis.index', compact('data_sakit', 'pasien'));
    }

    public function detail($id_pasien)
    {
        $detail = [];
        $idpasien = Pasien::find($id_pasien);
        $data_sakit= DataSakit::where('id_pasien', $id_pasien)->first();

        if($data_sakit){
            $detail = DataSakit::where('id_pasien',$data_sakit->id_pasien)->get();
        }
        return view('rekam-medis.detail', compact('detail','data_sakit','idpasien'));
    }

    public function print($id_pasien)
    {
        $detail = [];
        $data_sakit= DataSakit::where('id_pasien', $id_pasien)->first();

        if($data_sakit){
            $detail = DataSakit::where('id_pasien',$data_sakit->id_pasien)->get();
        }
        return view('rekam-medis.print', compact('detail','data_sakit'));
    }

    public function search(Request $request)
    {
        $keyword = $request->search;
        $pasien = Pasien::where('nama_pasien', 'like', "%" . $keyword . "%")->paginate(5);
        return view('rekam-medis.index', compact('pasien'));
    }
}
