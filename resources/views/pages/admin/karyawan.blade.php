@extends('layouts.admin', ['title' => "Daftar Karyawan - Sammpah.com"])

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
                <li class="breadcrumb-item "> Kelola User </li>
                <li class="breadcrumb-item active" aria-current="page"> Karyawan </li>
            </ol>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3">
            <h6 class="m-0 font-weight-bold text-primary">DAFTAR KARYAWAN</h6>
            <button class="btn btn-primary btn-sm btn-create-karyawan" data-toggle="modal" data-target=".modal-create">
                <i class="fas fa-user-plus"></i>
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. Telepon</th>
                            <th>Alamat</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. Telepon</th>
                            <th>Alamat</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone_number}}</td>
                            <td>{{$user->address}}</td>
                            <td>{{$user->created_at}}</td>
                            <td class="text-center">
                                <a class="see text-decoration-none" href="#" data-id="{{$user->id}}" data-toggle="modal"
                                    data-target=".modal-update" data-url="{{env('APP_URL') . '/karyawan/'}}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                |
                                <form class="d-inline" action="{{'karyawan/delete/' . $user->id}}" method="post">
                                    <button class="btn p-0 btn-hapus" type="submit"
                                        onclick="return confirm ('Yakin Hapus ?')">
                                        <i class=" fas fa-user-slash text-danger"></i>
                                    </button>
                                    @csrf
                                    @method('delete')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('components.modal')

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
