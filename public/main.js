window.onload = function() {
	createCategoryToggleListeners();
}

function createCategoryToggleListeners() {
	var categoryToggleButtons = document.getElementsByClassName('category-toggle');
	for(var i = 0; i < categoryToggleButtons.length; i++) {
		var btn = categoryToggleButtons[i];
		btn.onclick = function(e) {
			alert('clicked category toggle');
			//console.log(e);
		}
	}
}