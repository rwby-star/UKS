<?php

namespace App\Imports;

use App\Models\Pasien;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class PasienImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pasien([
            'nama_pasien'     => $row['nama_pasien'],
            'tanggal_lahir'   => $row['tanggal_lahir'],
            'jenis_kelamin'   => $row['jenis_kelamin'],
            'kelas'           => $row['kelas'],
            'id_jabatan'      => $row['id_jabatan']
        ]);
    }
}
