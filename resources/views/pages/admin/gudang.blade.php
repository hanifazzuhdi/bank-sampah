@extends('layouts.admin', ['title' => 'Penyimpanan Sampah - Sammpah.com'])

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div aria-label="breadcrumb">
            <ol class="breadcrumb">
                <i class="fas fa-home breadcrumb-item"></i>
                <li class="breadcrumb-item"> <a class="text-decoration-none" href="{{route('home')}}"> Home </a> </li>
                <li class="breadcrumb-item active" aria-current="page"> Kelola Sampah </li>
                <li class="breadcrumb-item active" aria-current="page"> Gudang Sampah </li>
            </ol>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3">
            <h6 class="mt-2 font-weight-bold text-primary">GUDANG PENYIMPANAN SAMPAH</h6>
        </div>
        <div class="card-body d-flex justify-content-around flex-wrap">

            @foreach ($sampahs as $sampah)
            <div class="card shadow mb-4 w-50">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <h6 class="m-0 font-weight-bold text-primary">{{$sampah->jenis->jenis_sampah}}</h6>
                        <small>Harga Beli : {{$sampah->jenis->harga}} /Kg</small>
                    </div>

                    @if ($sampah->berat >= 1000)
                    <small class="text-danger">Kapasistas Penuh !</small>
                    @else
                    <small>
                        {{$sampah->berat}}/<span class="text-primary">1000</span> kg
                    </small>
                    @endif

                </div>
                <!-- Card Body -->
                <div class="card-body d-flex justify-content-between">
                    <img class="rounded border p-2" src="{{$sampah->jenis->image}}" width="100px" height="100px"
                        alt="Image Sampah">
                    <div class="">
                        <p>Kapasistas <span class="text-primary">{{$sampah->berat}}</span> Kg</p>

                        <small class="d-block mt-4_5">Dibuat Pada : {{$sampah->created_at}}</small>
                        <small>Terakhir diupdate : {{$sampah->updated_at}}</small>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <div class="card-footer">
            {{$sampahs->links()}}
        </div>
    </div>

    @include('components.modal')

</div>
<!-- /.container-fluid -->

@endsection
