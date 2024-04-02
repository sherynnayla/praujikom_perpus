@extends('layout')

@section('title', 'Dashboard')

@section('content')
<form method="POST" action="{{route('categoryStore')}}">
    @csrf
    @method('POST')
    <div class="form-group">
        <label for="exampleInputEmail1">Category</label>
        <input type="text" name="nama_kategori" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
