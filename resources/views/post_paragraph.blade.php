@if ($posts != null)
    @foreach ($posts as $post)
    <div class="post-paragraph col-4 mt-2" id="post-paragraph-{{ $post->id }}">
        <div class="row p-1" style="height:auto;width:100%;background:#DCDCDC">
        @if (auth()->check())
            @if (auth()->user()->id == $post->user_id)
            <div class="col-12 text-right">
                <button class="edit-post-btn fas fa-edit" id="edit_post" data-toggle="modal" data-target="#formModalEditPost" data-id="{{ $post->id }}"></button>
                <button class="delete-post-btn fas fa-trash" data-toggle="modal" data-target="#confirmDelPost" data-id="{{ $post->id }}"></button>
            </div>
            @endif
        @else
            <div class="col-12 text-right" style="height:21px">
                
            </div>
        @endif
            <a class="row m-1" style="text-decoration: none" href="show/{{$post->id}}">
                <div class="col-5">
                    <img width="100px" height="100px" style="background-position: center center;background-size:cover;" src="{{asset('images/'.$post->image)}}">
                </div>
                <div class="col-7 " style="background:white;height:100px">
                    <div class="row" >
                        <div class="col-12" style=" white-space: nowrap; height:30px;width:80px;overflow:hidden;text-overflow: ellipsis; ">
                            Title : {{$post->title}}
                        </div>
                        
                        <div class="col-12" style=" white-space: nowrap; height:30px;width:80px;overflow:hidden;text-overflow: ellipsis; ">
                            Content : {{$post->content}}
                        </div>
                        <div class="col-12" style=" font-size:10px;white-space: nowrap; height:15px;width:80px;overflow:hidden;text-overflow: ellipsis; ">
                            Create by : {{$post->user['username']}}
                        </div>
                        <div class="col-12" style=" font-size:10px;white-space: nowrap; height:15px;width:80px;overflow:hidden;text-overflow: ellipsis; ">
                            Create at : {{$post->created_at}}
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    @endforeach
    <div class=" col-12 pagination justify-content-center mt-3">
        {{ $posts->appends(request()->input())->links() }}
    </div>
@else
<div>
    <p colspan="7" style="text-align: center">Can't find this Post</p>
</div>
@endif