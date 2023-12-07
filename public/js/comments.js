function make_comments_visibale(event, note_id) {
	event.preventDefault()
	const container = document.getElementById(note_id);
	const comments = container.querySelector('.comments')
	comments.classList.toggle('hidden')
}