@extends('layouts.admin')

@section('title')
    <title>Daftar Sampah</title>
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
                    {{-- bagian buat nambah jenis --}}
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Jenis Sampah Baru</h4>
                            </div>
                            <div class="card-body">

                                <form action="" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="Jenis sampah">Jenis Sampah</label>
                                        <select name="jenis_sampah" class="form-control">
                                            <option value="">None</option>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-sm">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- bagian buat nambah jenis --}}
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    Gudang Sampah
                                </h4>

                            </div>
                            <div class="card-body">
                                <div class="mb-5">
                                    <a href="" class="btn btn-primary">Tambah Jenis</a>
                                </div>
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Kategori</th>
                                                <th>Berat</th>
                                                <th>Harga</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($Sampah as $row)
                                                <tr>
                                                    <td><strong>{{ $row->id }}</strong></td>
                                                    <td><strong>{{ $row->jenis->jenis_sampah }}</strong><br>
                                                    <td><strong>{{ $row->berat }}</strong></td>
                                                    <td><strong>{{ $row->jenis->harga }}</strong></td>
                                                    <td>
                                                        <form action="" method="">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm">histori</button>
                                                        </form>
                                                        <form action="" method="get">
                                                            @csrf
                                                            @method('GET')
                                                            <button class="btn btn-warning btn-sm mt-2">hapus</button>
                                                        </form>
                                                    </td>

                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">Tidak ada data</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
