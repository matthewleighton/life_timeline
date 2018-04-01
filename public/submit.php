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
	)
);

$dob = '17-04-1993';

#Carbon::setToStringFormat('jS \o\f F, Y');

foreach ($events as $days => $event) {
	$carbonDOB = new Carbon($dob);
	$carbonDOB->addDays($days);

	$event['date'] = $carbonDOB->format('jS \o\f F, Y');

	var_dump($event);

	// 1st April 2018
}
?>