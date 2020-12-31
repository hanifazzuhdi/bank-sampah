@extends('layouts.admin', ['title' => "Daftar Nasabah - Sammpah.com"])

@section('style')
<link href="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

<style>
    .updateAvatar {
        position: absolute;
        bottom: 40%;
        right: 52%;
        transform: translateX(50%);
    }

    .updateAvatar input {
        width: 90px;
        color: rgba(255, 255, 255, 0);
    }
</style>

@endsection

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar karyawan</h6>
<<<<<<< HEAD
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".modal-createKaryawan">
=======
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".modal-create">
>>>>>>> d1845d01a4efa580f31c1528c7ce93d8e9cec219
                <i class="fas fa-plus"></i>
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
<<<<<<< HEAD
                                <a class="see" href="#" data-id="{{$user->id}}" data-toggle="modal"
                                    data-target=".modal-karyawan" data-url="{{env('APP_URL') . '/karyawan/'}}">
                                    <i class="fas fa-eye"></i>
                                </a>
=======
                                <a class="see text-decoration-none" href="#" data-id="{{$user->id}}" data-toggle="modal"
                                    data-target=".modal-update" data-url="{{env('APP_URL') . '/karyawan/'}}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                |
                                <form class="d-inline" action="{{'karyawan/delete/' . $user->id}}" method="post">
                                    <button class="btn p-0 btn-hapus" type="submit">
                                        <i class=" fas fa-eraser text-danger"></i>
                                    </button>
                                    @csrf
                                    @method('delete')
                                </form>
>>>>>>> d1845d01a4efa580f31c1528c7ce93d8e9cec219
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
<<<<<<< HEAD
<script src="{{asset('js/jquery.js')}}"></script>
=======
<script src="{{asset('js/script.js')}}"></script>
>>>>>>> d1845d01a4efa580f31c1528c7ce93d8e9cec219

@endsection
