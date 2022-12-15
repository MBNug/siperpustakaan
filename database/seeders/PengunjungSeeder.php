<?php

namespace Database\Seeders;

use App\Models\Pengunjung;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengunjungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $records = [
            [
                'tanggal' => Carbon::parse('2022-12-03'),
                'jmlpengunjung' => 20,
                'jmlpinjam' => 0
            ],
            [
                'tanggal' => Carbon::parse('2022-12-04'),
                'jmlpengunjung' => 19,
                'jmlpinjam' => 0
            ],
            [
                'tanggal' => Carbon::parse('2022-12-05'),
                'jmlpengunjung' => 21,
                'jmlpinjam' => 0
            ],
            [
                'tanggal' => Carbon::parse('2022-12-06'),
                'jmlpengunjung' => 22,
                'jmlpinjam' => 0
            ],
            [
                'tanggal' => Carbon::parse('2022-12-07'),
                'jmlpengunjung' => 17,
                'jmlpinjam' => 0
            ],
            [
                'tanggal' => Carbon::parse('2022-12-08'),
                'jmlpengunjung' => 25,
                'jmlpinjam' => 1
            ],
            [
                'tanggal' => Carbon::parse('2022-12-09'),
                'jmlpengunjung' => 10,
                'jmlpinjam' => 0
            ],
            
        ];
        foreach ($records as $record) {
            $pengunjung = new Pengunjung();
            $pengunjung->firstOrCreate($record);
        }
    }
}
