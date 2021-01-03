@extends('layouts.admin', ['title' => 'Penarikan Tunai - Sammpah.com'])


@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div aria-label="breadcrumb">
            <ol class="breadcrumb">
                <i class="fas fa-home breadcrumb-item mt-0_5"></i>
                <li class="breadcrumb-item"> <a class="text-decoration-none" href="{{route('home')}}"> Home </a> </li>
                <li class="breadcrumb-item"> Penarikan </li>
                <li class="breadcrumb-item active" aria-current="page"> Tunai </li>
            </ol>
        </div>

        <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="window.print()"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    {{-- Form Penarikan --}}
    <div class="card shadow mb-4">
        <a href="#form-penarikan-tunai" class="d-block card-header py-3" data-toggle="collapse" role="button"
            aria-expanded="true" aria-controls="form-penarikan-tunai">
            <h6 class="m-0 font-weight-bold text-primary">FORM PENARIKAN TUNAI</h6>
        </a>

        <div class="collapse show" id="form-penarikan-tunai">
            <div class="card-body">

                <form action="" method="POST">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label for="nominal">Nominal</label>
                            <input type="text" id="nominal" name="nominal" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" name="keterangan" id="keterangab" cols="30" rows="4"></textarea>
                        <small class="text-danger">*Form keterangan boleh tidak diisi</small>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </form>

            </div>
        </div>
    </div>


</div>

@endsection
