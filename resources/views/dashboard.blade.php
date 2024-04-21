@extends('layout')

@section('title', 'Dashboard')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between ">

    <h1 class="h6 m-0 text-gray-800"><i class="fas fa-fw fa-home"><a href="/dashboard"></a></i> | Dashboard</h1>

</div>

@if(Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')


<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Book</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$bookCount}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            User</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$userCount}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Category</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$categoryCount}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@else



<div class="card-body mt-4">
    <h5 class="card-title">Welcome, {{ Auth::user()->username }}</h5>
    <p class="card-text">"Jadilah pembaca yang rajin dengan terus meminjam buku-buku yang menarik minatmu. Dengan rajin membaca, kamu dapat menemukan dunia yang tak terbatas di setiap halaman buku yang kamu telusuri."</p>
    <a href="/books" class="btn btn-primary">Pinjam Buku</a>
</div>


@endif

@endsection
