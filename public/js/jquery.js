
    // jquery + ajax update
    $(function () {

    // Permintaan csrf token laravel
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

        $('.see').on('click', function(){

            const id = $(this).data('id');
            const url = $(this).data('url');
            console.log(url);

            $('.modal-body form').attr('action', url + 'update/' + id )

            $.ajax({
                url: url + id ,
                method: 'get',
                dataType: 'json',
                success: function (data) {
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
    });

