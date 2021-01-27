@extends('layouts.admin', ['title' => 'Permintaan Tarik Saldo - Sammpah.com'])

@section('style')
<link href="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/style.css')}}">
@endsection

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div aria-label="breadcrumb">
            <ol class="breadcrumb">
                <i class="fas fa-home breadcrumb-item mt-0_5"></i>
                <li class="breadcrumb-item"> <a class="text-decoration-none" href="{{route('home')}}"> Home </a> </li>
                <li class="breadcrumb-item"> Penarikan </li>
                <li class="breadcrumb-item active" aria-current="page"> Permintaan </li>
            </ol>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3">
            <h6 class="m-0 font-weight-bold text-primary">PERMINTAAN TARIK SALDO</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Nominal</th>
                            <th>Alias</th>
                            <th>No. Rekening</th>
                            <th>Waktu Permintaan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Nominal</th>
                            <th>Alias</th>
                            <th>No. Rekening</th>
                            <th>Waktu Permintaan</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($datas as $data)
                        <tr>
                            <td>{{$data->id}}</td>
                            <td>{{$data->user->email}}</td>
                            <td>{{$data->kredit}}</td>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->rekening}}</td>
                            <td>{{$data->created_at}}</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <a class="dropdown-toggle text-decoration-none" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                        aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header">Action</div>

                                        <form action="{{'/penarikan/konfirmasi/'.$data->id}}" method="POST">
                                            <button type="submit" class="dropdown-item"
                                                onclick="return confirm ('Yakin ?')">
                                                Terima
                                            </button>
                                            @csrf
                                        </form>

                                        <form action="{{'/penarikan/tolak/'.$data->id}}" method="POST">
                                            <button type="submit" class="dropdown-item"
                                                onclick="return confirm ('Yakin ?')">
                                                Tolak
                                            </button>
                                            @csrf
                                        </form>

                                    </div>
                                </div>
                            </td>
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

<script src=" {{asset('template/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.js')}}">
</script>
<script src="{{asset('template/js/demo/datatables-demo.js')}}"></script>

{{-- jquery --}}
<script src="{{asset('js/script.js')}}"></script>

@endsection
