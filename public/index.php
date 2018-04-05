<head>
	<title>Life Timeline</title>
	<link rel="stylesheet" type="text/css" href="reset.css">
	<link rel="stylesheet" type="text/css" href="timeline.css">
	<link href="https://fonts.googleapis.com/css?family=Arimo:400,700" rel="stylesheet">
</head>

<body>
	<div id="page-wrapper">
		<h1 id="timeline-title">Life Timeline</h1>

		<?php
		if (empty($_GET['dob'])):
			require '../pages/dob_form.php';
		else:
			require '../pages/timeline_results.php';
		endif;
		?>
	</div>

	<script src="main.js"></script>
</body>