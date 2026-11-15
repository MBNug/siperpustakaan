<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\Member;
use App\Libraries\Fungsi;
use App\Models\Pengunjung;
use Illuminate\Http\Request;
use App\Exports\BorrowExport;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreBorrowRequest;
use App\Http\Requests\UpdateBorrowRequest;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $borrows = Borrow::all();

        return view('borrow.index', compact('borrows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $books = Book::all();
        $members = Member::all();
        return view('borrow.create', compact('books', 'members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBorrowRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        
        $books = Book::where('kode', '=', $request->kode_buku)->first();
        $members = Member::where('nis', '=', $request->nispeminjam)->first();
        // dd($books);
        if($books ===null | $members===null){
            Fungsi::sweetalert('NIS atau Kode Buku tidak terdaftar', 'error', 'MAAF!');
            return redirect(route('borrow'));
        }
        else{

            if($books->dipinjam === $books->jumlah){
                Fungsi::sweetalert('Tidak ada buku yang tersedia', 'error', 'MAAF!');
                return redirect(route('borrow'));
            }
            elseif($request->tanggalpinjam > $request->tanggalwajibkembali){
                Fungsi::sweetalert('Tanggal pinjam dan tanggal kembali tidak benar', 'error', 'MAAF!');
                return redirect(route('borrow'));
            }
            else{
                $validated = $request->validate([
                    'kode_buku' => 'required',
                    'nispeminjam' => 'required',
                    'tanggalpinjam' => 'required',
                    'tanggalwajibkembali' => 'required',
                ]);
        
                $borrow = Borrow::create($validated);
                $book = Book::find($borrow->book->id);
                $book->dipinjam = $book->dipinjam + 1;
                $book->save();

                $a = Pengunjung::where('tanggal', '=', $request->tanggalpinjam)->first();
                if ($a) {
                    $a->jmlpinjam += 1;
                    $a->save();
                }
                Fungsi::sweetalert('Berhasil menambahkan peminjaman baru', 'success', 'Berhasil!');
                return redirect(route('borrow'));
            }
            
        }
        

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function show(Borrow $borrow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function edit(Borrow $borrow)
    {
        //
        // @dd($borrow);
        $books = Book::all();
        $members = Member::all();
        return view('borrow.edit', compact('borrow', 'books', 'members'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBorrowRequest  $request
     * @param  \App\Models\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Borrow $borrow)
    {
        $validated = $request->validate([
            'kode_buku' => 'required',
            'nispeminjam' => 'required',
            'tanggalpinjam' => 'required',
            'tanggalwajibkembali' => 'required',
            'tanggalkembali' => 'nullable|date',
        ]);

        $selisih = 0;
        if ($request->tanggalkembali !== null) {
            $kembali = Carbon::parse($request->tanggalkembali);
            $wajibkembali = Carbon::parse($request->tanggalwajibkembali);
            $selisih = $wajibkembali->diffInDays($kembali, false);
            if ($selisih < 0) {
                $selisih = 0;
            }
        }

        $borrow->update($validated);
        $borrow->telat = $selisih;
        $borrow->save();
        Fungsi::sweetalert('Peminjaman berhasil diupdate', 'success', 'Berhasil!');
        return redirect(route('borrow'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        $borrow = Borrow::findOrFail($id);
        return view('borrow.delete', compact('borrow'));

    }
    public function destroy($id){
        $borrow = Borrow::findOrFail($id);
        $dikembalikan = $borrow->tanggalkembali;
        if($dikembalikan === null){
            $book = Book::find($borrow->book->id);
            $book->dipinjam = $book->dipinjam - 1;
            $book->save();
        }
        $borrow->delete();
        Fungsi::sweetalert('Peminjaman berhasil dihapus', 'success', 'Berhasil!');
        return redirect()->route('borrow');
    }

    public function kembalikan(Request $request, $id)
    {
        $borrow = Borrow::findOrFail($id);
        $borrow->tanggalkembali = Carbon::now();
        $kembali = Carbon::parse($borrow->tanggalkembali);
        $wajibkembali = Carbon::parse($borrow->tanggalwajibkembali);
        $selisih = $wajibkembali->diffInDays($kembali, false);

        if($selisih < 0){
            $selisih = 0;
        }

        $borrow->telat = $selisih;
        $borrow->save();

        $book =Book::findorFail($borrow->book->id);
        $book->dipinjam = $book->dipinjam - 1;
        $book->save();
        Fungsi::sweetalert('Buku berhasil dikembalikan', 'success', 'Berhasil!');
        return redirect()->route('borrow');
        
    }

    public function export_excel()
	{
		return Excel::download(new BorrowExport, 'borrows.xlsx');
	}
}
