@extends('layouts.userlayout')
@section('content')
@parent
<div class="container-fluid row">
    <div class="col-8">
        <div class="col-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/home">Post</a>
                </li>
                <li class="breadcrumb-item active">Post No.{{$post->id}}</li>
            </ol>
        </div>
        <div class="col-12 text-center">
            <img style="width:600px;height: 150px;object-fit: contain;" src="{{asset('images/'.$post->image)}}"
                class=" img-fluid img-thumbnail" alt="Image Post">
        </div>
        <div class="col-12 mt-2">
            <p> <strong class="h2">Title</strong> <small class="h5">: {{$post->title}} </small></p>
            <p><strong>Createby:</strong> {{ $post->user->username }}</p>
            <h3>Content:</h3>
            <div class="border pl-2 pr-1" style="min-height:100px">
                <p class="">{{$post->content}} </p>
            </div>
        </div>
        <hr>
        <div class="col-12">
            @include('comment.comment_form')
        </div>
        <div class="col-11 offset-1 mt-5" id="comment-list">
        </div>
        <button class="btn btn-link" id="btnCmtList" type="button" data-toggle="collapse" data-target="#collapsecCmt"
            aria-expanded="false" aria-controls="collapseExample">
            <i class="fa fa-angle-double-down"></i> show last comments
        </button>
        <div class="col-11 offset-1 mt-5 collapse" id="collapsecCmt">
            @include('comment.comment_list')
        </div>

    </div>
    <div class="col-3 offset-1 text-center border-left">
        <h2>Some new Post</h2>
    </div>

</div>
<script type="text/javascript">
    $("#btnCmtList").click(function () {
        check = $("#btnCmtList").attr('aria-expanded')
        if (check == 'false') {
            $('#btnCmtList').html('<i class="fa fa-angle-double-up"></i> hiden last comments');
        } else {
            $('#btnCmtList').html('<i class="fa fa-angle-double-down"></i> show last comments');
        }
    })
</script>
@endsection
