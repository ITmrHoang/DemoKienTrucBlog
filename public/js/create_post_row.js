function newPostRow(data, row_id) {
    console.log(data);
    var page_number = $('#page-number').val();
    var row =   '<tr class="text-center" id="post-row-'+ data.id +'">'
    row +=          '<td id="post-id-'+ data.id +'" data-id="'+ page_number +'> '+ row_id +' </td>';
    row +=          '<td> '+ data.id +' </td>';
    row +=          '<td> '+ data.title +' </td>';
    row +=          '<td>';
    row +=              '<textarea style="max-width:100%; max-height:100px; border:none" readonly>'+ data.content +'</textarea>';
    row +=          '</td>';
    row +=          '<td> '+ data.created_at +' </td>';
    row +=          '<td>';
    row +=              '<a id="show_post" href="posts/'+ data.id +'" class="btn  btn-success show-post-btn" data-toggle="modal" data-target="#formModalShowPost" data-id="'+ data.id +'"><i class="fas fa-eye"></i></a>';
    row +=              ' ';
    row +=              '<a id="edit_post" class="btn btn-warning edit-post-btn" data-toggle="modal" data-target="#formModalEditPost" data-id="'+ data.id +'"><i class="fas fa-edit"></i></a>';
    row +=              ' ';
    row +=              '<button class="btn btn-danger delete-post-btn" data-id="'+ data.id +'" data-toggle="modal" data-target="#confirmDelPost"><i class="fas fa-trash"></i></button>';
    row +=              ' ';
    row +=              '<a id="view" href="" class="btn btn-primary" data-id="'+ data.id +'"><i class="fas fa-expand"></i></a>';
    row +=          '</td>';
    row +=      '</tr>'
    return row;
}