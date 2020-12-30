@extends('layouts.admin', ['title' => "Daftar Nasabah - Sammpah.com"])

@section('style')
<link href="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar karyawan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. Telepon</th>
                            <th>Alamat</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. Telepon</th>
                            <th>Alamat</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone_number}}</td>
                            <td>{{$user->address}}</td>
                            <td>{{$user->created_at}}</td>
                            <td class="text-center">
                                <a class="see" href="#" data-id="{{$user->id}}" data-toggle="modal"
                                    data-target=".modal-karyawan" data-url="{{env('APP_URL') . '/karyawan/edit'}}">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade modal-karyawan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="text-primary font-weight-bold pt-2">DETAIL USER</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 d-flex justify-content-center border-right pt-4">
                            <img class="rounded-circle" src="https://via.placeholder.com/150" alt="Avatar" width="150px"
                                height="150px">
                        </div>
                        <div class="col-md-8 p-3">
                            <form action="" method="post">
                                <div class="row mb-2">
                                    <div class="col">
                                        <label>Nama : </label>
                                        <input type="text" class="form-control" name="nama">
                                    </div>
                                    <div class="col">
                                        <label>Email : </label>
                                        <input type="email" class="form-control" disabled>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col">
                                        <label>No. Telepon : </label>
                                        <input type="text" class="form-control" name="phone_number">
                                    </div>

                                    <div class="col">
                                        <label>Role : </label>
                                        <input type="text" class="form-control" disabled>
                                    </div>
                                </div>

                                <div class="form-group mb-2">
                                    <label>Alamat</label>
                                    <textarea class="form-control" name="address" cols="30" rows="3"></textarea>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label>Created At : </label>
                                        <input class="form-control" type="text" disabled>
                                    </div>
                                    <div class="col">
                                        <label>Updated At : </label>
                                        <input class="form-control" type="text" disabled>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                        Close
                    </button>
                    <button class="btn btn-warning" onclick="return confirm('Yakin Ubah ?')">
                        Update
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection


@section('script')
<script src="{{asset('template/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('template/js/demo/datatables-demo.js')}}"></script>

<script>
    // Permintaan csrf token laravel
       $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    // jquery + ajax update
    $(function () {
        $('.see').on('click', function(){

            const id = $(this).data('id');
            console.log(id);

            const url = $(this).data('url');
            console.log(url);

            $('.modal-body form').attr('action', 'http://localhost:8000/' + id )

            $.ajax({
                url: 'http://localhost:8000/' + id ,
                // data: {id:id},
                method: 'get',
                dataType: 'json',
                success: function (data) {
                    console.log(data)
                    $('#productName').val(data.product_name);
                    $('#sku').val(data.sku);
                    $('#sell_price').val(data.sell_price);
                    $('#buy_price').val(data.buy_price);
                    $('#stok').val(data.quantity);
                    $('#id').val(data.id);
                }
            });
        });
    });
</script>

@endsection
