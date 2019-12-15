// var SITEURL = '{{URL::to('')}}';
var SITEURL = 'http://localhost';

$(document).ready(function () {
    console.log(SITEURL);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#user_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: SITEURL + "/users",
            type: 'GET',
        },
        columns: [{
            data: 'id',
            name: 'id',
            'visible': false
        },
        {
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            orderable: false,
            searchable: false
        },
        {
            data: 'avatar',
            name: 'avatar',
            render: function (data, type, full, meta) {
                if (data == null) {
                    return "<img src=" + SITEURL + "/images/avatar.jpg width='80' class='img-thumbnail' />";
                } else {
                    return "<img src=" + SITEURL + "/images/" + data + " width='80' class='img-thumbnail' />";
                }
            },
            orderable: false,
            searchable: false
        },
        {
            data: 'username',
            name: 'username'
        },
        {
            data: 'full_name',
            name: 'full_name'
        },
        {
            data: 'email',
            name: 'email'
        },
        {
            data: 'level',
            name: 'level',
            orderable: false
        },
        {
            data: 'age',
            name: 'age'
        },
        {
            data: 'created_at',
            name: 'created_at',
        },
        {
            data: 'action',
            name: 'action',
            orderable: false
        },
        ],
        order: [
            [0, 'desc']
        ]
    });

    /*  When user click add user button */
    $('#create-new-user').click(function () {
        $('#showiamge').hide();
        $('.error').hide();
        $('#avatar').val('');
        $('#modal-title').html("Add New User");
        $('#form-alert').html('');
        $('#action_button').val("Add");
        $('#action').val("Add");
        $('#username').val('').prop('readonly', false);
        $('#user_id').val('');
        $('#age').val('');
        $('#full_name').val('');
        $('#email').val('');
        $('#formModal').modal('show');
    });
    // $('#create-new-user').click(function () {
    //     $('#btn-save').val("create-user");
    //     $('#user_id').val('');
    //     $('#userForm').trigger("reset");
    //     $('#userCrudModal').html("Add New User");
    //     $('#ajax-crud-modal').modal('show');
    // });

    /* When click edit user */
    $('body').on('click', '.edit-user', function () {
        $('#showiamge').hide();
        $('.error').hide();
        $('#store_image').html("");
        $('#avatar').val('');
        $('#modal-title').html("Edit User");
        $('#form-alert').html('');
        var user_id = $(this).data('id');
        $.get('/users/' + user_id + '/edit', function (data) {
            $('#action_button').val('Edit');
            $('#action').val('Edit');
            $('#form-alert').html('');
            $('#formModal').modal('show');
            $('#user_id').val(data.id);
            $('#username').val(data.username).prop('readonly', true);
            // $('#username').val(data.username).attr('readonly', true);
            $('#age').val(data.age);
            $('#full_name').val(data.full_name);
            $('#email').val(data.email);
            if (data.avatar != null) {
                $('#store_image').html("<img src=" + SITEURL + "/images/" + data.avatar + " width='200' class='img-thumbnail' />");
                $('#store_image').append("<input type='hidden' name='hidden_image' value='" + data.avatar + "' />");
            }
        })
    });

    $('body').on('click', '.delete', function () {

        // $(document).on('click', '.delete', function(){
        user_id = $(this).attr('data-id');
        // var user_id = $(this).data('id');
        console.log(user_id);
        $('#ok_button').text('OK');
        $('#confirmModal').modal('show');
    });

    $('#ok_button').click(function () {
        $.ajax({

            url: SITEURL + "/users/" + user_id,
            type: "delete",
            beforeSend: function () {
                $('#ok_button').text('Deleting...');
            },
            success: function (data) {
                setTimeout(function () {
                    $('#confirmModal').modal('hide');
                    $('#user_datatable').DataTable().ajax.reload();
                }, 1000);
            }
        });
    });

    // var user_id = $(this).data("id");
    // var check = confirm("Are You sure want to delete !");

    // $.ajax({
    //       type: "get",
    //       url: SITEURL + "/users/delete/"+user_id,
    //       success: function (data) {
    //       var oTable = $('#user_datatable').dataTable();
    //       oTable.fnDraw(false);
    //       },
    //       error: function (data) {
    //           console.log('Error:', data);
    //       }
    //   });
    // });
});
//form
$('#userForm').on('submit', function (event) {
    event.preventDefault();
    $('.error').hide();
    if ($('#action').val() == 'Add') {
        $.ajax({
            url: SITEURL + '/users',
            // method:"POST",
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function (data) {
                // var html = '';
                // if (data.errors) {
                //     html = '<div class="alert alert-danger">';
                //     for (var count = 0; count < data.errors.length; count++) {
                //         html += '<p>' + data.errors[count] + '</p>';
                //     }
                //     html += '</div>';
                // }
                if (data.success) {
                    html = '<div class="alert alert-success">' + data.success + '</div>';
                    $('#userForm')[0].reset(); // reset form
                    $('#user_datatable').DataTable().ajax.reload(); // load laij table
                }
                $('#form-alert').html(html);
                var oTable = $('#user_datatable').dataTable();
                oTable.fnDraw(false); // fnDraw() ham load lai table
                setTimeout(function () {
                    $('#formModal').modal('hide');
                    // $('#user_datatable').DataTable().ajax.reload();
                }, 1500);
            },
            error: function (data) {
                console.log(data.responseJSON.errors.username[0]);
                console.log(data);
                var errors = $.parseJSON(data.responseText); // dể dọc dữ liệu JSON = Jquery.parseJSON()= parse.JSON() của js
                // responseText  responseText trả về dữ liệu dưới dạng chuỗi và bạn có thể sử dụng nó  nếu dữ liệu trả về k phải dạng XML
                // Nếu Response từ một Server là dữ liệu dưới dạng XML, bạn nên sử dụng thuộc tính responseXML
                console.log(errors.errors.username);
                $('.error').hide();
                if (errors.errors.username != undefined) {
                    $('.errorUsername').show().text(errors.errors.username);
                }
                if (errors.errors.email != undefined) {
                    $('.errorEmail').show().text(errors.errors.email);
                }
                if (errors.errors.full_name != undefined) {
                    $('.errorFullName').show().text(errors.errors.full_name);
                }
                if (errors.errors.age != undefined) {
                    $('.errorAge').show().text(errors.errors.age);
                }
                if (errors.errors.image != undefined) {
                    $('.errorIamge').show().text(errors.errors.image);
                }
                var html = '';
                if (data) {
                    html = '<div class="alert alert-danger">';

                    html += '<p> có lỗi xảy ra </p>';

                    html += '</div>';
                }
                $('#form-alert').html(html);
            }
        })
    }

    if ($('#action').val() == "Edit") {

        var user_id = $('#user_id').val();
        $.ajax({
            // url: SITEURL + '/users/' + user_id,
            // method: "PATCH",
            // data: $('#userForm').serialize(),
            // // contentType: false, //Kiểu nội dung của dữ liệu được gửi lên server. dung khi su ndung formdata de k bij header "Content-Type":
            // cache: false, // browser không lưu cache các trang được request.
            // processData: false, // ngan jquery form chuyển dổi dữ liệu thanh chuỗi truy vấn
            // dataType: "json",
            url: SITEURL + '/users/update',
            // method:"POST",
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function (data) {
                // console.log(data);
                var html = '';
                // if (data.errors) {
                //     html = '<div class="alert alert-danger">';
                //     for (var count = 0; count < data.errors.length; count++) {
                //         html += '<p>' + data.errors[count] + '</p>';
                //     }
                //     html += '</div>';
                // }
                if (data.success) {
                    html = '<div class="alert alert-success">' + data.success + '</div>';
                    $('#store_image').html('');
                    $('#user_datatable').DataTable().ajax.reload();
                }
                $('#form-alert').html(html);
                setTimeout(function () {
                    $('#formModal').modal('hide');
                    // $('#user_datatable').DataTable().ajax.reload();
                }, 1500);
            },
            error: function (data) {
                console.log(data);
                var errors = $.parseJSON(data.responseText); // dể dọc dữ liệu JSON = Jquery.parseJSON()= parse.JSON() của js
                // responseText  responseText trả về dữ liệu dưới dạng chuỗi và bạn có thể sử dụng nó  nếu dữ liệu trả về k phải dạng XML
                // Nếu Response từ một Server là dữ liệu dưới dạng XML, bạn nên sử dụng thuộc tính responseXML
                console.log(errors.errors.username);
                $('.error').hide();
                if (errors.errors.username != undefined) {
                    $('.errorUsername').show().text(errors.errors.username);
                }
                if (errors.errors.email != undefined) {
                    $('.errorEmail').show().text(errors.errors.email);
                }
                if (errors.errors.full_name != undefined) {
                    $('.errorFullName').show().text(errors.errors.full_name);
                }
                if (errors.errors.age != undefined) {
                    $('.errorAge').show().text(errors.errors.age);
                }
                if (errors.errors.image != undefined) {
                    $('.errorIamge').show().text(errors.errors.image);
                }
                var html = '';
                if (data) {
                    html = '<div class="alert alert-danger">';

                    html += '<p> có lỗi xảy ra </p>';

                    html += '</div>';
                }
                $('#form-alert').html(html);
            }
        });
    }
});
//  show image
var loadFile = function (event) {
    var output = document.getElementById('showiamge');
    output.src = URL.createObjectURL(event.target.files[0]);
    $('#store_image').hide();
    $('#showiamge').show();
};
// c2
  //   var loadFile = function(event) {
  //   var reader = new FileReader();
  //   reader.onload = function(){
  //     var output = document.getElementById('output');
  //     output.src = reader.result;
  //   };
  //   reader.readAsDataURL(event.target.files[0]);
  // };
// load anh
	// if ($("#userForm").length > 0) {
	//       $("#userForm").validate({

	//      submitHandler: function(form) {

	//       var actionType = $('#action_button').val();
	//       $('#action_button').html('Sending..');

	//       $.ajax({
	//           data: $('#userForm').serialize(),//serialize() jq lay cac gia tri trong form
	//           url: SITEURL + "/users",
	//           type: "POST",
	//           dataType: 'json',
	//           success: function (data) {
	//           	var html = '';
	// 		     if(data.errors)
	// 		     {
	// 		      html = '<div class="alert alert-danger">';
	// 		      for(var count = 0; count < data.errors.length; count++)
	// 		      {
	// 		       html += '<p>' + data.errors[count] + '</p>';
	// 		      }
	// 		      html += '</div>';
	// 		     }
	// 		     if(data.success)
	// 		     {
	// 		      html = '<div class="alert alert-success">' + data.success + '</div>';
	// 		      $('#userForm')[0].reset();
	// 		      $('#laravel_datatable').DataTable().ajax.reload();
	// 		     }
	// 		     $('#userForm #alert').append(html);
	//               // $('#userForm').trigger("reset");
	//               // $('#formModal').modal('hide');
	//               // $('#action_button').html('Save Changes');
	//               // var oTable = $('#laravel_datatable').dataTable();
	//               // oTable.fnDraw(false);

	//           },
	//           error: function (data) {
	//               console.log('Error:', data);
	//               $('#btn-save').html('Save Changes');
	//           }
	//       });
	//     }
	//   })
	// }
	// });
