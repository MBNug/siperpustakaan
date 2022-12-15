<?php

namespace Database\Seeders;

use App\Models\Borrow;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        //
        
        $records = [
            [
                'id' => 1,
                'kode_buku' => 'TEK000001',
                'nispeminjam' => 'DKP001',
                'tanggalpinjam' => Carbon::parse('2022-05-24'),
                'tanggalwajibkembali' => Carbon::parse('2022-05-31'),
                'tanggalkembali'=>Carbon::parse('2022-05-30'),
                'telat' => 0,
            ],
            [
                'id' => 2,
                'kode_buku' => 'TEK000004',
                'nispeminjam' => 'DKP002',
                'tanggalpinjam' => Carbon::parse('2022-06-01'),
                'tanggalwajibkembali' => Carbon::parse('2022-06-8'),
                'tanggalkembali'=>Carbon::parse('2022-06-10'),
                'telat' => 2,
                
            ],
            [
                'id' => 3,
                'kode_buku' => 'TEK000004',
                'nispeminjam' => 'DKP002',
                'tanggalpinjam' => Carbon::parse('2022-12-08'),
                'tanggalwajibkembali' => Carbon::parse('2022-12-15'),
                
            ],
            [
                'id' => 4,
                'kode_buku' => 'BHS000001',
                'nispeminjam' => 'DKP003',
                'tanggalpinjam' => Carbon::parse('2022-12-01'),
                'tanggalwajibkembali' => Carbon::parse('2022-12-08'),

            ],
            [
                'id' => 5,
                'kode_buku' => 'TEK000001',
                'nispeminjam' => 'DKP003',
                'tanggalpinjam' => Carbon::parse('2022-05-24'),
                'tanggalwajibkembali' => Carbon::parse('2022-05-31'),
            ],
            [
                'id' => 6,
                'kode_buku' => 'TEK000004',
                'nispeminjam' => 'DKP004',
                'tanggalpinjam' => Carbon::parse('2022-06-01'),
                'tanggalwajibkembali' => Carbon::parse('2022-06-8'),
                
            ],
            
        ];
        foreach ($records as $record) {
            $borrow = new Borrow();
            $borrow->firstOrCreate($record);
        }
        
    }
}
