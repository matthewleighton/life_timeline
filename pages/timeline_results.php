<?php
require '../timeline_helper.php';

$userDOB = $_POST['dob'];
$events = Timeline_Helper::getEventsFromDB();
$events = Timeline_Helper::addUserSpecificDataToEvents($events, $userDOB);

$types = array(
	'death',
	'books',
	'film',
	'music',
	'sport',
	'history',
	'science'
);
?>

<div id="options-wrapper">
	<?php
	foreach ($types as $type):
		?>
		<span class="type-toggle toggle-on"><?php echo ucfirst($type); ?></span>
		<?php
	endforeach;	
	?>
</div>

<div id="timeline-wrapper">

	<?php
	foreach ($events as $days => $event):
		//echo "<pre>";print_r($event);die;
		?>
		<div class="timeline-event <?php echo $event['type']; ?>">
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