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

	// Replace slashes with dashes in submitted DOB
	public static function formatDOB($DOB) {
		return str_replace('/', '-', $DOB);
	}

	public static function addUserSpecificDataToEvents($events, $userDOB) {

		$userDOB = self::formatDOB($userDOB);
		$userDOB = new Carbon($userDOB);

		foreach ($events as $id => $event):
			$userDOB = new Carbon($userDOB);
			
			// Add event date.
			$eventDate = $userDOB->copy()->addDays($event['days']);
			$events[$id]['date'] = $eventDate->format('jS \o\f F, Y');

			// Add age at date.
			$age = $eventDate->diffInYears($userDOB);
			$events[$id]['age'] = $age;

			// Add event period (future/past)
			$today = new Carbon('today');
			$events[$id]['period'] = $today->gt($eventDate) ? 'past' : 'future';

			/*if ($today->gt($eventDate)):
				$events[$id]['period'] = 'past';
			else:
				$events[$id]['period'] = 'future';
			endif;*/
		endforeach;

		return $events;
	}

}