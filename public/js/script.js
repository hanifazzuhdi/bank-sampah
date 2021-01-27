// jquery + ajax update
$(function() {

    // Permintaan csrf token laravel
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });

    // Karyawan dan nasabah

    // update
    $('.see-nasabah').click(function() {
        const id = $(this).data('id');
        const url = $(this).data('url');
        console.log(url + id);

        $('.modal-body .form-blacklist').attr('action', '/nasabah/blacklist/' + id);
        $('.modal-body .form-delete').attr('action', '/nasabah/delete/' + id);

        $('.btn-warning').hide();
        $('.updateAvatar').hide();
        $('.userDelete').css('display', 'flex');
        $('#name').attr('disabled', 'disabled');
        $('#phone_number').attr('disabled', 'disabled');
        $('#address').attr('disabled', 'disabled');

        $.ajax({
            url: url + id,
            method: 'get',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('#avatar').attr('src', data.avatar);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#phone_number').val(data.phone_number);
                $('#role').val(data.role_id);
                $('#address').val(data.address);
                $('#created_at').val(data.created_at);
                $('#updated_at').val(data.updated_at);
            }
        });
    });

    $('.see').on('click', function() {

        const id = $(this).data('id');
        const url = $(this).data('url');
        console.log(url + id);

        $('.modal-body .form-create').attr('action', url + 'update/' + id);

        $.ajax({
            url: url + id,
            method: 'get',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('#avatar').attr('src', data.avatar);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#phone_number').val(data.phone_number);
                $('#role').val(data.role_id);
                $('#address').val(data.address);
                $('#created_at').val(data.created_at);
                $('#updated_at').val(data.updated_at);
            }
        });
    });

    // create
    $('.btn-create-karyawan').click(function() {
        $('.modal-body form').attr('action', '/karyawan/store');

        $('.select-role').show();
    });

    $('.btn-create-user').click(function() {
        $('.modal-body form').attr('action', '/nasabah/store');

        $('.select-role').hide();
    });

    // Jenis Sampah
    $('.update-jenis').click(function() {

        const url = $(this).data('url');
        console.log(url);

        $('#modal-sampah-update form').attr('action', url + '/update');

        $.ajax({
            url: url,
            method: 'get',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('#jenis-update').val(data.jenis_sampah);
                $('#harga-update').val(data.harga);
                $('#image-update').val(data.image);
                $('#color-update').val(data.warna);
            }

        });
    });

});