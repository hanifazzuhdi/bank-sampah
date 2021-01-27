{{-- Modal Update--}}
<div class="modal fade modal-update" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                        <img id="avatar" class="rounded-circle border" src="" alt="Avatar" width="150px" height="150px">

                        @if (Auth::user()->role_id == 5)
                        <div class="userDelete">
                            <form class="form-delete" action="" method="post">
                                <button class="btn border p-2 bg-danger text-white" type="submit" title="Delete User"
                                    onclick="return confirm ('Yakin Hapus User ?')">
                                    <i class=" fas fa-user-slash"></i>
                                    <small> Hapus</small>
                                </button>
                                @csrf
                            </form>

                            <form class="ml-5 form-blacklist" action="" method="POST">
                                <button class="btn border p-2 bg-warning text-black" type="submit"
                                    title="Blacklist User" onclick="return confirm ('Yakin Blacklist User ?')">
                                    <i class="fas fa-user-times"></i>
                                    <small> Blacklist</small>
                                </button>
                                @csrf
                            </form>
                        </div>
                        @endif

                        {{-- start form --}}
                        <form class="form-create" action="" method="POST" enctype="multipart/form-data">
                            <div class="updateAvatar">
                                <input type="file" name="avatar" id="avatar">
                            </div>
                    </div>

                    <div class="col-md-8 p-3">
                        <div class="row mb-2">
                            <div class="col">
                                <label>Nama : </label>
                                <input type="text" class="form-control" name="name" id="name">
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
                            <textarea class="form-control" name="address" cols="30" rows="3" id="address"></textarea>
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
                        @method('put')
                        @csrf
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                    Close
                </button>

                <button class="btn btn-warning" type="submit" onclick="return confirm ('Yakin Ubah ?')">
                    Update
                </button>
                </form>
                {{-- end form --}}
            </div>
        </div>
    </div>
</div>


{{-- Modal Create --}}
<div class="modal fade modal-create" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="text-primary font-weight-bold pt-2">TAMBAH KARYAWAN</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 text-center border-right pt-4">
                        <img id="avatar" class="rounded-circle" src="https://via.placeholder.com/150" alt="Avatar"
                            width="150px" height="150px">

                        <p class="d-block text-muted mt-5"> *Avatar diisi secara otomatis </p>
                    </div>

                    <div class="col-md-8 p-3">
                        {{-- start form --}}
                        <form action="{{route('karyawan.store')}}" method="post">
                            <div class="row mb-2">
                                <div class="col">
                                    <label>Nama : </label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="col">
                                    <label>Email : </label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col">
                                    <label>No. Telepon : </label>
                                    <input type="number" class="form-control" name="phone_number">
                                </div>

                                <div class="col select-role">
                                    <label>Role : </label>
                                    <select class="form-control" name="role_id">
                                        <option value="4" selected>Bendahara</option>
                                        <option value="3">Pengurus 2</option>
                                        <option value="2">Pengurus 1</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Password : </label>
                                <input type="password" class="form-control" name="password">
                            </div>

                            <div class="form-group mb-2">
                                <label>Alamat</label>
                                <textarea class="form-control" name="address" cols="30" rows="3"></textarea>
                            </div>
                            @csrf
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                    Close
                </button>
                <button class="btn btn-primary">
                    Create
                </button>
                </form>
                {{-- End form --}}
            </div>
        </div>
    </div>
</div>
