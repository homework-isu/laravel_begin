@extends('layouts.main_with_records')
@section('content')

	@foreach ($records as $record)
		@include('record.record_template_with_comments', ['record' => $record])
	@endforeach
@endsection

@section('custom_js')
	<script>


		var recordElements = document.querySelectorAll('.record');
		var route = '/comments/count/'
		recordElements.forEach(function(element) {
			console.log(element.id)
			var xhr = new XMLHttpRequest();
			xhr.open('GET', route + element.id , true);
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4 && xhr.status == 200) {
					var data = JSON.parse(xhr.responseText);
					console.log(data);
					var comments_block = element.querySelector('.comments_block');
					comments_block.querySelector('.comments_count').innerHTML = data['count']
				}

			};
			xhr.send();
		});
		console.log('Update comments count')

		function submitComment(event, record_id) {

			event.preventDefault();

			console.log('new comment')
			const form = document.getElementById('comment_form_' + record_id)
			console.log(form)
			const text = form.querySelector('[name="text"]').value
			console.log(text)

			// // Создание объекта FormData для передачи данных формы
			var formData = new FormData();
			formData.append('record_id', record_id);
			formData.append('text', text);

			var xhr = new XMLHttpRequest();
			xhr.open("POST", "{{ route('create_comment') }}", true);
			xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

			xhr.onreadystatechange = function () {
				if (xhr.readyState === 4) {
					if (xhr.status === 200) {
						// Обработка успешного ответа
						var data = JSON.parse(xhr.responseText);
						console.log(data);

					} else {

						console.error('Ошибка при отправке комментария:', xhr.statusText);
					}
				}
			};

			xhr.send(formData);
		}

		function show_comments(event, record_id) {
			event.preventDefault();

			const container = document.getElementById(record_id)
			const check_comments = document.getElementById('comments_block_' + record_id)
			if (check_comments) {
				check_comments.remove()
				event.target.innerText = "показать комментарии"
				return;
			}
			event.target.innerText = "скрыть комментарии"
			var formData = new FormData();
			formData.append('record_id', record_id);

			var xhr = new XMLHttpRequest();
			xhr.open("GET", "/comments/" + record_id, true);
			// xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
			const comments_block = document.createElement('div');
			comments_block.className  = 'comments';
			comments_block.id  = 'comments_block_' + record_id;
			container.appendChild(comments_block);
			xhr.onreadystatechange = function () {
				if (xhr.readyState === 4) {
					if (xhr.status === 200) {
						var data = JSON.parse(xhr.responseText);
						console.log(data);
						for (var i in data) {
							console.log(data[i]);
							const comment = document.createElement('div');
							comment.className = 'comment';
							const comment_text = document.createElement('span');
							const comment_author = document.createElement('span');
							const comment_date = document.createElement('span');

							comment_text.textContent = data[i]['text']
							comment_author.textContent = data[i]['username']

							const rawDate = data[i]['created_at'];
							const formattedDate = new Date(rawDate).toISOString().replace('T', ' ').substring(0, 19);

							comment_date.textContent = formattedDate;

							comment_text.className = 'comment_text'
							comment_author.className = 'comment_author'
							comment_date.className = 'comment_date'
							
							comment.appendChild(comment_author)
							comment.appendChild(comment_text)
							comment.appendChild(comment_date)

							comments_block.appendChild(comment);
						}
					} else {
						// Обработка ошибки
						console.error('Ошибка при отправке комментария:', xhr.statusText);
					}
					
				}
			};

			xhr.send(formData);
			}




	</script>
@endsection