
<tr>
	<td>Current month sessions:</td>
	<td>
		<?php
        if(is_logged_in()){
           echo  number_of_month_sessions($cn, date("Y-m",time()));
        }
        ?>
	</td>
</tr>
