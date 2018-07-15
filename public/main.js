var originalEventCSS = getOriginalCSS('timeline-event');
var originalDecadeCSS = getOriginalCSS('decade-label');
var categoryToggleStatus = {};
var explainerStatus = 0;
var explainerArrowRotation = 0;

// Used to return the CSS to default when hidden elements are toggled back to active.
function getOriginalCSS(className) {
	var element = document.getElementsByClassName(className)[0];
	var elementStyle = window.getComputedStyle(element);
	
	return {
		height: elementStyle.height,
		marginBottom: elementStyle.marginBottom,
		margin: elementStyle.margin,
		maxHeight: elementStyle.maxHeight,
		opacity: elementStyle.opacity,
		visibility: elementStyle.visibility
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

	toggleDecadeMarkerVisibility();
}

// Hide a decade marker if all its events have been hidden by the category toggle.
function toggleDecadeMarkerVisibility() {
	var decadeMarkers = document.getElementsByClassName('decade-marker');

	// Loop over each decade.
	for (var i = 0; i < decadeMarkers.length; i++) {
		
		var decade = decadeMarkers[i].textContent;
		var eventsInDecade = document.getElementsByClassName('event-decade-' + decade);

		// Hide the decade if EVERY event within it has been hidden.
		for (var n = 0; n < eventsInDecade.length; n++) {
			if (eventsInDecade[n].style.visibility != 'hidden') {
				/* Show decade marker */
				decadeMarkers[i].style.visibility = originalDecadeCSS.visibility;
				decadeMarkers[i].style.marginBottom = originalDecadeCSS.marginBottom;
				decadeMarkers[i].style.maxHeight = originalDecadeCSS.maxHeight;
				decadeMarkers[i].style.opacity = originalDecadeCSS.opacity;
				break;
			}

			if (n == eventsInDecade.length - 1) {
				/* Hide decade marker */
				decadeMarkers[i].style.visibility = 'hidden';
				decadeMarkers[i].style.marginBottom = '-20px';
				decadeMarkers[i].style.maxHeight = '0';
				decadeMarkers[i].style.opacity = '0';
			}
		}
	}
}

function toggleExplainer() {
	var explainerBody  = document.getElementById('explainer-body');
	var explainerArrow = document.getElementById('explainer-arrow').firstChild;

	explainerArrowRotation += 180;
	
	if (explainerStatus == 0) {
		explainerBody.style.maxHeight = '210px';
		explainerArrow.style.transform = 'rotate(' + explainerArrowRotation +  'deg)';
		explainerStatus = 1;
	} else {
		explainerBody.style.maxHeight = '0';
		explainerArrow.style.transform = 'rotate(' + explainerArrowRotation +  'deg)';
		explainerStatus = 0;
	}
}

function toggleDecade(decadeLabel) {
	var decadeArrow 		 = decadeLabel.getElementsByTagName('img')[0];
	var decade 				 = decadeLabel.dataset.decade;
	var decadeContainer 	 = document.getElementById('decade-' + decade);
	var originalDecadeStatus = decadeArrow.style.transform == 'rotate(180deg)' ? false : true; // True means the decade is visible.

	if (originalDecadeStatus) {
		decadeContainer.style.display = 'none';
		decadeArrow.style.transform = 'rotate(180deg)';
	} else {
		decadeContainer.style.display = 'block';
		decadeArrow.style.transform = 'rotate(0deg)';
	}
}