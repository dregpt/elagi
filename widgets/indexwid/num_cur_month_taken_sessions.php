<tr>
	<td>Taken sessions of (<?php echo date("F",time()); ?>):</td>
	<td>
		<?php
				if(is_logged_in()){
					echo num_month_ses($cn,1,date("Y-m",time()));
				}				
		?>
	</td>
</tr>
