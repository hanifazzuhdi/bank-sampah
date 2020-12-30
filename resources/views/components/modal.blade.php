{{-- Modal Update--}}
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
                        <img id="avatar" class="rounded-circle" src="" alt="Avatar" width="150px" height="150px">

                        <form class="updateAvatar" action="" method="POST" enctype="multipart/form-data">
                            <input type="file" name="avatar" id="avatar">
                        </form>
                    </div>

                    <div class="col-md-8 p-3">
                        <form action="" method="post">
                            <div class="row mb-2">
                                <div class="col">
                                    <label>Nama : </label>
                                    <input type="text" class="form-control" name="nama" id="name">
                                </div>
                                <div class="col">
                                    <label>Email : </label>
                                    <input type="email" class="form-control" disabled id="email">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col">
                                    <label>No. Telepon : </label>
                                    <input type="text" class="form-control" name="phone_number" id="phone_number">
                                </div>

                                <div class="col">
                                    <label>Role : </label>
                                    <input type="text" class="form-control" disabled id="role">
                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <label>Alamat</label>
                                <textarea class="form-control" name="address" cols="30" rows="3"
                                    id="address"></textarea>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <label>Created At : </label>
                                    <input class="form-control" type="text" disabled id="created_at">
                                </div>
                                <div class="col">
                                    <label>Updated At : </label>
                                    <input class="form-control" type="text" disabled id="updated_at">
                                </div>
                            </div>
                            @csrf
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
