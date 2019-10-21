/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {

    $.ajax({
        url: "{{url('category/all')}}",
        type: "GET",
        dataType: 'json',
        success: function (data) {
            var dataSet = data.data;
            $.each(dataSet, function (i, item) {

                $('#categorydiv').append('<div class="col-lg-1 col-md-2 col-sm-3 col-xs-6">' +
                        '<a href="#">' +
                        '<input type="checkbox" value="' + item.id + '" name="catids[]" id="myCheckbox' + item.id + '" />' +
                        '<label for="myCheckbox' + item.id + '">' +
                        ' <img src="http://18.217.149.24/ecommerce/images/' + item.iconUrl + '"  height="40" width="40"  title="' + item.name + '"/>' +
                        '</label></a>' +
                        '<a href="#">' + item.name + '</a>\n\
                                 </div>'
                        );
            });
        }
    });
    //shoppingForm
    $('#shoppingForm').on('submit', function (e) {

        e.preventDefault();
        var formData = $(this).serialize();
        console.log(formData);
        $('.loader').addClass('be-loading-active');
        $.ajax({
            url: "{{url('category/items')}}",
            type: "POST",
            data: formData,
            dataType: 'json',
            success: function (data) {
                $('.loader').removeClass('be-loading-active');
                var jsondata = JSON.stringify(data);
                console.log('server data :' + jsondata);
                var redirect = 'shoppingroom';
                $.redirect('shoppingroom', jsondata, 'GET');
            }

        });
    });
//register user

    $('#registerform').on('submit', function (e) {

        e.preventDefault();
        var formdata = $(this).serialize();
        console.log('dat' + formdata);
        $("#loader").show();
        var password = $('#password').val();
        var cpassword = $('#confirmpassword').val();
        if (password !== cpassword) {
            swal({
                title: "Error",
                text: "password do not match",
                type: "error",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "OK",
                closeOnConfirm: true
            });
            $('#password').val('');
            $('#confirmpassword').val('');
            $("#loader").hide();
        } else {


            $.ajax({
                url: "{{url('registeruser')}}",
                type: "POST",
                data: formdata,
                dataType: "json",
                success: function (data) {

                    $("#loader").hide();
                    if (data.status == 1) {
                        swal({
                            title: "Error",
                            text: data.message,
                            type: "error",
                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Ok",
                            closeOnConfirm: true
                        });
                    }


                    if (data.status == 1) {
                        swal({
                            title: "Success",
                            text: "You have been registered successfully.Your credentials have been sent to your email.You can login with your credentials.Thank you for choosing ishopElectronics.",
                            type: "success",
                            confirmButtonClass: "btn-success",
                            confirmButtonText: "OK",
                            closeOnConfirm: false
                        },
                        function () {
                            window.location = "{{url('/')}}";
                        });
                    }

                },
                error: function (jXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }



    });


});
