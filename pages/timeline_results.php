<?php

$userDOB = $_GET['dob'];
$events = Timeline_Helper::getEventsFromDB();
$events = Timeline_Helper::addUserSpecificDataToEvents($events, $userDOB);

$categories = array(
	'books',
	'film',
	'music',
	'sport',
	'science',
	'history',
	'death'
);
?>

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

<?php
$bannisterDate = Timeline_Helper::getDateFromNumberOfDaysAfterDob($userDOB, 9175);
?>

<div id="timeline-explained">
	<p id="expand-explainer" onclick="toggleExplainer()">Wait, what is this? <img src="assets/images/down-arrow.png" id="explainer-arrow"/></</p>
	<p id="explainer-body">This site calculates on what date events in others' lives would happen, had they been born on the same day as you.<br/><br/>For example, Roger Bannister ran a four-minute mile on his 9,175th day (a little over 25 years old).<br/><br/>For you to do this at the same age would mean running it on <?php echo $bannisterDate; ?>.</p>
</div>

<div id="timeline-wrapper">

	<?php
	foreach ($events as $days => $event):
		?>
		<div class="timeline-event <?php echo $event['category'] . " " . $event['period'] . " " . $event['category'] ?>">
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