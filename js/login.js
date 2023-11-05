var dialog = document.getElementById('form-bg');
dialog.style.display = "none";
var close = document.getElementById('close-button');

function openForm() {
  document.getElementById("loginForm").style.display = "block";
  document.getElementById("form-bg").style.display = "block";
}

function closeForm() {
  document.getElementById("loginForm").style.display = "none";
  document.getElementById("form-bg").style.display = "none";
}

close.onclick = function close() {
	dialog.style.display = "none";
}

window.onclick = function close(e) {
	if (e.target == dialog) {
		dialog.style.display = "none";
	}
}

document.getElementById("open-button").addEventListener("click", () => {
  document.getElementById("loginemail").focus();
});