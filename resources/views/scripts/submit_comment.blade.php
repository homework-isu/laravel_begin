<script>
	function submitComment(event, record_id, token) {

		event.preventDefault();

		const form = document.getElementById('comment-form-' + record_id)
		console.log(form)
		const text = form.querySelector('[name="text"]').value

		var formData = new FormData()
		formData.append('record_id', record_id)
		formData.append('text', text)

		var xhr = new XMLHttpRequest()
		xhr.open("POST", "{{ route('comment.create') }}", true)
		xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}')

		xhr.onreadystatechange = function () {
			if (xhr.readyState === 4) {
				if (xhr.status === 200) {
					console.log(xhr.responseText)
					setToIdCommentsCount(record_id)
					update_comments(record_id)
				} else {
					console.error('Ошибка при отправке комментария:', xhr.statusText)
				}
			}
		};

		xhr.send(formData)
	}
</script>