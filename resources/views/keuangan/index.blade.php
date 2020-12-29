@extends('layouts.admin')

@section('title')
    <title>Daftar Nasabah</title>
@endsection

@section('content')
    <main class="main">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active">Keuangan</li>
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    Catatan Keuangan
                                </h4>
                            </div>
                            <div class="card-body">
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
                                                <th>Keterangan</th>
                                                <th>Debit</th>
                                                <th>Kredit</th>
                                                <th>saldo</th>
                                                <th>waktu</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($Keuangan as $row)
                                                <tr>
                                                    <td><strong>{{ $row->id }}</strong></td>
                                                    <td><strong>{{ $row->keterangan }}</strong><br>
                                                    <td>{{ $row->debet }}</td>
                                                    <td>{{ $row->kredit }}</td>
                                                    <td>{{ $row->saldo }}</td>
                                                    <td>{{ $row->creted_at }}</td>
                                                        <form action="" method="delete">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm">black list</button>
                                                        </form>
                                                        <form action="" method="get">
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
