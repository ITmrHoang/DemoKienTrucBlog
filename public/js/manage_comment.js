var SITEURL = 'http://localhost';
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#commentForm").on('click', '#send', function(e) {
        e.preventDefault();
    	$.ajax({
            url: SITEURL + '/comments',
            type: 'POST',
            data: $('#commentForm').serialize(),
            dataType: "json",
            success: function (data) {
                $('#comment-list').append(newCommentRow(data));  
                $('#commentForm').trigger('reset'); 
                $('.delete-comment-btn').ready();
                $('.update-comment-btn').ready();
            },
        });
    });

    $('body').on('click', '.delete-comment-btn', function() {
        var cmt_id = $(this).data('id');
        $.ajax({
            type: 'DELETE',
            url: SITEURL + '/comments/' + cmt_id,
            success: function (data) {
                $('#comment-' + data.id).remove();
            }
        });
    });

    $('body').on('click', '.update-comment-btn', function() {
        var cmt_id = $(this).data('id');
        $('#comment-input-' + cmt_id).removeAttr('readonly');
        $('#update-comment-'+ cmt_id).show();
        $('#cancel-comment-'+ cmt_id).show();
        $('.update-comment-btn').hide();
        $('#comment-input-' + cmt_id).css("background-color", "#69ffd9ba");
        $('#update-comment-'+ cmt_id).click(function() {
            var comment = $('#comment-input-' + cmt_id).val();
            $.ajax({
                type: 'PUT',
                url: SITEURL + '/comments/' + cmt_id,
                data: {
                    'comment': comment,
                },
                success: function (data) {
                    $('#comment-'+ data.id).replaceWith(newCommentRow(data));
                    $('.update-comment-btn').show();
                }
            });
        });
        $('#cancel-comment-'+ cmt_id).on('click', function() {
            $('#comment-input-' + cmt_id).attr('readonly', 'readonly');
            $('#update-comment-'+ cmt_id).hide();
            $('#cancel-comment-'+ cmt_id).hide();
            $('.update-comment-btn').show();
            $('#comment-input-' + cmt_id).css("background-color", "#f8f9fa");
        });
    });
});

function newCommentRow(data) {
    var user_comment = $('#login-user-name').html();
    var commentRow =    '<div id="comment-'+ data.id + '">'
    commentRow +=           '<strong>'+ user_comment +':</strong><input class="mt-1 form-control" id="comment-input-'+ data.id + '" value="'+ data.comment +'" type="text" readonly="" name="comment">';
	commentRow +=           '<span class="float-right mr-3" style="font-size:13px; margin-top:-2px">';
	commentRow +=	            '<span class="small delete-comment-btn action-comment-btn" data-id="'+ data.id +'">Delete</span> &nbsp';
    commentRow +=	            '<span class="small update-comment-btn action-comment-btn" data-id="'+ data.id +'">Update</span>';
    commentRow +=           '</span>';
    commentRow +=           '<br>';
    commentRow +=           '<input class="float-right btn-outline-primary mt-1"style="display:none" id="update-comment-'+ data.id +'" type="submit" value="update">';
	commentRow +=	        '<input class="float-right btn-outline-primary mt-1 mr-1"style="display:none" id="cancel-comment-'+ data.id +'" type="button" value="cancel"></input>';
    commentRow +=       '</div>'
    return commentRow;
};