<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Libraries\Fungsi;
use App\Models\Member;
use App\Models\Pengunjung;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $todayStats = Pengunjung::firstOrCreate(
            ['tanggal' => Carbon::today()->toDateString()],
            ['jmlpengunjung' => 0, 'jmlpinjam' => 0]
        );

        $members = Member::orderBy('nama')->get();
        $totalBooks = Book::sum('jumlah');

        return view('home', compact('members', 'todayStats', 'totalBooks'));
    }

    public function redirect()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('home');
    }

    public function hadir(Request $request)
    {
        $request->validate([
            'nis' => ['required', 'string', 'max:255'],
        ]);

        $nis = trim((string) $request->input('nis'));
        $member = Member::where('nis', '=', $nis)->first();

        if ($member === null) {
            Fungsi::sweetalert('NIS tidak terdaftar!', 'error', 'Gagal!');
            return redirect()->route('home')->withInput();
        }

        $todayStats = Pengunjung::firstOrCreate(
            ['tanggal' => Carbon::today()->toDateString()],
            ['jmlpengunjung' => 0, 'jmlpinjam' => 0]
        );
        $todayStats->increment('jmlpengunjung');
        $member->increment('jmlkunjungan');

        Fungsi::sweetalert('Selamat datang, '.$member->nama.'! Kehadiran tercatat.', 'success', 'Berhasil!');
        return redirect()->route('home');
    }
    
}
