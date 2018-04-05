<div id="dob-form">
	
	<p>
		Overlay events in others' lives over the timeline of your own life.
	</p>

	<p class="dob-instruction">Enter your date of birth</p>

	<form>
		<input type="date" name="dob" id="dob-input">
		<button type="submit" id="dob-submit-button">
			<img src="assets/images/right-arrow.svg" id="dob-submit-image"/>
		</button>
	</form>

	<?php
	if (!$validDOB):
		?>
		<p class="dob-error">
			The date of birth could not be understood.
			</br>
			Try entering a date in the format "DD/MM/YYY".
		</p>
		<?php
	endif;
	?>
</div>