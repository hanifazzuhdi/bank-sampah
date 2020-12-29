@extends('layouts.admin')

@section('title')
    <title>Daftar Pesanan</title>
@endsection

@section('content')
    <main class="main">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active">Orders</li>
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h1 class="card-title">
                                    Detail User
                                </h1>
                            </div>
                            <div class="card-body">
                                @forelse ($shop as $asus)
                                <img src="{{$asus->image}}" alt="toko ini ditutup pemerintah zimbabwe" width="200" height="300">
                                <h2>{{$asus->name}}</h2>
                                <h3>
                                    {{$asus->description}}
                                    <br>
                                    Alamat:{{$asus->alamat}}
                                </h3>
                                @empty
                                @endforelse
                                <h3>
                                    Jumlah produk:{{ $Product }}
                                    <br>
                                    Penghasilan:Rp.{{ number_format($Order_details) }}
                                </h3>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
@endsection
