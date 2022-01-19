<tr>
	<td>Number of users:</td>
	<td>
		<?php
				if(is_logged_in()){
					number_of_users($cn);
				}				
		?>
	</td>
</tr>
