@extends('layout')

@section('title', 'Edit Book')

@section('content')
<form method="POST" action="{{ route('bookUpdate', ['id' => $book->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ $book->judul }}">
        </div>
        <div class="form-group col-md-6">
            <label>Penulis</label>
            <input type="text" name="penulis" class="form-control" value="{{ $book->penulis }}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Penerbit</label>
            <input type="text" name="penerbit" class="form-control" value="{{ $book->penerbit }}">
        </div>
        <div class="form-group col-md-6">
            <label>Tahun Terbit</label>
            <input type="number" name="tahun_terbit" class="form-control" value="{{ $book->tahun_terbit }}">
        </div>
    </div>

    <div class="form-row">

        <div class="form-group col-md-6">
            <label for="inputRole">Category</label>
            <select id="inputRole" class="form-control" name="nama_kategori[]">
                <option selected disabled>Choose...</option>
                @foreach($categories as $kategoribuku)
                <option value="{{ $kategoribuku->id }}" {{ $book->categories->contains($kategoribuku) ? 'selected' : '' }}>{{ $kategoribuku->nama_kategori }}</option>
                @endforeach

            </select>
        </div>

        <div class="form-group col-md-6">
            <label for="formFile" class="form-label">Cover</label><br>
            <input style="margin:0;" name="gambar" type="file" onchange="previewImage(event)">
            <img id="preview" src="{{ asset('uploads/' . $book->gambar) }}" alt="Preview" style="max-width: 100px; max-height: 100px; margin-top: 10px; display: block;">
        </div>

        <script>
            function previewImage(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var preview = document.getElementById('preview');
                    preview.src = reader.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(event.target.files[0]);
            }

        </script>

    </div>

    <button type="submit" style="background-color:blue; float:right; margin-right:30px;" class="btn btn-primary">Submit</button>
</form>
@endsection
