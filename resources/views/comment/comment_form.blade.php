<form class="form-group" id="commentForm">
	<input 	class="form-control" type="text" name="comment" placeholder="viết comment của bạn ...">
	<input  class="float-right btn-outline-primary mt-1" hidden name="post_id" value="{{$post->id}}">
	<input  class="float-right btn-outline-primary mt-1" hidden name="user_id" value="{{Auth::id()}}">
	<input  class="float-right btn-outline-primary mt-1" id="send" type="submit" value="send">
</form>
<script src="{{ asset('js/manage_comment.js') }}"></script>
