<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\Member;
use App\Models\Pengunjung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $books = Book::all();
        $members = Member::all();
        $borrows = Borrow::all();
        $pengunjungs = Pengunjung::all();
        
        if(Pengunjung::where('tanggal', '=', Carbon::today()->toDateString())->first() === null){
            for($i=0; $i<7; $i++){
                $a = (Pengunjung::where('tanggal', '=', Carbon::today()->startOfWeek()->addDays($i)->toDateString())
                            ->first());
                $b = $a===null;
                if($b){
                    $a = Pengunjung::create(['tanggal'=>Carbon::today()->startOfWeek()->addDays($i),'jmlpengunjung'=>0]);
                }
            }
        }

        $pengunjungtoday = (Pengunjung::select('jmlpengunjung')
            ->where('tanggal', '=', Carbon::today()->toDateString())
            ->first());

        
        
        $pengunjungthisweek = (Pengunjung::whereBetween('tanggal', [Carbon::today()->startOfWeek(), Carbon::today()->endOfWeek()])
            ->get());

        $jsonpengunjung = (Pengunjung::select('jmlpengunjung as y', 'tanggal as x')
        ->whereBetween('tanggal', [Carbon::today()->startofWeek(), Carbon::today()->endOfWeek()])
        ->orderBy('tanggal')->pluck('y', 'x'))->values()->toArray();

        $jsonpinjaman = (Pengunjung::select('jmlpinjam as y', 'tanggal as x')
        ->whereBetween('tanggal', [Carbon::today()->startofWeek(), Carbon::today()->endOfWeek()])
        ->orderBy('tanggal')->pluck('y', 'x'))->values()->toArray();
        // dd($jsonpinjaman);

        return view('admin.dashboard',[
            'thisweekpengunjung' => $jsonpengunjung,
            'thisweekpinjam' => $jsonpinjaman
        ], compact('books', 'members', 'borrows', 'pengunjungs', 'pengunjungtoday','pengunjungthisweek', 'jsonpengunjung'));
    }
}
