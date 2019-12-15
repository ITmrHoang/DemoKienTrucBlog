
$('#user-search-post').on('keyup', function() {
    var search = $('#user-search-post').val();
    $.ajax({
        url: "/posts",
        type: 'GET',
        data: {
            'search': search,
        },
        success: function(data) {
            $('#post-table').empty();
            $('#post-table').html(data.html);
        }
    })
});

$('#home-search-post').on('keyup', function() {
    var search = $('#home-search-post').val();
    $.ajax({
        url: "/index",
        type: 'GET',
        data: {
            'search': search,
        },
        success: function(data) {
            $('#post-list').empty();
            $('#post-list').html(data.html);
        }
    })
});
