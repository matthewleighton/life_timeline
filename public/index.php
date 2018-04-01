<link rel="stylesheet" type="text/css" href="reset.css">
<link rel="stylesheet" type="text/css" href="timeline.css">
<link href="https://fonts.googleapis.com/css?family=Arimo:400,700" rel="stylesheet">

<body>
	
	<h1 id="timeline-title">Life Timeline</h1>

	<?php
	if (empty($_POST['dob'])):
		require '../pages/dob_form.php';
	else:
		require '../pages/timeline_results.php';
	endif;
	?>
</body>