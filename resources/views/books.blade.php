@extends('layout')

@section('title', 'Books')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between ">
    <h1 class="h6 m-0 text-gray-800"><i class="fas fa-fw fa-home"><a href="/dashboard"></a></i> | Books</h1>
</div>

@if(Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')

<div class="table" style="margin-top:20px;  border-radius:10px;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.11);">
    <div class="mt-5 d-flex justify-content-end">
        <a href="/add-books" class="btn btn-primary" style="background-color:blue; margin:20px; ">Add book</a>
    </div>



    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr style="color:grey; font-size:13px;">
                        <th scope="col">No</th>
                        <th scope="col">Cover</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Penulis</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col">Tahun Terbit</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td style="max-width: 80px; max-height: 80px;"><img src="{{ asset('uploads/' . $book->gambar) }}" class="img-fluid" alt="" style="max-width: 80%; max-height: 80%;"></td>

                        <td>{{$book->judul}}</td>
                        <td>{{$book->penulis}}</td>
                        <td>{{$book->penerbit}}</td>
                        <td>{{$book->tahun_terbit}}</td>

                        <td>
                            @if ($categories !== null)
                            @foreach($book->categories as $kategoribuku)
                            {{ $kategoribuku->nama_kategori}}
                            @endforeach
                            @endif
                        </td>
                        <td>
                            <div class=" d-flex flex-row w-75 ">
                                <a href=" /edit-books/{{ $book->id }}" class="btn btn-warning btn-sm mr-2" style="height: 30px;">Edit</a>
                                <form action="/delete-books/{{ $book->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@else

<div style="margin-left: 20px;">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(Session::get('success'))
    <div class="alert alert-success w-80 mt-3">
        {{ Session::get('success')}}
    </div>
    @endif

    @if(Session::get('ulasan'))
    <div class="alert alert-success w-80 mt-3">
        {{ Session::get('ulasan')}}
    </div>
    @endif

    @if(Session::get('accessError'))
    <div class="alert alert-danger w-80">
        {{ Session::get('accessError')}}
    </div>
    @endif
    @foreach($books->chunk(2) as $chunk)
    <div class="row">
        @foreach($chunk as $book)
        <div class="col-md-6 mb-1">
            <div class="card" style="width: 100%;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="{{ asset('uploads/' . $book->gambar) }}" class="card-img-top img-fluid" alt="{{ $book->judul }}">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><b>{{$book->judul}}</b></h5>
                            <p class="card-text">{{$book->penulis}} | {{$book->penerbit}}</p>
                            <p class="card-text">
                                <small class="text-muted">
                                    @if ($categories !== null)
                                    @foreach($book->categories as $kategoribuku)
                                    {{ $kategoribuku->nama_kategori}}
                                    @endforeach
                                    @endif
                                </small>
                            </p>

                            <div class="d-flex justify-content align-items-center">
                                <form action="{{ route('koleksi.tambah', ['book' => $book->id]) }}" method="POST" style="margin-right: 0;">
                                    @csrf
                                    <input type="hidden" name="buku_id" value="{{ $book->id }}">
                                    <button type="submit" class="btn btn-info btn-sm mr-2">Koleksi</button>
                                </form>

                                @if(auth()->check())
                                {{-- Jika user sudah login, tampilkan tombol Pinjam --}}
                                <form action="{{ route('pinjam.store', ['books' => $book->id]) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="buku_id" value="{{ $book->id }}">
                                    <button type="submit" class="btn btn-primary btn-sm mr-2">Pinjam</button>
                                </form>

                                {{-- Tampilkan tombol Ulasan jika buku pernah dipinjam --}}
                                @php
                                $userPeminjaman = auth()->user()->peminjamen->where('buku_id', $book->id)->first();
                                @endphp
                                @if($userPeminjaman && $userPeminjaman->status_peminjaman == 'Dikembalikan')
                                <a href="{{ route('ulasan.create', ['bookId' => $book->id]) }}" class="btn btn-primary btn-sm" style="background-color:green">Ulasan</a>
                                @endif
                                @endif







                            </div>

                            <a href="{{ route('ulasan.show', ['bookId' => $book->id]) }}">Lihat Ulasan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach
</div>

@endif

@endsection
