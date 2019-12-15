@if ($posts != null)
    <table class="table table-hover text-center table-bordered" id="post_datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Post</th>
                @if(auth()->user()->level == 'admin')
                <th>Owners</th>
                @endif
                <th>Title</th>
                <th>Content</th>
                <th>Created at</th>
                <th>Action</th>
            </tr>
        </thead>
        <input id="selected-row-id" type="hidden" value="">
        <input id="last-row-id" type="hidden" value="{{ $posts->total() }}">
        <input id="page-number" type="hidden" value="{{ 9 * ($posts->currentPage() - 1) }}">
        <tbody id="post-table-body">
            @php
                $number = 9 * ($posts->currentPage() - 1)
            @endphp
            @foreach ($posts as $key => $post)
            <tr id="post-row-{{ $post->id }}">
                <td id="post-id-{{ $post->id }}" data-id="{{ $key + 1 + $number }}"> {{ $key + 1 + $number }} </td>
                <td> {{$post->id}} </td>
                @if(auth()->user()->level == 'admin')
                <td> {{$post->user['username']}} </td>
                @endif
                <td> {{$post->title}} </td>
                <td> 
                    <textarea style="max-width:100%; max-height:100px; border:none" readonly>{{$post->content}}</textarea>
                </td>
                <td> {{$post->created_at}} </td>
                <td>
                    <a id="show_post" href="{{route('posts.show',$post->id)}} " class="btn btn-success show-post-btn" data-toggle="modal" data-target="#formModalShowPost" data-id="{{ $post->id }}"><i class="fas fa-eye"></i></a>

                    <a id="edit_post" class="btn btn-warning edit-post-btn" data-toggle="modal" data-target="#formModalEditPost" data-id="{{ $post->id }}"><i class="fas fa-edit"></i></a>

                    <button class="btn btn-danger delete-post-btn" data-id="{{ $post->id }}" data-toggle="modal" data-target="#confirmDelPost"><i class="fas fa-trash"></i></button>

                    <a id="view" href="" class="btn btn-primary" data-id="{{ $post->id }}"><i class="fas fa-expand"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination justify-content-center">
        {{ $posts->appends(request()->input())->links() }}
    </div>
@else
<tr>
    <td colspan="7" style="text-align: center">Can't find this Post</td>
</tr>
@endif