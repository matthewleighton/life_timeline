var originalEventCSS = getOriginalEventCSS();

// Used to return the CSS to default when categories are toggled back to active.
function getOriginalEventCSS() {
	var eventElement = document.getElementsByClassName('timeline-event')[0];
	var eventStyle = window.getComputedStyle(eventElement);
	
	return {
		margin: eventStyle.margin,
		height: eventStyle.height,
		opacity: eventStyle.opacity,
		visibility: eventStyle.visibility
	}
}

function toggleCategoryDisplay(toggleButton) {
	var category = toggleButton.innerHTML.toLowerCase();
	var eventsInCategory = document.getElementsByClassName(category);
	var initialToggleValue = toggleButton.value;

	if (initialToggleValue == '0') {
		/* Showing events */
		toggleButton.value = '1';

		var newEventOpacityValue = originalEventCSS.opacity;
		var newEventHeightValue = originalEventCSS.height;
		var newEventMarginValue = originalEventCSS.margin;
		var newEventVisibility = originalEventCSS.visibility;


	} else {
		/* Hiding events */
		toggleButton.value = '0';
		
		var newEventOpacityValue = '0';
		var newEventHeightValue = '0';
		var newEventMarginValue = '-20';
		var newEventVisibility = 'hidden';
	}

	for (var i = 0; i < eventsInCategory.length; i++) {
		var event = eventsInCategory[i];
		event.style.opacity = newEventOpacityValue;
		event.style.maxHeight = newEventHeightValue;
		event.style.marginBottom = newEventMarginValue;
		event.style.visibility = newEventVisibility;
	}
}
