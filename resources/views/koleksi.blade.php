@extends('layout')

@section('title', 'Koleksi')

@section('content')

<div style="margin-left: 20px;">
    @php
    $collectionChunks = $koleksi->chunk(2); // Chunk the collection into groups of 2
    @endphp

    @foreach($collectionChunks as $collectionChunk)
    <div class="row">
        @foreach($collectionChunk as $item)
        <div class="col-md-6 mb-1">
            <div class="card" style="width: 100%;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="{{ asset('uploads/' . $item->books->gambar) }}" class="card-img-top" alt="" style="max-width: 100%; height: auto;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><b>{{$item->books->judul}}</b></h5>
                            <p class="card-text">{{$item->books->penulis}} | {{$item->books->penerbit}}</p>
                            <p class="card-text">
                                <small class="text-muted">
                                    @if ($categories !== null)
                                    @foreach($item->books->categories as $kategoribuku)
                                    {{ $kategoribuku->nama_kategori}}
                                    @endforeach
                                    @endif
                                </small>
                            </p>
                            <div class="d-flex justify-content align-items-center">
                                @if(auth()->check())
                                @php
                                $userCollection = auth()->user()->peminjamen;
                                @endphp
                                @if($userCollection && $userCollection->contains('buku_id', $item->books->id))
                                @if($userCollection->where('buku_id', $item->books->id)->first()->status_peminjaman == 'Dipinjam')
                                <button class="btn btn-primary btn-sm" style="background-color:blue; margin-right: 0;" disabled>Dipinjam</button>
                                @else
                                <button class="btn btn-primary btn-sm" style="background-color:green; margin-right: 0;">Pinjam</button>
                                @endif
                                @else
                                <form action="{{ route('pinjam.store', ['books' => $item->books->id]) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="buku_id" value="{{ $item->books->id }}">
                                    <button type="submit" class="btn btn-primary btn-sm" style="background-color:green;">Pinjam</button>
                                </form>
                                @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach

</div>

@endsection
