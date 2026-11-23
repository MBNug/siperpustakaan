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
            <th>Telat (Hari)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($borrows as $borrow)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $borrow->kode_buku }}</td>
            <td>{{ optional($borrow->book)->judul ?? '-' }}</td>
            <td>{{ $borrow->nispeminjam }}</td>
            <td>{{ optional($borrow->member)->nama ?? '-' }}</td>
            <td>{{ $borrow->tanggalpinjam }}</td>
            <td>{{ $borrow->tanggalwajibkembali }}</td>
            @if ($borrow->tanggalkembali === null)
                <td>Belum dikembalikan</td>
                @php
                    $telat = max(0, \Carbon\Carbon::parse($borrow->tanggalwajibkembali)->startOfDay()->diffInDays(\Carbon\Carbon::today(), false));
                @endphp
                <td>{{ $telat }}</td>
            @else
                <td>{{ $borrow->tanggalkembali }}</td>
                <td>{{ max(0, (int) $borrow->telat) }}</td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
