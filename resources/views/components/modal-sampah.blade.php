<!-- Modal create jenis sampah -->
<div class="modal fade" id="modal-sampah-create" tabindex="-1" aria-labelledby="modal-jenis" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-primary" id="modal-jenis">TAMBAH JENIS SAMPAH</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- Start Form --}}
                <form action="{{route('sampah.store')}}" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <label>Jenis Sampah : </label>
                            <input type="text" class="form-control" name="jenis_sampah" id="jenis_sampah">
                        </div>
                        <div class="col">
                            <label>Harga Beli : </label>
                            <input type="text" class="form-control" name="harga" id="harga">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label><span class="text-danger">*</span>Url Image : </label>
                            <input type="text" name="imageURL" class="form-control">
                        </div>
                        <div class="col">
                            <label><span class="text-danger">*</span>Image : </label>
                            <br>
                            <input type="file" name="image" class="mt-1">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label>Warna Thumbnail : </label>
                            <input class="form-control" type="color" name="warna">
                        </div>
                    </div>
                    @csrf
            </div>
            <div class="modal-footer d-flex justify-content-between">

                <small class="text-help text-danger">*Pilih salah satu metode untuk input image</small>

                <div class="button">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
                </form>
                {{-- End Form --}}
            </div>
        </div>
    </div>
</div>

<!-- Modal Update jenis sampah -->
<div class="modal fade" id="modal-sampah-update" tabindex="-1" aria-labelledby="modal-jenis" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-primary" id="modal-jenis">UPDATE JENIS SAMPAH</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- Start Form --}}
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <label>Jenis Sampah : </label>
                            <input type="text" class="form-control" name="jenis_sampah" id="jenis-update">
                        </div>
                        <div class="col">
                            <label>Harga Beli : </label>
                            <input type="text" class="form-control" name="harga" id="harga-update">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label><span class="text-danger">*</span>Url Image : </label>
                            <br>
                            <input type="text" name="imageURL" class="form-control" id="image-update">
                        </div>
                        <div class="col">
                            <label><span class="text-danger">*</span>Image : </label>
                            <br>
                            <input type="file" name="image" class="mt-1">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label>Warna Thumbnail : </label>
                            <input class="form-control" type="color" name="warna" id="color-update">
                        </div>
                    </div>
                    @csrf
                    @method('put')
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <div class="text-help">
                    <small class="text-danger d-block mt-2">*Pilih salah satu metode untuk input image</small>
                    <small class="text-danger d-block">*Url yang tampil adalah lokasi image sebelumnya</small>
                    <small class="text-danger d-block">*Hapus URL default jika anda ingin mengupload image dengan metode
                        Upload File</small>
                </div>

                <div class="button">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
                {{-- End Form --}}
            </div>
        </div>
    </div>
</div>
