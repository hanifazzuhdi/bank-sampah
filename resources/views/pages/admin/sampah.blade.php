@extends('layouts.admin', ['title' => 'Daftar Jenis Sampah - Sammpah.com'])

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
                <li class="breadcrumb-item active" aria-current="page"> Jenis Sampah </li>
            </ol>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between py-3">
            <h6 class="mt-2 font-weight-bold text-primary">DAFTAR JENIS SAMPAH</h6>
            <button class="btn btn-primary btn-sm btn-create-jenis" data-toggle="modal"
                data-target="#modal-sampah-create">
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
                        <small>Harga Beli : {{$sampah->harga}} /Kg</small>
                    </div>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Action</div>

                            <button class="dropdown-item update-jenis" data-toggle="modal"
                                data-target="#modal-sampah-update"
                                data-url=" {{env('APP_URL') . '/sampah/' . $sampah->id}}">
                                Edit
                            </button>

                            <form action="{{'sampah/' . $sampah->id}}" method="POST">
                                <button class="dropdown-item" type="submit"
                                    onclick="return confirm ('Yakin Hapus Data ?')">Hapus
                                </button>
                                @method('DELETE')
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class=" card-body d-flex justify-content-between">
                    <img class="rounded border p-2" src="{{$sampah->image}}" width="100px" height="100px"
                        alt="Image Sampah">
                    <div class=" mt-5">
                        <small class="d-block">Dibuat Pada : {{$sampah->created_at}}</small>
                        <small>Terakhir diupdate : {{$sampah->updated_at}}</small>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <div class="card-footer d-flex justify-content-end">
            <div class="mr-4">
                {{$sampahs->links()}}
            </div>
        </div>
    </div>

</div>

<div class="container-fluid">

    <div class="col-xl-8 col-lg-7 pl-0">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">harga sampah</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div style="width: 650px;height: 300px;text-align:center">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="container-fluid">

    <div class="col-xl-8 col-lg-7 pl-0">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">grafik kenaikan harga</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                {{-- <div style="width: 650px;height: 300px;text-align:center"> --}}
                    <canvas id="hargaSampah" width="600" height="400"></canvas>
                {{-- </div> --}}
            </div>
        </div>
    </div>

</div>


<!-- /.container-fluid -->

@include('components.modal-sampah')

@endsection

@section('script')

{{-- jquery --}}
<script src="{{asset('js/script.js')}}"></script>
<script type="text/javascript" src="{{asset('js/Chart.js')}}"></script>
<script>
    var hargae = document.getElementById("hargaSampah");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;

var dataFirst = {
    label: "plastik",
    data: {!! json_encode($hargae) !!},
    lineTension: 0,
    fill: false,
    borderColor: 'red'
  };

  var dataDua = {
    label: "kertas",
    data: [1000,500,3000],
    lineTension: 0,
    fill: false,
    borderColor: 'yellow'
  };
  var dataTiga = {
    label: "elektronik",
    data: [3000,500,1000],
    lineTension: 0,
    fill: false,
    borderColor: 'black'
  };
  var dataEmpat = {
    label: "minyak",
    data: [2000,500,200],
    lineTension: 0,
    fill: false,
    borderColor: 'green'
  };
var dataSecond = {
    label: "logam",
    data: [1000,2000,3000,4000],
    lineTension: 0,
    fill: false,
  borderColor: 'blue'
  };
  var dataSecond = {
    label: "logam",
    data: [1000,2000,3000,4000],
    lineTension: 0,
    fill: false,
  borderColor: 'blue'
  };
var speedData = {
  labels: {!! json_encode($label) !!},
  datasets: [dataFirst,dataDua,dataTiga,dataEmpat, dataSecond]
};

var chartOptions = {
  legend: {
    display: true,
    position: 'top',
    labels: {
      boxWidth: 80,
      fontColor: 'black'
    }
  }
};

var lineChart = new Chart(hargae, {
  type: 'line',
  data: speedData,
  options: chartOptions
});
    var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: {!! json_encode($jenis) !!},
				datasets: [{
					label: 'per {{now()}}',
					data: {!! json_encode($harga) !!},
					backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)'
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		}); 
</script>
@endsection
