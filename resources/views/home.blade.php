@extends('layouts.admin')
@section('title')
<title>Dashboard - Sampah</title>
@endsection
@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">PERKEMBANGAN</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="callout callout-info">
                                        <small class="text-muted">jumlah saldo bank</small>
                                        <br>
                                        <strong class="h4">{{ number_format($Keuangan) }}</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="callout callout-danger">
                                        <small class="text-muted">Jumlah member</small>
                                        <br>
                                        <strong class="h4">{{ number_format($User) }}</strong>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="callout callout-primary">
                                        <small class="text-muted">pemasukan</small>
                                        <br>
                                        {{-- <strong class="h4">{{ number_format($Order) }}</strong> --}}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="callout callout-success">
                                        <small class="text-muted">Total Produk</small>
                                        <br>
                                        {{-- <strong class="h4">{{ number_format($Product) }}</strong> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-deck">
                        <div class="card mb-5">
                            <div class="card-body">
                                <h5 class="card-title">rata rata jumlah transaksi</h5>
                                <div class="callout callout-success">
                                    <small class="text-muted">dalam rupiah</small>
                                    <br>
                                    {{-- <strong class="h4">{{ number_format($Transaksi) }}</strong> --}}
                                </div>
                            </div>
                        </div>
                        <div class="card mb-5">
                            <div class="card-body">
                                <h5 class="card-title">Toko terdaftar</h5>
                                <div class="callout callout-success">
                                    <small class="text-muted">jumlah toko</small>
                                    <br>
                                    {{-- <strong class="h4">{{ ($Shop) }}</strong> --}}
                                </div>
                            </div>
                        </div>
                        <div class="card mb-5">
                            <div class="card-body">
                                <h5 class="card-title">produk habis</h5>
                                <div class="callout callout-success">
                                    <small class="text-muted">Total Produk</small>
                                    <br>
                                    {{-- <strong class="h4">{{ number_format($Produk) }}</strong> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
