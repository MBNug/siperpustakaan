<table>
    <thead>
        <tr>
            <th scope="col">#</th>
            <th>Kode Buku</th>
            <th>Judul</th>
            <th>NIS</th>
            <th>Nama Peminjam</th>
            <th>Tanggal dipinjam</th>
            <th>Tanggal harus kembali</th>
            <th>Tanggal kembali</th>
            <th>Telat</th>
        </tr>
    </thead>
    <tbody>
        @foreach($borrows as $borrow)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $borrow->kode_buku }}</td>
            <td>{{ $borrow->book->judul }}</td>
            <td>{{ $borrow->nispeminjam }}</td>
            <td>{{ $borrow->member->nama }}</td>
            <td>{{ $borrow->tanggalpinjam }}</td>
            <td>{{ $borrow->tanggalwajibkembali }}</td>
            @if ($borrow->tanggalkembali === null)
                <td>Belum dikembalikan</td>
                @php
                    $telat = \Carbon\Carbon::parse($borrow->tanggalwajibkembali)->diffInDays(\Carbon\Carbon::parse(now()), false);
                @endphp
                @if ($telat < 0)
                    <td>0</td>
                @else
                    <td>{{ $telat }}</td>
                @endif
            @else
                <td>{{ $borrow->tanggalkembali }}</td>
                <td>{{ $borrow->telat }}</td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>