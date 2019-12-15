@extends('layouts.userlayout')
@section('content')
@parent
	<div class="row" id="post-list">
		@include('post_paragraph')
	</div>
@include('modal.edit_post')
@include('modal.del_post')
<script type="text/javascript" src="{{ asset('js/manage_post.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/search_post.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/create_post_row.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/create_post_paragraph.js') }}"></script>
@endsection
