
<div class="comments-add" id="comment-form-{{ $record['id'] }}">
	<textarea name="text" required class="comment-text"></textarea>
	<button class="show-comments", onclick="submitComment(event, {{ $record['id'] }})">оправить комментарий</button>
</div>

	