@extends('layout')

@section('title', 'Dashboard')

@section('content')

    <div class="wrapper d-flex align-items-stretch">
     

        <!-- Page Content  -->
        <div id="content" style="margin:20px;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Judul</th>
                        <th scope="col">Penulis</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col">Tahun Terbit</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td><link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        <td>@mdo</td>
                    </tr>

                </tbody>
            </table>
        </div>


    </div>

    </div>

    @endsection