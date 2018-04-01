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


foreach ($events as $days => $event):
	?>
	<h2><?php echo $event['title']; ?></h2>
	<h3><?php echo $event['date']; ?></h3>
	<p>(<?php echo $event['who']; ?>)</p>
	<br/><br/>
	<?php
endforeach;
?>