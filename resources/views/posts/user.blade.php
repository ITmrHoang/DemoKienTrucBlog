@extends('layouts.adminlayout')
@section('content')
<!-- Breadcrumbs -->
<div class="col-md-12">
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="#">Dashboard</a>
		</li>
		<li class="breadcrumb-item active">Manage User</li>
	</ol>
</div>
<div class="col-md-12">
	<br>
	<a href="javascript:void(0)" class="btn btn-info ml-3 float-right" id="create-new-user">Add New</a>
	<br>
</div>
<br>
<div class="col-md-12">
	<div class="table-responsive">
		<table class="table table-hover " id="user_datatable">
			<thead>
				<tr>
					<th>ID</th>
					<th>No</th>
					<th>AVATAR</th>
					<th>Username</th>
					<th>Name</th>
					<th>Email</th>
					<th>Role</th>
					<th>Age</th>
					<th>Created at</th>
					<th>Action</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
@include('modal.form_user')
@include('modal.confirm_delete')

<script src="{{ asset('js/manage_user.js') }}"></script>
@endsection