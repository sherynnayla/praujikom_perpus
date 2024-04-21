<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Peminjam</th>
            <th>Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Status Peminjaman</th>
        </tr>
    </thead>
    <tbody>
        @foreach($peminjamen as $peminjaman)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $peminjaman->user->username }}</td>
            <td>{{ $peminjaman->books->judul }}</td>
            <td>{{ $peminjaman->tanggal_peminjaman }}</td>
            <td>{{ $peminjaman->tanggal_pengembalian }}</td>
            <td>{{ $peminjaman->status_peminjaman }}</td>
        </tr>
        @endforeach
    </tbody>
            
</table>
