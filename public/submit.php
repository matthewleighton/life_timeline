<link rel="stylesheet" type="text/css" href="reset.css">
<link rel="stylesheet" type="text/css" href="timeline.css">
<link href="https://fonts.googleapis.com/css?family=Arimo:400,700" rel="stylesheet">

<?php

require '../vendor/autoload.php';
use Carbon\Carbon;

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

$userDOB = $_POST['dob'];

foreach ($events as $days => $event):
	$carbonDOB = new Carbon($userDOB);
	$carbonDOB->addDays($days);

	$events[$days]['date'] = $carbonDOB->format('jS \o\f F, Y');
endforeach;
//var_dump($events);

?>

<div id="timeline-wrapper">

	<h1 id="timeline-title">Life Timeline</h1>

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
