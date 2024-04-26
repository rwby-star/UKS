<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\RekamMedis;
use App\Models\DataSakit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //count
        $obatcount = Obat::all()->count();
        $pasiencount = DataSakit::all()->count();
        $rawatcount = DataSakit::where('status_pasien', 'Rawat')->count();
        $rujukcount = DataSakit::where('status_pasien', 'Dirujuk')->count();
        $sembuhcount = DataSakit::where('status_pasien', 'Sembuh')->count();
        $rawatjalancount = DataSakit::where('status_pasien', 'Rawat Jalan')->count();

        //table
        $obat = Obat::all()->take(5);
        $data_sakit = DataSakit::orderBy('created_at','desc')->get()->take(5);
        $info = Info::all();
        // $pasien = Pasien::all();

        //nomor
        $i = 1;
        $a = 1;

        //chart

        // //PostgreSQL
        // $pasiens = Pasien::select(DB::raw("COUNT(*) as count"))
        //     ->whereYear('created_at', date('Y'))
        //     ->groupBy(DB::raw("to_char(created_at, 'mm')"))
        //     ->pluck('count');

        // //PostgreSQL
        // $months = Pasien::select(
        //     DB::raw("to_char(created_at, 'mm') as month")
        //     )
        //     ->whereYear('created_at', date('Y'))
        //     ->groupBy(DB::raw("to_char(created_at, 'mm')"))
        //     ->pluck('month');

        // MySQL
        $pasiens = DataSakit::select(DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("month(created_at)"))
            ->pluck('count');

        //MySQL
        $months = DataSakit::select(
            DB::raw("Month(created_at) as month")
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('month');

        //dd($months);
        $datas = [0,0,0,0,0,0,0,0,0,0,0,0];
        foreach ($months as $index => $month)
        {
            $datas[$month - 1] = $pasiens[$index];
        }

        // return dd($datas);

        return view('home', compact(
            'obatcount',
            'pasiencount',
            'rawatcount',
            'rawatjalancount',
            'rujukcount',
            'sembuhcount',
            'obat',
            'data_sakit',
            'info',
            'datas',
            'i',
            'a',
            'pasiens'
        ));
    }
}
