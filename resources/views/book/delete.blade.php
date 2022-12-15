{{-- !-- Delete Warning Modal -->  --}}
<form action="{{ route('book.destroy', $book->id) }}" method="POST">
    <div class="modal-body">
        @csrf
        @method('DELETE')
        <h5 class="text-center">Apakah anda yakin menghapus buku ini?</h5>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        <button type="submit" class="btn btn-danger">Ya, hapus</button>
    </div>
</form>