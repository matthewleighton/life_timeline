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
		$dobParts = explode('-', $dob);
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

		self::AddRepeatedLifespanDurationEvents($userDOB, $events);
		self::addDayIncrementEvents($userDOB, $events);
		self::addCurrentAgeEvent($userDOB, $events);
		self::addBirthdayEvent($events);

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
			$events[$id]['decade'] = self::getDecadeFromDate($eventDate);
		endforeach;

		return self::sortEventsByDays($events);
	}

	// Add events for date of double, tripple, etc, current user lifespan.
	public static function AddRepeatedLifespanDurationEvents($userDOB, &$eventsArray) {
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
				'title'    => $title,
				'days' 	   => $anniversaryDays,
				'who' 	   => 'You',
				'category' => 'milestones'
			);
		endforeach;
	}

	// Add events for "Live n days". Defaults to every 5000.
	public static function addDayIncrementEvents($userDOB, &$eventsArray, $timeIncrement = 5000) {
		$dayCount = 0;

		while ($dayCount <= 43800): // 43800 days is 120 years.
			$dayCount += $timeIncrement;

			$eventsArray[] = array(
				'title'    => 'Live ' . number_format($dayCount) . ' days',
				'days' 	   => $dayCount,
				'who' 	   => 'You',
				'category' => 'milestones'
			);
		endwhile;
	}

	// Add an event for the current day.
	public function addCurrentAgeEvent($userDOB, &$eventsArray) {
		$today = new Carbon('today');
		$ageInDays = $today->diffInDays($userDOB);

		$eventsArray[] = array(
			'title'    => 'Today. Your ' . number_format($ageInDays) . self::getNumberSuffix($ageInDays) . ' day on Earth.',
			'days' 	   => $ageInDays,
			'who' 	   => 'You',
			'category' => 'milestones'
		);
	}

	public function addBirthdayEvent(&$eventsArray) {
		$eventsArray[] = array(
			'title'    => 'Be born.',
			'days' 	   => 0,
			'who' 	   => 'You',
			'category' => 'milestones'
		);
	}

	public static function sortEventsByDecade($originalEventsArray) {
		$sortedEventsArray = array();
		$currentDecade = ''; # The decade currently being filled.

		foreach ($originalEventsArray as $event):
			if ($event['decade'] != $currentDecade):
				$currentDecade = $event['decade'];

				$sortedEventsArray[$currentDecade] = array();
			endif;

			$sortedEventsArray[$event['decade']][] = $event;
		endforeach;

		return $sortedEventsArray;
	}

	// E.g. returns '2030s' from 2034.
	public static function getDecadeFromDate($date) {
		if (is_string($date)):
			$date = new Carbon($date);
		endif;

		return substr($date->format('Y'), 0, -1) . '0s';
	}

	// Order the given events by days, least to most.
	public static function sortEventsByDays($events) {
		usort($events, function($a, $b) {
			return $a['days'] - $b['days'];
		});

		return $events;
	}

	public static function getDateFromNumberOfDaysAfterDob($DOB, $days) {
		$DOB = new Carbon($DOB);

		return $DOB->addDays($days)->format('jS \o\f F, Y');
	}

	// Return the appropriate suffix (st, nd, rd, etc) to a number.
	public static function getNumberSuffix($number) {
		$suffixes = array('th','st','nd','rd','th','th','th','th','th','th');
		if ((($number % 100) >= 11) && (($number%100) <= 13)):
			return 'th';
		else:
			return $suffixes[$number % 10];
		endif;
	}

	// Returns the current URL, minus everything after the last slash. Designed so I can later move the site without need for code changes.
	public function getHomeURL() {
		$url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		return substr($url, 0, strrpos($url, '/'));
	}

}