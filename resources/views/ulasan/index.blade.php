@extends('layout')

@section('title', 'Ulasan')

@section('content')

@if(count($ulasans) > 0)
<div class="card-body" style="background-color:white;">
    <div class="row">
        <div class="col-md-5">
            <img src="{{ asset('uploads/' . $ulasans[0]->books->gambar) }}" style="width: 100%" alt="">
            <div class="card-title text-center mt-2">
                <p>{{ $ulasans[0]->books->penerbit }} - {{$ulasans[0]->books->tahun_terbit}}</p>
                <h2>{{$ulasans[0]->books->judul}}</h2>
                <p>{{$ulasans[0]->books->penerbit}}</p>
            </div>
        </div>
        <div class="col-md-4 mt-0">

            <div class="card-body" style="background-color:white;">
                @foreach($ulasans as $ulasan)
                    <div class="mb-4">
                        <h4 class="mb-2">{{ $ulasan->user->username }}</h4>
                        <p>{{ $ulasan->ulasan }}</p>
                        <p>Rating: {{ $ulasan->rating }}</p>
                    </div>
                    <hr>
                @endforeach
            </div>

        </div>
    </div>
</div>
@else
<div class="card-body" style="background-color:white;">
    <div class="row">
        <div class="col-md-5">
            <img src="{{ asset('uploads/' . $book->gambar) }}" style="width: 100%" alt="">
            <div class="card-title text-center mt-2">
                <p>{{ $book->penerbit }} - {{$book->tahun_terbit}}</p>
                <h2>{{$book->judul}}</h2>
                <p>{{$book->penerbit}}</p>
            </div>
        </div>
        <div class="col-md-4 mt-0">
            <!-- Add additional book information here if needed -->
        </div>
    </div>
</div>
@endif

@endsection
