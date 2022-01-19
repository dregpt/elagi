<tr>
	<td>New cases:</td>
	<td>
		<?php

        if(isset($_GET['month'])){
            $month=$_GET['month'];
        }else{
            $month=date("Y-m",time());
        }
				if(is_logged_in()){
					echo num_month_cases($cn,$month);
				}				
		?>
	</td>
</tr>
