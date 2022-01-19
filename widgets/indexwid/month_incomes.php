
<tr>
	<td><?php echo date("F"); ?> incomes:</td>
	<td>
		<?php
        if(is_logged_in()){


           echo  month_total_incomes($income, date("Y-m"));
        }
        ?>
	</td>
</tr>
