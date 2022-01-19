	<div class="container">
		<div class="mainscreen">
			<div class="screenmenu">
				<a href="case_records.php?reports&case_records" id="<?php echo activate_tabe($_GET['case_records'],"screenmenuebtm") ?>">Records</a>
				<a href="case_exabs.php?reports&case_exabs" id="<?php echo activate_tabe($_GET['case_exabs'],"screenmenuebtm") ?>">Excuses</a>
				<a href="case_pystat.php?reports&case_pystat" id="<?php echo activate_tabe($_GET['case_pystat'],"screenmenuebtm") ?>">Pay status</a>
<!--                <a href="payment_dues.php?reports&payment_dues" id="--><?php //echo activate_tabe($_GET['payment_dues'],"screenmenuebtm") ?><!--">Payment dues</a>-->

            <?php

            if(allowed_prv($cn,$user_data['usr_id'],$prv_args=[1])===true){
            ?>


                    <a href="payment_list.php?reports&payment_list" id="<?php echo activate_tabe($_GET['payment_list'],"screenmenuebtm") ?>">Payments list</a>
                    <a href="outlay_list.php?reports&outlay_list" id="<?php echo activate_tabe($_GET['outlay_list'],"screenmenuebtm") ?>">Outlays list</a>
                <?php
                }
                
                

                ?>
			</div>
			
			
			