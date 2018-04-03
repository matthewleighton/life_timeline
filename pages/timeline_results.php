<?php
require '../timeline_helper.php';

$userDOB = $_POST['dob'];
$events = Timeline_Helper::getEventsFromDB();
$events = Timeline_Helper::addUserSpecificDataToEvents($events, $userDOB);

$categories = array(
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
	foreach ($categories as $category):
		?>
		<button 
			class="category-toggle toggle-on"
			onclick="toggleCategoryDisplay('<?php echo $category; ?>')"
			value="1"
			data="<?php echo $category; ?>"
		>
			<img 
			src="assets/images/<?php echo $category; ?>.svg"
			/>
			<?php echo ucfirst($category); ?></button>
		<?php
	endforeach;	
	?>
</div>

<div id="timeline-wrapper">

	<?php
	foreach ($events as $days => $event):
		//echo "<pre>";print_r($event);die;
		?>
		<div class="timeline-event <?php echo $event['category']; ?>">
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