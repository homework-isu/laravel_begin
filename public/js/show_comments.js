
function update_comments(record_id) {
	const container = document.getElementById(record_id)
	const check_comments = document.getElementById('comments_block_' + record_id)
	if (!check_comments) {
		return;
	}
	check_comments.remove()
	var formData = new FormData();
	formData.append('record_id', record_id);

	var xhr = new XMLHttpRequest();
	xhr.open("GET", "/comments/" + record_id, true);
	const comments_block = document.createElement('div');
	comments_block.className  = 'comments';
	comments_block.id  = 'comments_block_' + record_id;
	container.appendChild(comments_block);
	xhr.onreadystatechange = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				var data = JSON.parse(xhr.responseText);
				for (var i in data) {
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
	const comments_block = document.createElement('div');
	comments_block.className  = 'comments';
	comments_block.id  = 'comments_block_' + record_id;
	container.appendChild(comments_block);
	xhr.onreadystatechange = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				var data = JSON.parse(xhr.responseText);
				for (var i in data) {
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