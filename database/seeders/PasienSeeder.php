<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

    	foreach(range(1,20) as $index)
        {
    	      // insert data ke table pegawai menggunakan Faker
    		DB::table('pasien')->insert([
    			'nama_pasien' => $faker->name,
    			'tanggal_lahir' => $faker->date($format = 'Y-m-d', $max = 'now'),
    			'jenis_kelamin' => 'Laki-Laki',
    			'kelas' => 'SMK XII',
                'id_jabatan' => 1,
                'created_at' => $faker->dateTimeBetween($startDate = '-12 month', $endDate = 'now')
    		]);
        }
    }
}
