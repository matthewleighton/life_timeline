<?php

require '../vendor/autoload.php';
use Carbon\Carbon;

require '../events.php';

/*
$events = array(
	9115 => array(
		'title' => 'Walk on the moon.',
		'who' => 'Neil Armstrong'
	),
	9999 => array(
		'title' => 'Did a thing',
		'who' => 'Some Dude'
	),
	44724 => array(
		'title' => 'Oldest living person dies',
		'who' => 'Jeanne Calment'
	)
);
*/

$userDOB = $_POST['dob'];

foreach ($events as $id => $event):
	$carbonDOB = new Carbon($userDOB);
	$carbonDOB->addDays($event['days']);

	$events[$id]['date'] = $carbonDOB->format('jS \o\f F, Y');
endforeach;

//echo"<pre>";print_r($events);die;

?>

<div id="timeline-wrapper">

	<?php
	foreach ($events as $days => $event):
		?>
		<div class="timeline-event">
			<p class="event-header">
				<span class="event-date"><?php echo $event['date']; ?></span>: 
				<span class="event-title"><?php echo $event['title']; ?></span>
			</p>
			<p class="event-who">
				<?php echo $event['who']; ?>
			</p>
		</div>
	<?php
	endforeach;
	?>

</div>