@extends('layout')

@section('title', 'Dashboard')

@section('content')
<form method="POST" action="/update/{{ $kategoribuku['id'] }}" id="create-form">
    @csrf
    @method('PATCH')
    @if ($errors->any())'
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(Session::get('success'))
    <div class="alert alert-success w-80">
        {{ Session::get('success')}}
    </div>
    @endif
    <div class="form-group">
        <label for="exampleInputEmail1">Category</label>
        <input type="text" name="nama_kategori" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
