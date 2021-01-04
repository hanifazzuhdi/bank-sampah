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
    </div>

    {{-- Form Penarikan --}}
    <div class="card shadow mb-4">
        <a href="#form-penarikan-tunai" class="d-block card-header py-3" data-toggle="collapse" role="button"
            aria-expanded="true" aria-controls="form-penarikan-tunai">
            <h6 class="m-0 font-weight-bold text-primary">FORM PENARIKAN TUNAI</h6>
        </a>

        <div class="collapse show" id="form-penarikan-tunai">
            <div class="card-body">

                <form action="{{route('keuangan.tarik')}}" method="POST">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label for="nominal">Nominal</label>
                            <input type="number" id="nominal" name="nominal" class="form-control">
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
                    @csrf
                </form>

            </div>
        </div>
    </div>


    {{-- Jika Penarikan Success --}}
    @if (session('data'))
    <div class="d-flex justify-content-end mb-2">
        <a class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" onclick="printContent('slip')"><i
                class="fas fa-download fa-sm text-white-50"></i> Print Slip</a>
    </div>

    <div class="card" id="slip">
        <div class="card-header d-flex justify-content-between align-items-center bg-info">
            <div class="text-white">
                <img src="{{asset('img/logo.png')}}" width="60px" alt="">
                <h5 class="d-inline font-weight-bold">SAMMPAH</h5>
            </div>

            <div class="text-center pt-2 text-white">
                <h5> SLIP PENARIKAN </h5>
                <small>No : {{session('data')->id . date('-d/m/y-') . session('data')->user_id}}</small>
            </div>
        </div>

        <div class="card-body p-4">

            <div class="row">
                <div class="col-sm-3 font-weight-bold">
                    <p class="mb-4_5"> Terima Dari </p>
                    <p class="mb-4_5"> Tanggal </p>
                    <p class="mb-4_5"> No. Rekening </p>
                    <p class="mb-4_%"> Terbilang (Rupiah)</p>
                </div>

                <div class="col-sm-9">
                    <p> <span class="mr-2"> : </span> {{Auth::user()->name}}</p>
                    <hr>
                    <p> <span class="mr-2"> : </span> {{session('data')->created_at}} </p>
                    <hr>
                    <p> <span class="mr-2"> : </span> {{session('data')->user->email}} </p>
                    <hr>
                    <p> <span class="mr-2"> : </span> {{session('data')->kredit}} </p>
                </div>
            </div>
        </div>

        <div class="card-footer bg-white d-flex justify-content-around mt-2">
            <div class="penerima mt-3">
                <p class="text-info mb-6">
                    jumlah diatas telah diterima dengan benar
                </p>

                <p class="border-top text-center pt-2">
                    Penerima
                </p>
            </div>

            <div class="pemilik mt-2">
                <p class="mb-6">
                    Bantul, {{session('data')->created_at}}
                </p>

                <p class="border-top text-center pt-2">
                    Bendahara
                </p>
            </div>
        </div>
    </div>
    @endif

</div>

@endsection

@section('script')
<script>
    function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>
@endsection
