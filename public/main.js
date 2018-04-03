function toggleCategoryDisplay(toggleButton) {
	var category = toggleButton.innerHTML.toLowerCase();
	var eventsInCategory = document.getElementsByClassName(category);
	var initialToggleValue = toggleButton.value;

	console.log(initialToggleValue);


	if (initialToggleValue == '0') {
		toggleButton.value = '1';
		var newEventDisplayValue = 'block';
	} else {
		toggleButton.value = '0';
		var newEventDisplayValue = 'none';
	}


	for (var i = 0; i < eventsInCategory.length; i++) {
		var event = eventsInCategory[i];
		event.style.display = newEventDisplayValue;
	}

	//toggleButton.value = initialToggleValue == '0' ? '1' : '0';
}
