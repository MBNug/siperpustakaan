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
        $borrows = Borrow::with(['book', 'member'])->get();
        $pengunjungs = Pengunjung::all();
        
        $today = Carbon::today();
        $pengunjungtoday = Pengunjung::firstOrCreate(
            ['tanggal' => $today->toDateString()],
            ['jmlpengunjung' => 0, 'jmlpinjam' => 0]
        );

        $pengunjungthisweek = Pengunjung::whereBetween('tanggal', [$today->copy()->startOfWeek()->toDateString(), $today->copy()->endOfWeek()->toDateString()])
            ->get();

        $jsonpengunjung = Pengunjung::select('jmlpengunjung as y', 'tanggal as x')
            ->whereBetween('tanggal', [$today->copy()->startOfWeek()->toDateString(), $today->copy()->endOfWeek()->toDateString()])
            ->orderBy('tanggal')
            ->pluck('y', 'x')
            ->values()
            ->toArray();

        $jsonpinjaman = Pengunjung::select('jmlpinjam as y', 'tanggal as x')
            ->whereBetween('tanggal', [$today->copy()->startOfWeek()->toDateString(), $today->copy()->endOfWeek()->toDateString()])
            ->orderBy('tanggal')
            ->pluck('y', 'x')
            ->values()
            ->toArray();

        $activeBorrows = $borrows->whereNull('tanggalkembali');
        $overdueBorrows = $activeBorrows->filter(function ($item) use ($today) {
            return Carbon::parse($item->tanggalwajibkembali)->lt($today);
        });

        return view('admin.dashboard', [
            'thisweekpengunjung' => $jsonpengunjung,
            'thisweekpinjam' => $jsonpinjaman,
        ], compact('books', 'members', 'borrows', 'pengunjungs', 'pengunjungtoday', 'pengunjungthisweek', 'jsonpengunjung', 'activeBorrows', 'overdueBorrows'));
    }
}
