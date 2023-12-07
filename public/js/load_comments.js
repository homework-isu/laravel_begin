var recordElements = document.querySelectorAll('.record');
var route = '/comments/count/'

for (var i = 0; i < recordElements.length; i++) {
	setToElementCommentsCount(recordElements[i])
}

function setToIdCommentsCount(id) {
	element = document.getElementById(id)
	setToElementCommentsCount(element)
}

function setToElementCommentsCount(element) {
	var xhr = new XMLHttpRequest();
	console.log(element)
	xhr.open('GET', route + element.id , true);
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && xhr.status == 200) {
			var data = JSON.parse(xhr.responseText);
			var comments_block = element.querySelector('.comments_block');
			comments_block.querySelector('.comments_count').innerHTML = data['count']
		}

	};
	xhr.send();
}