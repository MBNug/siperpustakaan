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
        

        for($i=0; $i<7; $i++){
            $a = (Pengunjung::where('tanggal', '=', Carbon::today()->startOfWeek()->addDays($i)->toDateString())
                        ->first());
            $b = $a===null;
            if($b){
                $a = Pengunjung::create(['tanggal'=>Carbon::today()->startOfWeek()->addDays($i),'jmlpengunjung'=>0, 'jmlpinjam'=>0]);
            }
            
        }
        
        
        $members = Member::all();
        return view('home', compact('members'));
    }

    public function redirect()
    {
        $user = User::find(Auth::user()->id);
        if ($user) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('home');
        }
    }

    public function hadir(Request $request)
    {
       
        $request->validate([
            'nis' => ['required'],
        ]);
        

        $a = (Pengunjung::where('tanggal', '=', Carbon::today()->toDateString())
                        ->first());
        $a->jmlpengunjung +=1;
        $a->save();
        $member = Member::where('nis', '=', $request->nis)
                        ->first();
        $member->jmlkunjungan +=1;
        $member->save();
        Fungsi::sweetalert('Berhasil absen!', 'success', 'Berhasil!');
        return redirect()->route('home');
        
    }
    
}
