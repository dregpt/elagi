<tr>
	<td>Today payments:</td>
	<td>
		<?php
				if(is_logged_in()){
					echo tot_today_pays($cn)." L.E" ;
				}				
		?>
        
	</td>
</tr>
