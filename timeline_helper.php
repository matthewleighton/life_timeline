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


	// Attempt to fix DOBs given in a format which Carbon does not like.
	public static function fixDOB($dob) {
		// Replace slashes with dashes.
		$dob = str_replace('/', '-', $dob);
		
		// Convert American format (MM/DD/YYYY) to English format (DD/MM/YYYY).
		$dobParts = split('-', $dob);
		if (count($dobParts) == 3 && $dobParts[1] > 12):
			$dob = $dobParts[1] . '-' . $dobParts[0] . '-' . $dobParts[2];
		endif;

		return $dob;
	}

	public static function addUserSpecificDataToEvents($events, $userDOB) {

		$userDOB = self::FixDOB($userDOB);
		
		try {
			$userDOB = new Carbon($userDOB);
		} catch(Exception $e) {
			// Redirect to the front page if the DOB cannot be understood.
			$siteUrl = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '?dob_error=1';

			header('Location: ' . $siteUrl);
			die;
		}

		self::addLifespanAnniversaries($userDOB, $events);

		$today = new Carbon('today');

		foreach ($events as $id => $event):			
			// Add event date.
			$eventDate = $userDOB->copy()->addDays($event['days']);
			$events[$id]['date'] = $eventDate->format('jS \o\f F, Y');

			// Add age at date.
			$age = $eventDate->diffInYears($userDOB);
			$events[$id]['age'] = $age;

			// Add event period (future/past)
			$events[$id]['period'] = $today->gt($eventDate) ? 'past' : 'future';
		endforeach;


		return self::sortEventsByDays($events);
	}

	// Order the given events by days, least to most.
	public static function sortEventsByDays($events) {
		usort($events, function($a, $b) {
			return $a['days'] - $b['days'];
		});

		return $events;
	}

	// Add events for date of double, tripple, etc, current user lifespan.
	public static function addLifespanAnniversaries($userDOB, &$eventsArray) {

		$today = new Carbon('today');

		// Stop if the given DOB is in the future.
		if ($userDOB->gt($today)) return;

		$lifeMultiplied = array(
			2 => 'Your life so far, lived again.',
			3 => 'Your current lifespan, a third time.',
			4 => 'Your life, fourth time around.',
			5 => 'Five times your current lifespan.'
		);

		foreach ($lifeMultiplied as $multiplier => $title):
			$anniversaryDays = $today->diffInDays($userDOB) * $multiplier;

			//var_dump($anniversaryDays);

			if ($anniversaryDays > 125*365) {
				//die(var_dump($anniversaryDays));
				break;
			}

			$eventsArray[] = array(
				'title' => $title,
				'days' => $anniversaryDays,
				'who' => 'You',
				'category' => 'self-event'
			);
		endforeach;
	}

}