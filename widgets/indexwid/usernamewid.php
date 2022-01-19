<tr>
	<td>User:</td>
	<td>
		<?php
				if(is_logged_in()){
				echo $user_data['frst_nm']." ".$user_data['lst_nm'];
				}				
		?>
	</td>
</tr>
