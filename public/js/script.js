  // Permintaan csrf token laravel
  $.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    const proxyurl = "https://cors-anywhere.herokuapp.com/";
    const url = "http://sammpah.herokuapp.com/"; // site that doesn’t send Access-Control-*
    fetch(proxyurl + url) // https://cors-anywhere.herokuapp.com/https://example.com
    .then(response => response.text())
    .then(contents => console.log(contents))
    .catch(() => console.log("Can’t access " + url + " response. Blocked by browser?"))


// jquery + ajax update
    $(function () {

        $('.see-nasabah').click(function () {
            const id = $(this).data('id');
            const url = $(this).data('url');
            console.log(url);

            $('.btn-warning').hide();
            $('.userDelete').show();
            $('.modal-body form').attr('action', url + 'update/' + id );
            $('#name').attr('disabled', 'disabled');
            $('#phone_number').attr('disabled', 'disabled');
            $('#address').attr('disabled', 'disabled');
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

        $('.see').on('click', function(){

            const id = $(this).data('id');
            const url = $(this).data('url');
            console.log(url);

            $('.modal-body form').attr('action', url + 'update/' + id );

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

