@extends('layouts.admin')

@section('title')
    <title>Daftar Nasabah</title>
@endsection

@section('content')
    <main class="main">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active">Nasabah</li>
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    Daftar User
                                </h4>
                            </div>
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                                {{-- <a href="{{ route('register') }}" class="btn btn-primary btn-sm float-right">Tambah --}}
                                    {{-- Ad      --}}
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Pelanggan</th>
                                                <th>nomor telpon</th>
                                                <th>alamat</th>
                                                <th>foto</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($User as $row)
                                                <b style="color: white">{{ $row->avatar }}</b>
                                                <tr>
                                                    <td><strong>{{ $row->id }}</strong></td>
                                                    <td><strong>{{ $row->name }}</strong><br>
                                                    <td>{{ $row->phone_number }}</td>
                                                    <td>{{ $row->address }}</td>
                                                    <td> <img src="{{ $row->avatar }}" width="100px" height="100px"
                                                            alt="{{ $row->name }}"></td>
                                                    <td>
                                                        <form action="{{ route('delete_nasabah', $row->id) }}" method="delete">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm">black list</button>
                                                        </form>
                                                        <form action="{{ route('detail') }}" method="get">
                                                            @csrf
                                                            @method('GET')
                                                            <button class="btn btn-warning btn-sm mt-2">lihat</button>
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
