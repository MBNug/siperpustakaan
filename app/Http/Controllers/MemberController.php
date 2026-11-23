<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Libraries\Fungsi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Book;
use App\Models\Borrow;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $members = Member::all();
        $borrows = Borrow::all();
        return view('member.index', compact('members', 'borrows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMemberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|unique:members|max:255',
            'nama' => 'required',
            'alamat' => 'required',
        ]);

        Member::create($validated);

        Fungsi::sweetalert('Berhasil menambahkan anggota baru', 'success', 'Berhasil!');
        return redirect(route('member'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        //
        return view('member.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMemberRequest  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'nis' => ['required', 'string', 'max:255', Rule::unique('members')->ignore($member->id)],
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'jmlkunjungan' => 'required|integer|min:0',
        ]);

        $member->update($validated);
        Fungsi::sweetalert('Data anggota berhasil diupdate', 'success', 'Berhasil!');
        return redirect(route('member'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        $member = Member::findOrFail($id);
        return view('member.delete', compact('member'));

    }
    public function destroy($id){
        $member = Member::findOrFail($id);
        $hasActiveBorrow = Borrow::where('nispeminjam', $member->nis)->whereNull('tanggalkembali')->exists();
        if ($hasActiveBorrow) {
            Fungsi::sweetalert('Anggota masih memiliki peminjaman buku yang belum dikembalikan.', 'error', 'Gagal!');
            return redirect()->route('member');
        }
        $member->delete();
        Fungsi::sweetalert('Anggota berhasil dihapus', 'success', 'Berhasil!');
        return redirect()->route('member');
    }


    public function lihatpinjaman($id){
        $member = Member::findOrFail($id);
        $borrow = Borrow::with('book')->where('nispeminjam', '=', $member->nis)->latest('id')->get();
        return view('member.lihatpinjaman', compact('borrow', 'member'));
    }
}
