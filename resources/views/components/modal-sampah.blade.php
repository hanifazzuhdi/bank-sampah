<!-- Modal create jenis sampah -->
<div class="modal fade" id="modal-sampah-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-primary" id="exampleModalLabel">TAMBAH JENIS SAMPAH</h6>
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
                            <input type="text" class="form-control" name="jenis_sampah">
                        </div>
                        <div class="col">
                            <label>Harga Beli : </label>
                            <input type="text" class="form-control" name="harga">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <label>Url Image : </label>
                            <br>
                            <input type="text" name="imageURL" class="form-control">
                            <small class="text-help text-danger">*Pilih salah satu metode untuk input image</small>
                        </div>
                        <div class="col">
                            <label>Image : </label>
                            <br>
                            <input type="file" name="image" class="mt-1">
                        </div>
                    </div>
                    @csrf
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create</button>
                </form>
                {{-- End Form --}}
            </div>
        </div>
    </div>
</div>
