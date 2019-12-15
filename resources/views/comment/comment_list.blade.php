@if($post->comments != null)
	@foreach($post->comments as $comment)
	<div  class="border rounded bg-light mt-5" id="comment-{{ $comment->id }}">
		<strong >{{$comment->user['username']}}:</strong>
		<input id="comment-input-{{ $comment->id }}" class="mt-1 form-control-plaintext" value="{{$comment->comment}}" type="text" readonly name="comment">
		@if(auth()->check())
			@if(auth()->user()->id == $comment->user_id)
			<span class="float-right mr-3" style="font-size:13px; margin-top:-2px">
				<span class="small delete-comment-btn action-comment-btn" data-id="{{ $comment->id }}">Delete</span> &nbsp
				<span class="small update-comment-btn action-comment-btn" data-id="{{ $comment->id }}">Update</span>
			</span>
			@else
			<span class="float-right mr-3" style="font-size:13px; margin-top:-2px; height:19px">
			
			</span>
			@endif
		<br>
		<input class="float-right btn-outline-primary mt-1"style="display:none" id="update-comment-{{ $comment->id }}" type="submit" value="update">
		<input class="float-right btn-outline-primary mt-1 mr-1"style="display:none" id="cancel-comment-{{ $comment->id }}" type="button" value="cancel">
		@endif
	</div>
	@endforeach
@else
 <p>Hãy là người đầu tiên bình luận </p>
@endif
