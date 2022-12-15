<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Libraries\Fungsi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('book.index', compact('books'));
    }

    public function create()
    {
        return view('book.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:books|max:255',
            'judul' => 'required',
            'pengarang' => 'required',
            'terbit' => 'required',
            'kategori' => 'required',
            'jumlah' => 'required',
        ]);

        Book::create($request->all());

        Fungsi::sweetalert('Buku berhasil ditambahkan', 'success', 'Berhasil!');
        return redirect(route('book'));
    }
    public function show(Book $book)
    {
        //
        $book->delete();
        Fungsi::sweetalert('Buku berhasil dihapus', 'success', 'Berhasil!');
        return redirect()->route('book');
    }

    public function edit(Book $book)
    {
        return view('book.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'kode' => ['required', 'max:255', Rule::unique('books')->ignore($book->id)],
            'judul' => 'required',
            'pengarang' => 'required',
            'terbit' => 'required',
            'kategori' => 'required',
            'jumlah' => 'required',
            'dipinjam' => 'required',
        ]);

        $book->update($request->all());
        Fungsi::sweetalert('Buku berhasil diupdate', 'success', 'Berhasil!');
        return redirect(route('book'));
    }

    
    public function delete($id){
        $book = Book::find($id);
        return view('book.delete', compact('book'));

    }
    public function destroy($id){
        // dd($id);
        $book = Book::find($id);
        $book->delete();
        Fungsi::sweetalert('Buku berhasil dihapus', 'success', 'Berhasil!');
        return redirect()->route('book');
    }
}
