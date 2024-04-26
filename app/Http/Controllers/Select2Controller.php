<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Select2Controller extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function loadData(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Pasien::where('nama_pasien', 'LIKE', '%'. $query. '%')->get();
        return response()->json($filterResult);
    }
}
