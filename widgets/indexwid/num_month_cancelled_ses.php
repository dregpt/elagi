<tr>
	<td>Cancellations of (<?php echo date("F",time()); ?>):</td>
	<td>
		<?php
				if(is_logged_in()){
					echo num_month_ses($cn,4,date("Y-m",time())) + num_month_ses($cn,9,date("Y-m",time()));
				}				
		?>
	</td>
</tr>
