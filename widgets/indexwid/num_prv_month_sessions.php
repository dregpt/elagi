
<tr>
	<td>Previous month sessions:</td>
	<td>
		<?php
        if(is_logged_in()){
           echo  number_of_month_sessions($cn, date("Y-m",strtotime("-1 month")));
        }
        ?>
	</td>
</tr>
