<tr>
	<td>Current month active cases:</td>
	<td>
		<?php
				if(is_logged_in()){
					echo number_of_active_cases_in_month($cn,0);
				}				
		?>
	</td>
</tr>
