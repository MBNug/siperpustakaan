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
        $validated = $request->validate([
            'kode' => 'required|string|unique:books|max:255',
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'terbit' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'kategori' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
        ]);

        Book::create($validated);

        Fungsi::sweetalert('Buku berhasil ditambahkan', 'success', 'Berhasil!');
        return redirect(route('book'));
    }
    public function show(Book $book)
    {
        return redirect()->route('book.edit', $book->id);
    }

    public function edit(Book $book)
    {
        return view('book.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'kode' => ['required', 'string', 'max:255', Rule::unique('books')->ignore($book->id)],
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'terbit' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'kategori' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
            'dipinjam' => 'required|integer|min:0|lte:jumlah',
        ]);

        $book->update($validated);
        Fungsi::sweetalert('Buku berhasil diupdate', 'success', 'Berhasil!');
        return redirect(route('book'));
    }

    
    public function delete($id){
        $book = Book::findOrFail($id);
        return view('book.delete', compact('book'));

    }
    public function destroy($id){
        $book = Book::findOrFail($id);
        if ($book->dipinjam > 0) {
            Fungsi::sweetalert('Buku tidak dapat dihapus karena masih ada salinan yang sedang dipinjam.', 'error', 'Gagal!');
            return redirect()->route('book');
        }
        $book->delete();
        Fungsi::sweetalert('Buku berhasil dihapus', 'success', 'Berhasil!');
        return redirect()->route('book');
    }
}
