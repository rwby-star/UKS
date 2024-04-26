<?php

namespace App\Imports;

use App\Models\RiwayatPenyakit;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RiwayatPenyakitImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new RiwayatPenyakit([
            'nama'     => $row['nama'],
            'tanggal_lahir'   => $row['tanggal_lahir'],
            'jenis_kelamin'   => $row['jenis_kelamin'],
            'tahun_ajaran'           => $row['tahun_ajaran'],
            'id_jabatan'      => $row['id_jabatan'],
            'riwayat_penyakit'      => $row['riwayat_penyakit'],
            'kategori_penyakit'      => $row['kategori_penyakit'],
        ]);
    }
}
