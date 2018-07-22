<?php
require '../timeline_helper.php';
$validDOB = Timeline_Helper::validateDOB($_GET['dob']);
?>

<head>
	<title>Life Timeline</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="stylesheet" type="text/css" href="assets/main.css">
	<link href="https://fonts.googleapis.com/css?family=Arimo:400,700" rel="stylesheet">
	<link rel="icon" href="favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
</head>

<body>
	<div id="page-wrapper">
		<h1 id="timeline-title"><a href="<?php echo Timeline_Helper::getHomeURL(); ?>">Life Timeline</a></h1>

		<?php
		if (empty($_GET['dob']) || !$validDOB):
			require '../pages/dob_form.php';
		else:
			require '../pages/timeline_results.php';
		endif;
		?>
	</div>

	<?php require '../pages/footer.php'; ?>

	<script src="main.js"></script>
</body>