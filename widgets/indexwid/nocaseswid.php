<tr>
	<td>Number of all cases:</td>
	<td>
		<?php
				if(is_logged_in()){
					number_of_cases($cn);
				}				
		?>
	</td>
</tr>
