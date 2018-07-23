if (onTimelinePage()) {
	var originalEventCSS = getOriginalCSS('timeline-event');
	var originalDecadeCSS = getOriginalCSS('decade-label');
	var categoryToggleStatus = {};
	var explainerStatus = 0;
	var explainerArrowRotation = 0;

	for (var i = categories.length - 1; i >= 0; i--) {
		categoryToggleStatus[categories[i]] = true;
	}
} else if (onDobPage()) {
	var dobInput = document.getElementById('dob-input');
	dobInput.focus();
	dobInput.select();
}

// Return true if the user is on the timeline page.
function onTimelinePage() {
	return document.getElementById('timeline-wrapper') ? true : false;
}

// Return true if the user is on the DOB entry page.
function onDobPage() {
	return document.getElementById('dob-form') ? true : false;
}

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
	};
}

function toggleCategoryDisplay(category, state) {
	
	var initialToggleValue;
	
	// If the initialToggleValue is ON, we'll be turning the category off.
	// A state value can be used to fake the initialToggleValue.
	if (state === true) {
		initialToggleValue = false;
	} else if (state === false) {
		initialToggleValue = true;
	} else {
		 initialToggleValue = categoryToggleStatus[category];
	}

	if (category == "all") {
		// The new desired state is the opposite of the initialToggleValue.
		var massState = (initialToggleValue === true) ? false : true;

		for (var i = categories.length - 1; i >= 0; i--) {
			if (categories[i] != 'all') {
				toggleCategoryDisplay(categories[i], massState);
			}
		}

		categoryToggleStatus['all'] = massState;
		changeCategoryButtonColor('all', massState);

		return;
	}

	var eventsInCategory = document.getElementsByClassName(category);
	

	var newEventOpacityValue,
		newEventHeightValue, 
		newEventMarginValue,
		newEventVisibility;

	if (initialToggleValue === false) {
		/* Showing events */
		categoryToggleStatus[category] = true;

		newEventOpacityValue = originalEventCSS.opacity;
		newEventHeightValue = originalEventCSS.height;
		newEventMarginValue = originalEventCSS.margin;
		newEventVisibility = originalEventCSS.visibility;

		changeCategoryButtonColor(category, true);

	} else {
		/* Hiding events */
		categoryToggleStatus[category] = false;
		
		newEventOpacityValue = '0';
		newEventHeightValue = '0';
		newEventMarginValue = '-20';
		newEventVisibility = 'hidden';

		changeCategoryButtonColor(category, false);
	}

	/* Applying new styling to hide/show events */
	for (var i = 0; i < eventsInCategory.length; i++) {
		var event = eventsInCategory[i];
		event.style.opacity = newEventOpacityValue;
		event.style.maxHeight = newEventHeightValue;
		event.style.marginBottom = newEventMarginValue;
		event.style.visibility = newEventVisibility;
	}

	toggleDecadeMarkerVisibility();
}

// Switch a category button between color and black/white.
// State value of true gives color. False gives B&W.
function changeCategoryButtonColor(category, state) {
	var button = document.getElementById(category + "-toggle-btn");
	var filterValue = state ? "" : "grayscale(100%)";

	button.style.filter = filterValue;
}

// Hide a decade marker if all its events have been hidden by the category toggle.
function toggleDecadeMarkerVisibility() {
	var decadeMarkers = document.getElementsByClassName('decade-label');

	// Loop over each decade.
	for (var i = 0; i < decadeMarkers.length; i++) {
		
		var decade = decadeMarkers[i].textContent.trim();
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