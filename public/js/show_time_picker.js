
const checkbox = document.getElementById("publish_at_time")
const block = document.getElementById("publisher_time_line")

checkbox.addEventListener('change', () => {
	block.classList.toggle("disabled")
	time_picker = document.getElementById("publisher_time")
	time_picker.value = ""

	if (checkbox.checked) {
        time_picker.setAttribute("required", "required");
    } else {
        time_picker.removeAttribute("required");
    }
})
