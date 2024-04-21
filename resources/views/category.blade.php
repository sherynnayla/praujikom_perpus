@extends('layout')

@section('title', 'Books Category')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between ">

    <h1 class="h6 m-0 text-gray-800"><i class="fas fa-fw fa-home"><a href="/dashboard"></a></i> | Books Category</h1>

</div>

<div class="table" style="margin-top:20px;  border-radius:10px;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.11);">
    <div class="mt-5 d-flex justify-content-end">
        <a href="/add-category" class="btn btn-primary" style="background-color:blue; margin:20px; ">Add Category</a>
    </div>

    <div class="card-body">
     <div class="table-responsive">
        <table class="table">
            <thead>
                <tr style="color:grey; font-size:13px;">
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach($categories as $kategoribuku)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$kategoribuku->nama_kategori}}</td>
                    <td>
                        <div class="d-flex flex-row w-75 ">
                            <a href="/edit-category/{{ $kategoribuku->id }}" class="btn btn-warning btn-sm mr-2">Edit</a>
                            <form action="/delete-category/{{ $kategoribuku->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>

                    </td>
    </div>


    </td>
    </tr>
    @endforeach

    </tbody>
    </table>
    </div>
</div>
</div>
@endsection
