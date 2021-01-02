@extends('layouts.admin', ['title' => "Daftar Karyawan - Sammpah.com"])

@section('style')
<link href="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/style.css')}}">
@endsection

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-end mb-4">
        <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="window.print()"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3">
            <h6 class="m-0 font-weight-bold text-primary">KEUANGAN PERUSAHAAN </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Keterangan</th>
                            <th>Debet</th>
                            <th>Kredit</th>
                            <th>Saldo</th>
                            <th>Dibuat</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Keterangan</th>
                            <th>Debet</th>
                            <th>Kredit</th>
                            <th>Saldo</th>
                            <th>Dibuat</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($keuangan as $value)
                        <tr>
                            <td>{{$value->id}}</td>
                            <td>{{$value->keterangan}}</td>
                            <td>{{number_format ($value->debet, 0, ',', '.')}}</td>
                            <td>{{number_format ($value->kredit, 0, ',', '.')}}</td>
                            <td>{{number_format ($value->saldo, 0, ',', '.')}}</td>
                            <td>{{$value->created_at}}</td>
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
