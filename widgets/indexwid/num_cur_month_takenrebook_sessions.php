<tr>
	<td>Taken-rebooks of (<?php echo date("F",time()); ?>):</td>
	<td>
		<?php
				if(is_logged_in()){
					echo num_month_ses($cn,6,date("Y-m",time()));
				}				
		?>
	</td>
</tr>
