@extends('layouts.admin', ['title' => "Daftar Penyetoran Sampah - Sammpah.com"])

@section('style')
<link href="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/style.css')}}">
@endsection

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div aria-label="breadcrumb">
            <ol class="breadcrumb">
                <i class="fas fa-home breadcrumb-item mt-0_5"></i>
                <li class="breadcrumb-item"> <a class="text-decoration-none" href="{{route('home')}}"> Home </a> </li>
                <li class="breadcrumb-item active" aria-current="page"> Penyetoran </li>
            </ol>
        </div>

        <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="window.print()"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3">
            <h6 class="m-0 font-weight-bold text-primary">DATA PENYETORAN NASABAH</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>Jenis Sampah</th>
                            <th>Berat</th>
                            <th>Penghasilan</th>
                            <th>Waktu Penyetoran</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>Jenis Sampah</th>
                            <th>Berat</th>
                            <th>Penghasilan</th>
                            <th>Waktu Penyetoran</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($datas as $data)
                        <tr>
                            <td>{{$data->user->email}}</td>
                            <td>{{$data->user->name}}</td>
                            <td>{{$data->jenis->jenis_sampah}}</td>
                            <td>{{$data->berat}}</td>
                            <td>{{number_format ($data->penghasilan, 0, ',', '.')}}</td>
                            <td>{{$data->created_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection

@section('script')

<script src="{{asset('template/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('template/js/demo/datatables-demo.js')}}"></script>

{{-- jquery --}}
<script src="{{asset('js/script.js')}}"></script>

@endsection
