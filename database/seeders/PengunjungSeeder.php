<?php

namespace Database\Seeders;

use App\Models\Pengunjung;
use Carbon\Carbon;
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
        $today = Carbon::today();
        $startDate = $today->copy()->startOfWeek()->subDays(7);
        $visitorPattern = [18, 24, 21, 29, 25, 14, 10, 22, 27, 31, 26, 33, 19, 16];
        $borrowPattern = [2, 4, 3, 5, 3, 1, 0, 3, 4, 6, 3, 5, 2, 1];

        $offset = 0;
        for ($date = $startDate->copy(); $date->lte($today); $date->addDay()) {
            $idx = $offset % count($visitorPattern);
            Pengunjung::firstOrCreate(
                ['tanggal' => $date->toDateString()],
                [
                    'jmlpengunjung' => $visitorPattern[$idx],
                    'jmlpinjam' => $borrowPattern[$idx],
                ]
            );
            $offset++;
        }
    }
}
