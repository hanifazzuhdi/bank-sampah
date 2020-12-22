<!-- FUNGSI EXTENDS DIGUNAKAN UNTUK ME-LOAD MASTER LAYOUTS YANG ADA, KARENA INI ADALAH HALAMAN HOME MAKA KITA ME-LOAD LAYOUTS ADMIN.BLADE.PHP -->
<!-- KETIKA MELOAD FILE BLADE, MAKA EKSTENSI .BLADE.PHP TIDAK PERLU DITULISKAN -->
@extends('layouts.admin')

<!-- TAG YANG DIAPIT OLEH SECTION('TITLE') AKAN ME-REPLACE @YIELD('TITLE') PADA MASTER LAYOUTS -->
@section('title')
    <title>Dashboard</title>
@endsection

<!-- TAG YANG DIAPIT OLEH SECTION('CONTENT') AKAN ME-REPLACE @YIELD('CONTENT') PADA MASTER LAYOUTS -->
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
                       {{-- <h1>SELAMAT DATANG PAK {{ ($Customer) }}</h1> --}}
                       <p>semuanya berjalan normal walau hati sedang kacau dan kesepian</p>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">perkembangan</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="callout callout-info">
                                            <small class="text-muted">jumlah uang masuk</small>
                                            <br>
                                            {{-- <strong class="h4">{{ number_format($Payment) }}</strong> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="callout callout-danger">
                                            <small class="text-muted">Jumlah member</small>
                                            <br>
                                            {{-- <strong class="h4">{{ number_format($User) }}</strong> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="callout callout-primary">
                                            <small class="text-muted">Perlu Dikirim</small>
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
