<?php

namespace Database\Seeders;

use App\Models\Borrow;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BorrowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = Carbon::today();

        $records = [
            [
                'kode_buku' => 'TEK000002',
                'nispeminjam' => 'DKP001',
                'tanggalpinjam' => $today->copy()->subDays(12),
                'tanggalwajibkembali' => $today->copy()->subDays(5),
                'tanggalkembali' => $today->copy()->subDays(6),
                'telat' => 0,
            ],
            [
                'kode_buku' => 'SNG000001',
                'nispeminjam' => 'DKP002',
                'tanggalpinjam' => $today->copy()->subDays(14),
                'tanggalwajibkembali' => $today->copy()->subDays(7),
                'tanggalkembali' => $today->copy()->subDays(5),
                'telat' => 2,
            ],
            [
                'kode_buku' => 'SOS000001',
                'nispeminjam' => 'DKP005',
                'tanggalpinjam' => $today->copy()->subDays(9),
                'tanggalwajibkembali' => $today->copy()->subDays(2),
                'tanggalkembali' => $today->copy()->subDays(3),
                'telat' => 0,
            ],
            [
                'kode_buku' => 'TEK000001',
                'nispeminjam' => 'DKP001',
                'tanggalpinjam' => $today->copy()->subDays(3),
                'tanggalwajibkembali' => $today->copy()->addDays(4),
                'tanggalkembali' => null,
                'telat' => 0,
            ],
            [
                'kode_buku' => 'TEK000004',
                'nispeminjam' => 'DKP002',
                'tanggalpinjam' => $today->copy()->subDays(9),
                'tanggalwajibkembali' => $today->copy()->subDays(2),
                'tanggalkembali' => null,
                'telat' => 0,
            ],
            [
                'kode_buku' => 'TEK000004',
                'nispeminjam' => 'DKP006',
                'tanggalpinjam' => $today->copy()->subDays(1),
                'tanggalwajibkembali' => $today->copy()->addDays(6),
                'tanggalkembali' => null,
                'telat' => 0,
            ],
            [
                'kode_buku' => 'BHS000001',
                'nispeminjam' => 'DKP003',
                'tanggalpinjam' => $today->copy()->subDays(2),
                'tanggalwajibkembali' => $today->copy()->addDays(5),
                'tanggalkembali' => null,
                'telat' => 0,
            ],
            [
                'kode_buku' => 'SNS000001',
                'nispeminjam' => 'DKP004',
                'tanggalpinjam' => $today->copy(),
                'tanggalwajibkembali' => $today->copy()->addDays(7),
                'tanggalkembali' => null,
                'telat' => 0,
            ],
        ];

        foreach ($records as $record) {
            Borrow::create($record);
        }
    }
}
