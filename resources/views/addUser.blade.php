@extends('layout')

@section('title', 'Add User')

@section('content')
<form method="POST" action="{{route('userStore')}}">
    @csrf
    @method('POST')
    <form>
    <div class="form-row">
        <div class="form-group col-md-6">
        <label for="inputEmail4">Username</label>
        <input type="text" name="username" class="form-control" id="inputEmail4" placeholder="Username">
        </div>
        <div class="form-group col-md-6">
        <label for="inputPassword4">Password</label>
        <input type="password" name="password" class="form-control" id="inputPassword4" placeholder="Password">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
        <label for="inputEmail4">Email</label>
        <input type="text"  name="email" class="form-control" id="inputEmail4" placeholder="Email">
        </div>
        <div class="form-group col-md-6">
        <label for="inputPassword4">Nama Lengkap</label>
        <input type="text" name="nama_lengkap" class="form-control" id="inputPassword4" placeholder="Nama Lengkap">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
        <label for="inputEmail4">Alamat</label>
        <input type="text" name="alamat" class="form-control" id="inputEmail4" placeholder="Alamat">
    </div>
    <div class="form-group col-md-6">
        <label for="inputRole">Role</label>
        <select id="inputRole" class="form-control" name="role">
            <option selected disabled>Choose...</option>
            @foreach(['admin', 'petugas', 'peminjam', 'new_role'] as $role)
                <option value="{{ $role }}">{{ ucfirst($role) }}</option>
            @endforeach
        </select>    
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
