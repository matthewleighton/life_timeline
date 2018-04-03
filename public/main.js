var originalEventCSS = getOriginalEventCSS();
var categoryToggleStatus = {};

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

function toggleCategoryDisplay(category) {
	var eventsInCategory = document.getElementsByClassName(category);
	var initialToggleValue = categoryToggleStatus[category];
	var toggleButton = document.getElementById(category + "-toggle-btn");

	if (initialToggleValue === false) {
		/* Showing events */
		categoryToggleStatus[category] = true;

		var newEventOpacityValue = originalEventCSS.opacity;
		var newEventHeightValue = originalEventCSS.height;
		var newEventMarginValue = originalEventCSS.margin;
		var newEventVisibility = originalEventCSS.visibility;

		toggleButton.style.filter = "";

	} else {
		/* Hiding events */
		categoryToggleStatus[category] = false;
		
		var newEventOpacityValue = '0';
		var newEventHeightValue = '0';
		var newEventMarginValue = '-20';
		var newEventVisibility = 'hidden';

		toggleButton.style.filter = "grayscale(100%)";
	}

	for (var i = 0; i < eventsInCategory.length; i++) {
		var event = eventsInCategory[i];
		event.style.opacity = newEventOpacityValue;
		event.style.maxHeight = newEventHeightValue;
		event.style.marginBottom = newEventMarginValue;
		event.style.visibility = newEventVisibility;
	}
}
