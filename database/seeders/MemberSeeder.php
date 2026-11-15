<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            [
                'nis' => 'DKP001',
                'nama' => 'Bagas Nugroho',
                'alamat' => 'Jl. Prof. Soedarto No. 12, Tembalang, Semarang',
                'jmlkunjungan' => 24,
            ],
            [
                'nis' => 'DKP002',
                'nama' => 'Siti Nurhaliza',
                'alamat' => 'Jl. Banjarsari Selatan No. 8, Semarang',
                'jmlkunjungan' => 21,
            ],
            [
                'nis' => 'DKP003',
                'nama' => 'Dimas Pratama',
                'alamat' => 'Jl. Sirojudin No. 45, Tembalang, Semarang',
                'jmlkunjungan' => 15,
            ],
            [
                'nis' => 'DKP004',
                'nama' => 'Aulia Rahmawati',
                'alamat' => 'Jl. Gondang Timur II No. 3, Semarang',
                'jmlkunjungan' => 12,
            ],
            [
                'nis' => 'DKP005',
                'nama' => 'Fajar Setiawan',
                'alamat' => 'Jl. Mulawarman Raya No. 19, Banyumanik, Semarang',
                'jmlkunjungan' => 9,
            ],
            [
                'nis' => 'DKP006',
                'nama' => 'Nabila Putri',
                'alamat' => 'Jl. Durian Raya No. 27, Banyumanik, Semarang',
                'jmlkunjungan' => 18,
            ],
            [
                'nis' => 'DKP007',
                'nama' => 'Rizky Ramadhan',
                'alamat' => 'Jl. Tirto Agung No. 5, Tembalang, Semarang',
                'jmlkunjungan' => 7,
            ],
            [
                'nis' => 'DKP008',
                'nama' => 'Citra Maharani',
                'alamat' => 'Jl. Bukit Sari No. 14, Banyumanik, Semarang',
                'jmlkunjungan' => 11,
            ],
        ];

        foreach ($records as $record) {
            Member::firstOrCreate(['nis' => $record['nis']], $record);
        }
    }
}
