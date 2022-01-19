
<tr>
	<td><?php echo date("F"); ?> outlays:</td>
	<td>
		<?php
        if(is_logged_in()){


           echo  month_total_outlays($outlays, date("Y-m"));
        }
        ?>
	</td>
</tr>
