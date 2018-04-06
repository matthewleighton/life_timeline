<?php

require '../vendor/autoload.php';
use Carbon\Carbon;

class Timeline_Helper {

	// Return FALSE if there is a problem with the given DOB.
	public static function validateDOB(&$DOB) {
		if (!isset($_GET['dob'])):
			// Return true if DOB is empty. We're only checking for invalid DOB. Not absent DOB.
			return true;
		endif;

		$DOB = self::fixDOB($DOB);

		try {
			$userDOB = new Carbon($DOB);
		} catch(Exception $e) {
			return false; // Validation error!
		}

		return true; // No errors. All is good.
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

		self::addLifespanAnniversaries($userDOB, $events);

		$today = new Carbon('today');

		foreach ($events as $id => $event):			
			// Add event date.
			$eventDate = $userDOB->copy()->addDays($event['days']);
			$events[$id]['date'] = $eventDate->format('jS \o\f F, Y');

			// Add age at date.
			$age = $eventDate->diffInYears($userDOB);
			$events[$id]['age'] = $age;

			// Add event period (future/past).
			$events[$id]['period'] = $today->gt($eventDate) ? 'past' : 'future';

			// Add event decade. (Take year, and replace last digit with '0s').
			$events[$id]['decade'] = substr($eventDate->format('Y'), 0, -1) . '0s';
		endforeach;

		//echo"<pre>";print_r($events);die;

		//$events = self::addDecadeMarkers($events);

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

			if ($anniversaryDays > 125*365) break;

			$eventsArray[] = array(
				'title' => $title,
				'days' => $anniversaryDays,
				'who' => 'You',
				'category' => 'self-event'
			);
		endforeach;
	}

	public static function getDateFromNumberOfDaysAfterDob($DOB, $days) {
		$DOB = new Carbon($DOB);

		return $DOB->addDays($days)->format('jS \o\f F, Y');
	}

}