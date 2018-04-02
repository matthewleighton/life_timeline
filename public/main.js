window.onload = function() {
	var typeToggleButtons = document.getElementsByClassName('type-toggle');
	for(var i = 0; i < typeToggleButtons.length; i++) {
		var btn = typeToggleButtons[i];
		btn.onclick = function(e) {
			alert('clicked type toggle');
			//console.log(e);
		}
	}
}