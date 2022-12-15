{{-- !-- Delete Warning Modal -->  --}}
<form action="{{ route('borrow.destroy', $borrow->id) }}" method="POST">
    <div class="modal-body">
        @csrf
        @method('DELETE')
        <h5 class="text-center">Apakah anda yakin menghapus peminjaman ini? 
            <br>Ini juga akan mengurangi jumlah dipinjam dibagian kelola buku</h5>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary center" data-dismiss="modal">Kembali</button>
        <button type="submit" class="btn btn-danger center">Ya, hapus</button>
    </div>
</form>