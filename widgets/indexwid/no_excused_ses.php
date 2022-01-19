<tr>
	<td>Excused sessions:</td>
	<td>
		<?php
				if(is_logged_in()){
                    if (isset($_GET['ses_day'])) {
                        $ses_day = $_GET['ses_day'];
                    } else {
                        $ses_day = date("Y-m-d", time());
                    }

                    number_of_day_excused_ses($cn,$ses_day);
				}				
		?>
	</td>
</tr>
