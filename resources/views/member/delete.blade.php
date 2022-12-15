{{-- !-- Delete Warning Modal -->  --}}
<form action="{{ route('member.destroy', $member->id) }}" method="POST">
    <div class="modal-body">
        @csrf
        @method('DELETE')
        <h5 class="text-center">Apakah anda yakin menghapus anggota ini?</h5>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary center" data-dismiss="modal">Kembali</button>
        <button type="submit" class="btn btn-danger center">Ya, hapus</button>
    </div>
</form>