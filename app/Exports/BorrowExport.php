<?php

namespace App\Exports;

use App\Models\Borrow;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;

class BorrowExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function headings(): array
    // {
    //     return [
    //         'id',
    //         'Kode Buku',
    //         'Judul Buku',
    //         'NIS',
    //         'Nama Peminjam',
    //         'Tanggal Pinjam',
    //         'Tanggal Harus Kembali',
    //         'Tanggal Kembali',
    //         'Telat'
    //     ];
    // }
    
    public function view(): View
    {
        return view('borrow.export',[
            'borrows' => Borrow::all()
        ]);
    }
}
