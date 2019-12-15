@extends('layouts.adminlayout')
@section('content')
@if (session('erro'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
	  <strong>{{ session('erro') }} </strong>
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
@endif
<!-- Breadcrumbs -->
<div class="col-md-12">
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="#">Dashboard</a>
		</li>
		<li class="breadcrumb-item active">Manage Post</li>
	</ol>
</div>
<div class="col-md-12">
	<form action="POST" id="tim" class="float-left">
		@csrf
		@if(isset($_GET['search']))
		<input id="user-search-post" type="search" placeholder="What are you looking for?" title="Search" value="{{ $_GET['search'] }}"/>
		@else
		<input id="user-search-post" type="search" placeholder="What are you looking for?" title="Search"/>
		@endif
	</form>
	<button class="btn btn-primary float-right" id="btnCreatPost" data-toggle="modal" data-target="#formModalCreatePost"><i class="fas fa-plus"></i>
		Create Post</button>
</div>
<br>
<div class="container flex">

</div>
</br>
<div class="col-md-12">
	<div class="table-responsive" id="post-table" style="min-height: 389px;">
		@include('post_table')
	</div>
</div>
@include('modal.del_post')
@include('modal.create_post')
@include('modal.edit_post')
@include('modal.show_post')
<script type="text/javascript" src="{{ asset('js/manage_post.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/search_post.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/create_post_row.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/create_post_paragraph.js') }}"></script>
@endsection