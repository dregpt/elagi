<tr>
	<td>Number of therapists:</td>
	<td>
		<?php
				if(is_logged_in()){
					number_of_therpists($cn);
				}				
		?>
	</td>
</tr>
