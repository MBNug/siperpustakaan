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
use Illuminate\Support\Facades\DB;
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
        $borrows = Borrow::with(['book', 'member'])->latest('id')->get();

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
        $validated = $request->validate([
            'kode_buku' => 'required|string',
            'nispeminjam' => 'required|string',
            'tanggalpinjam' => 'required|date',
            'tanggalwajibkembali' => 'required|date|after_or_equal:tanggalpinjam',
        ]);

        $books = Book::where('kode', '=', $validated['kode_buku'])->first();
        $members = Member::where('nis', '=', $validated['nispeminjam'])->first();

        if ($books === null || $members === null) {
            Fungsi::sweetalert('NIS atau Kode Buku tidak terdaftar', 'error', 'Maaf!');
            return redirect()->back()->withInput();
        }

        if ($books->dipinjam >= $books->jumlah) {
            Fungsi::sweetalert('Stok buku sedang kosong (semua sedang dipinjam)', 'error', 'Maaf!');
            return redirect()->back()->withInput();
        }

        DB::transaction(function () use ($validated, $books) {
            Borrow::create($validated);
            $books->increment('dipinjam');

            $pengunjung = Pengunjung::firstOrCreate(
                ['tanggal' => Carbon::parse($validated['tanggalpinjam'])->toDateString()],
                ['jmlpengunjung' => 0, 'jmlpinjam' => 0]
            );
            $pengunjung->increment('jmlpinjam');
        });

        Fungsi::sweetalert('Berhasil menambahkan peminjaman baru', 'success', 'Berhasil!');
        return redirect(route('borrow'));
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
            'kode_buku' => 'required|exists:books,kode',
            'nispeminjam' => 'required|exists:members,nis',
            'tanggalpinjam' => 'required|date',
            'tanggalwajibkembali' => 'required|date|after_or_equal:tanggalpinjam',
            'tanggalkembali' => 'nullable|date|after_or_equal:tanggalpinjam',
        ]);

        $selisih = 0;
        if (!empty($validated['tanggalkembali'])) {
            $kembali = Carbon::parse($validated['tanggalkembali'])->startOfDay();
            $wajibkembali = Carbon::parse($validated['tanggalwajibkembali'])->startOfDay();
            $selisih = max(0, $wajibkembali->diffInDays($kembali, false));
        }

        $wasReturned = ($borrow->tanggalkembali !== null);
        $isNowReturned = !empty($validated['tanggalkembali']);
        $oldBookKode = $borrow->kode_buku;
        $newBookKode = $validated['kode_buku'];

        DB::transaction(function () use ($borrow, $validated, $selisih, $wasReturned, $isNowReturned, $oldBookKode, $newBookKode) {
            if (!$wasReturned && $oldBookKode !== $newBookKode) {
                $oldBook = Book::where('kode', $oldBookKode)->first();
                if ($oldBook && $oldBook->dipinjam > 0) {
                    $oldBook->decrement('dipinjam');
                }
                if (!$isNowReturned) {
                    $newBook = Book::where('kode', $newBookKode)->first();
                    if ($newBook && $newBook->dipinjam < $newBook->jumlah) {
                        $newBook->increment('dipinjam');
                    }
                }
            } elseif (!$wasReturned && $isNowReturned) {
                $book = Book::where('kode', $newBookKode)->first();
                if ($book && $book->dipinjam > 0) {
                    $book->decrement('dipinjam');
                }
            } elseif ($wasReturned && !$isNowReturned) {
                $book = Book::where('kode', $newBookKode)->first();
                if ($book && $book->dipinjam < $book->jumlah) {
                    $book->increment('dipinjam');
                }
            }

            $borrow->update($validated);
            $borrow->telat = $selisih;
            $borrow->save();
        });

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
        DB::transaction(function () use ($borrow) {
            if ($borrow->tanggalkembali === null && $borrow->book && $borrow->book->dipinjam > 0) {
                $borrow->book->decrement('dipinjam');
            }
            $borrow->delete();
        });
        Fungsi::sweetalert('Peminjaman berhasil dihapus', 'success', 'Berhasil!');
        return redirect()->route('borrow');
    }

    public function kembalikan(Request $request, $id)
    {
        $borrow = Borrow::findOrFail($id);
        if ($borrow->tanggalkembali !== null) {
            Fungsi::sweetalert('Buku ini sudah dikembalikan sebelumnya.', 'info', 'Info');
            return redirect()->route('borrow');
        }

        DB::transaction(function () use ($borrow) {
            $kembali = Carbon::today();
            $wajibkembali = Carbon::parse($borrow->tanggalwajibkembali)->startOfDay();
            $selisih = max(0, $wajibkembali->diffInDays($kembali, false));

            $borrow->tanggalkembali = $kembali;
            $borrow->telat = $selisih;
            $borrow->save();

            if ($borrow->book && $borrow->book->dipinjam > 0) {
                $borrow->book->decrement('dipinjam');
            }
        });

        Fungsi::sweetalert('Buku berhasil dikembalikan', 'success', 'Berhasil!');
        return redirect()->route('borrow');
    }

    public function export_excel()
	{
		return Excel::download(new BorrowExport, 'borrows.xlsx');
	}
}
