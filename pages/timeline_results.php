<?php

$userDOB = $_GET['dob'];
$events = Timeline_Helper::getEventsFromDB();
$events = Timeline_Helper::addUserSpecificDataToEvents($events, $userDOB);
$eventsByDecade = Timeline_Helper::sortEventsByDecade($events);


$birthDecade = Timeline_Helper::getDecadeFromDate($userDOB);

$categories = array(
	'books',
	'film',
	'music',
	'sport',
	'science',
	'history',
	'death'
);

$bannisterDate = Timeline_Helper::getDateFromNumberOfDaysAfterDob($userDOB, 9175); # Bannister was 9175 days old at first mile.

$dropdownArrow = "<img src='assets/images/down-arrow.png' id='explainer-arrow'/>";
?>

<div id="timeline-explained">
	<p id="expand-explainer" onclick="toggleExplainer()">Wait, what is this? <span id="explainer-arrow"><?php echo $dropdownArrow; ?></span></p>
	<p id="explainer-body">This site calculates on what date events in others' lives would happen, had they been born on the same day as you.<br/><br/>For example, Roger Bannister ran a four-minute mile on his 9,175th day (a little over 25 years old).<br/><br/>For you to do this at the same age would mean running it on <?php echo $bannisterDate; ?>.</p>
</div>

<div id="options-wrapper">
	<?php
	foreach ($categories as $category):
		?>
		<button 
			class="category-toggle"
			id="<?php echo $category; ?>-toggle-btn"
			onclick="toggleCategoryDisplay('<?php echo $category; ?>')"
		>
			<img 
			src="assets/images/<?php echo $category; ?>.svg"
			class="category-button-image"
			/>
			<span class="category-button-label"><?php echo ucfirst($category); ?></span>
		</button>
		<?php
	endforeach;	
	?>
</div>

<div id="timeline-wrapper">
	<?php
	foreach ($eventsByDecade as $decade => $events):
		?>
		
		<p class="decade-label" onclick="toggleDecade(this)" data-decade="<?php echo $decade; ?>">
			<?php echo $decade; ?> 
			<?php echo $dropdownArrow; ?>
		</p>

		<div class="decade-container" id="decade-<?php echo $decade; ?>">
			<?php

			foreach ($events as $event):
				?>
				<div class="timeline-event event-decade-<?php echo $event['decade']; ?> <?php echo $event['category'] . " " . $event['period'] . " " . $event['category'] ?>">
					<p class="event-header">
						<span class="event-date"><?php echo $event['date']; ?></span>: 
						<span class="event-title"><?php echo $event['title']; ?></span>
					</p>
					<p class="event-sub">
						<span class="event-who"><?php echo $event['who']; ?></span>
						<span class="event-sub">(aged <?php echo $event['age']; ?>)</span>
					</p>
				</div>
				<?php
			endforeach;
		?>
		</div>
		<?php
	endforeach;
	?>
</div>

<div id="key-wrapper">
	<div>
		<div class="key-color" id="key-color-orange"></div>
		<span>Past Events</span>
	</div>
	<div>
		<div class="key-color" id="key-color-green"></div>
		<span>Future Events</span>
	</div>
	<div>
		<div class="key-color" id="key-color-blue"></div>
		<span>Date Milestones</span>
	</div>
</div>