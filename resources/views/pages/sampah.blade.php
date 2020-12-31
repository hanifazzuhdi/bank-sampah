@extends('layouts.admin', ['title' => 'Daftar Jenis Sampah - Sammpah.com'])

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3">
            <h6 class="m-0 font-weight-bold text-primary">DAFTAR JENIS SAMPAH</h6>
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target=".modal-create">
                <i class="fas fa-plus"></i>
            </button>
        </div>
        <div class="card-body d-flex justify-content-around flex-wrap">

            @foreach ($sampahs as $sampah)
            <div class="card shadow mb-4 w-50">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <h6 class="m-0 font-weight-bold text-primary">{{$sampah->jenis_sampah}}</h6>
                        <small>Harga : {{$sampah->harga}} /Kg</small>
                    </div>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Action</div>
                            <a class="dropdown-item" href="#">Edit</a>
                            <a class="dropdown-item" href="#">Hapus</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body d-flex justify-content-between">
                    <img class="rounded border" src="{{$sampah->image}}" width="100px" height="100px"
                        alt="Image Sampah">
                    <div class=" mt-5">
                        <small class="d-block">Dibuat Pada : {{$sampah->created_at}}</small>
                        <small>Terakhir diupdate : {{$sampah->updated_at}}</small>
                    </div>
                </div>
            </div>
            @endforeach

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

@endsection
