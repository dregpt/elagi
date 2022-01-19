<tr>
	<td>Excuses of (<?php echo date("F",time()); ?>):</td>
	<td>
		<?php
				if(is_logged_in()){
					echo num_month_ses($cn,2,date("Y-m",time())) + num_month_ses($cn,7,date("Y-m",time()));
				}				
		?>
	</td>
</tr>
