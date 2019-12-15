var SITEURL = 'http://localhost/posts';
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$('#action_creat_post').click(function (e) {
    e.preventDefault();
    var formData = {
        title: $('#title').val(),
        content: $('#content').val(),
    };
    $.ajax({
        url: SITEURL,
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function (data) {
            var row_id = $('#last-row-id').val();
            $('#CreatePostForm')[0].reset();
            $('#formModalCreatePost').modal('hide');
            $('#post-list').prepend(newPostParagraph(data.post));
            $('#post-table-body').prepend(newPostRow(data.post, row_id++));
        },
        error: function (data) {
            err = data.responseJSON.errors;
            $('.error').hide();
            if (err.title != undefined) {
                $('.errorTitle').show().text(err.title[0]);
            }
            if (err.content != undefined) {
                $('.errorContent').show().text(err.content[0]);
            }
        }
    });
});

$('body').on('click', '.delete-post-btn', function (e) {
    var id = $(this).data('id');
    $('#ok_del_post').click(function (e) {
        $.ajax({
            type: 'DELETE',
            url: SITEURL + '/' + id,
            dataType: 'json',
            beforeSend: function () {
                $('#ok_del_post').text('Deleting...');
            },
            success: function (data) {
                setTimeout(function () {
                    $('#confirmDelPost').modal('hide');
                }, 1000);
                $('#post-paragraph-'+ data.id).remove();
                $('#post-row-'+ data.id).remove();
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});

$('body').on('click', '.edit-post-btn', function () {
    $('#edit-image').val('');
    var post_id = $(this).data('id');
    $('#post_id').val(post_id);
    $.ajax({
        type: 'GET',
        url: SITEURL + '/' + post_id,
        dataType: 'json',
        success: function (data) {
            var row_id = $('#post-id-'+ data.id).data('id');
            $('#etitle').val(data.title);
            $('#econtent').val(data.content);
            $('#ecreate_at').val(data.created_at);
            $('#username').val(data.user.username);
            $('#post-image').attr('src', 'images/' + data.image);
            $('#selected-row-id').val(row_id);
        }
    });
});

$('#EditPostForm').on('click', '#action_edit_post', function (e) {
    e.preventDefault();
    var post_id = $('#post_id').val();
    $.ajax({
        type: 'POST',
        url: SITEURL + '/' + post_id,
        data: $('#EditPostForm').serialize(),
        dataType: 'json',
        success: function (data) {
            $('#eform-alert').html('<div class="alert alert-success"> Data Added successfully.</div>');
            setTimeout(function () {
                $('#formModalEditPost').modal('hide');
                $('#eform-alert').html('');
                $('#post-paragraph-'+ data.id).replaceWith(newPostParagraph(data));
                $('#post-row-'+ data.id).replaceWith(newPostRow(data, $('#selected-row-id').val()));
            }, 400);
        },
        error: function (data) {
            var errors = $.parseJSON(data.responseText);
            $('.error').hide();
            if (errors.errors.title != undefined) {
                $('.erroreTitle').show().text(errors.errors.title);
            }
            if (errors.errors.content != undefined) {
                $('.errorContent').show().text(errors.errors.content);
            }
        }
    })
});

$('body').on('click', '.show-post-btn', function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            $('#stitle').html(data.title);
            $('#scontent').html(data.content);
            $('#screate_at').html(data.created_at);
            $('#susername').html(data.user.username);
            $('#sowners').html(data.user.full_name);
            $('#scount').html(count);
        }
    });
});

function choseImg(input) {
    var reader = new FileReader();
    if (input.files && input.files[0]) {
        reader.onload = function (p) {
            $('#post-image').attr('src', p.target.result);
            console.log(p.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    };
};

