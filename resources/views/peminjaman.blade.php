@extends('layout')

@section('title', 'Peminjaman')

@section('content')

@if(Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')

<div class="d-sm-flex align-items-center justify-content-between ">
    <h1 class="h6 m-0 text-gray-800"><i class="fas fa-fw fa-home"><a href="/dashboard"></a></i> | Peminjaman</h1>
</div>


<div class="table" style="margin-top:20px;  border-radius:10px;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.11);">
    
    <div class="mt-5 d-flex justify-content-between">

        <form action="{{ route('peminjamanan.search') }}" method="GET" class="form-inline my-1 my-lg-0">
            <input class="form-control mr-2 ml-sm-2" value="{{request('search')}}"name="search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        
        <form action="{{ route('export.peminjamanan') }}" method="GET">
        @csrf
        <input hidden value="{{request('search')}}" name="search" type="text">
        <button type="submit"class="btn btn-primary" style="background-color:green; margin:20px;">Export Excel</button>
        </form>
        
    </div>



    
    <div class="card-body">
        <table class="table">
            <thead>
                <tr style="color:grey; font-size:13px;">
                    <th scope="col">No</th>
                    <th scope="col">Peminjam</th>
                    <th scope="col">Buku</th>
                    <th scope="col">Tanggal Pinjam</th>
                    <th scope="col">Tanggal Kembali</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjamen as $peminjaman)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{ $peminjaman->user->username }}</td>
                    <td>{{ $peminjaman->books->judul }}</td>
                    <td>{{ $peminjaman->tanggal_peminjaman }}</td>
                    <td>
                        @if($peminjaman->status_peminjaman == 'Dipinjam')
                        -
                        @else
                        {{ $peminjaman->tanggal_pengembalian }}
                        @endif
                    </td>
                    <td>{{ $peminjaman->status_peminjaman }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</div>

@else

<div class="d-sm-flex align-items-center justify-content-between ">
    <h1 class="h6 m-0 text-gray-800"><i class="fas fa-fw fa-home"><a href="/dashboard"></a></i> | Peminjaman</h1>
</div>

<div class="table" style="margin-top:20px;  border-radius:10px;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.11);">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr style="color:grey; font-size:13px;">
                    <th scope="col">No</th>
                    <th scope="col">Peminjam</th>
                    <th scope="col">Buku</th>
                    <th scope="col">Tanggal Pinjam</th>
                    <th scope="col">Tanggal Kembali</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjamen as $peminjaman)
                @php
                $userCollection = auth()->user()->peminjamen;
                $isInCollection = $userCollection->contains('buku_id', $peminjaman->buku_id);
                @endphp
                @if($isInCollection)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $peminjaman->user->username }}</td>
                    <td>{{ $peminjaman->books->judul }}</td>
                    <td>{{ $peminjaman->tanggal_peminjaman }}</td>
                    <td>
                        @if($peminjaman->status_peminjaman == 'Dipinjam')
                        -
                        @else
                        {{ $peminjaman->tanggal_pengembalian }}
                        @endif
                    </td>
                    <td>{{ $peminjaman->status_peminjaman }}</td>
                    <td>
                        @if ($peminjaman->status_peminjaman == 'Dipinjam')
                        <a href="/peminjaman-selesai/{{ $peminjaman->id }}" class="btn btn-primary">Kembalikan</a>
                        @else
                        <button class="btn btn-secondary" disabled>Done</button>
                        @endif
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endif
@endsection
