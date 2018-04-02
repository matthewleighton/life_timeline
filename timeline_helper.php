<?php

require '../vendor/autoload.php';
use Carbon\Carbon;

class Timeline_Helper {

	public static function getEventsFromDB() {
		require 'db_config.php';

		$conn = new PDO("mysql:host=" . $host . ";dbname=" . $db, $user, $pass);
		$sql = "SELECT * FROM events ORDER BY days ASC";
		$query = $conn->prepare($sql);
		$query->execute();

		return $query->fetchAll();
	}

	public static function addUserSpecificDataToEvents($events, $userDOB) {

		$userDOB = new Carbon($userDOB);

		foreach ($events as $id => $event):
			$userDOB = new Carbon($userDOB);
			
			// Add event date.
			$eventDate = clone $userDOB;
			$eventDate->addDays($event['days']);
			$events[$id]['date'] = $eventDate->format('jS \o\f F, Y');
		endforeach;

		return $events;
	}

}