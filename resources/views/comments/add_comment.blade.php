
	<form action="#" method="#" id="comment_form_{{$id}}" class="comment_form">
		<input name="record_id" type="hidden" value="{{ $id }}" />
		<label for="text">Ваш комментарий:</label>
		<textarea name="text" required></textarea>

		<button type="submit" onclick="submitComment(event, {{ $id }})">Отправить комментарий</button>
	</form>

	