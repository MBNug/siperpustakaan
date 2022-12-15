<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
                'id' => 1,
                'nis' => 'DKP001',
                'nama' => 'Jeje',
                'alamat' => 'Jl. Lumba lumba, Pulosari Pemalang',
                'jmlkunjungan' => 24,
            ],
            [
                'id' => 2,
                'nis' => 'DKP002',
                'nama' => 'Ryan M Tallulah',
                'alamat' => 'Jl. Lumba lumba, Pulosari Pemalang',
                'jmlkunjungan' => 21,
            ],
            [
                'id' => 3,
                'nis' => 'DKP003',
                'nama' => 'Shaun',
                'alamat' => 'Jl. Lumba lumba, Pulosari Pemalang',
                'jmlkunjungan' => 2,
            ],
            [
                'id' => 4,
                'nis' => 'DKP004',
                'nama' => 'Bill Gates',
                'alamat' => 'Jl. Lumba lumba, Pulosari Pemalang',
            ],
        ];
        foreach ($records as $record) {
            $member = new Member();
            $member->firstOrCreate($record);
        }
    }
}
