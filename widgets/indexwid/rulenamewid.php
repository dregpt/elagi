<tr>
	<td>Rule:</td>
	<td>
		<?php
				if(is_logged_in()){
					user_rule_nm($cn,$user_data['usr_id']);
				}				
		?>
	</td>
</tr>
