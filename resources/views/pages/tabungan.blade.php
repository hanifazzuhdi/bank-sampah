@extends('layouts.admin', ['title' => "Buku Tabungan Nasabah - Sammpah.com"])

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
                <i class="fas fa-home mt-0_5 breadcrumb-item"></i>
                <li class="breadcrumb-item"> <a class="text-decoration-none" href="{{route('home')}}"> Home </a> </li>
                <li class="breadcrumb-item "> <a class="text-decoration-none" href="{{route('nasabah.index')}}"> Nasabah
                    </a></li>
                <li class="breadcrumb-item active" aria-current="page"> Tabungan Nasabah </li>
            </ol>
        </div>
    </div>

    {{-- DETAIL USER --}}
    <div class="card shadow mb-4">
        <a href="#informasi-nasabah" class="d-block card-header py-3" data-toggle="collapse" role="button"
            aria-expanded="true" aria-controls="informasi-nasabah">
            <h6 class="m-0 font-weight-bold text-primary">INFORMASI NASABAH</h6>
        </a>

        <div class="collapse" id="informasi-nasabah">
            <div class="card-body">

                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <small class="text-xs_c"> ID Nasabah : {{$user->id}} </small>
                            <br>
                            <small class="text-xs_c"> Email : {{$user->email}} </small>
                            <br>
                            <small class="text-xs_c"> Nama Nasabah : {{$user->name}} </small>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Table data --}}
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <h6 class="m-0 font-weight-bold text-primary">TABUNGAN NASABAH</h6>

            <a class=" d-none d-sm-inline-block btn btn-sm btn-light shadow-sm"
                onclick="printContent('data-tabungan')"><i class="fas fa-download fa-sm text-primary-50"></i> Print
                Tabungan </a>

        </div>

        <div class="card-body" id="data-tabungan">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Debit</th>
                            <th>Kredit</th>
                            <th>Keterangan</th>
                            <th>Saldo</th>
                            <th>Dibuat Pada</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Debit</th>
                            <th>Kredit</th>
                            <th>Keterangan</th>
                            <th>Saldo</th>
                            <th>Dibuat Pada</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($datas as $data)
                        <tr>
                            <td>{{$data->id}}</td>
                            <td>{{$data->debit}}</td>
                            <td>{{$data->kredit}}</td>
                            <td>{{$data->keterangan}}</td>
                            <td>{{$data->saldo}}</td>
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

<script>
    function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>

@endsection
