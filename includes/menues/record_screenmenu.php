	<div class="container">
		<div class="mainscreen">
			<div class="screenmenu">
				<a href="regular_rec.php?regular_rec&regular" id="<?php echo activate_tabe($_GET['regular'],"screenmenuebtm"); ?>">Regular sessions</a>
                <a href="rebooking.php?regular_rec&rebooking" id="<?php echo activate_tabe($_GET['rebooking'],"screenmenuebtm"); ?>">Re-booking</a>
				<a href="record_single.php?regular_rec&record_single" id="<?php echo activate_tabe($_GET['record_single'],"screenmenuebtm"); ?>">New session</a>
                <a href="payform.php?regular_rec&payform" id="<?php echo activate_tabe($_GET['payform'],"screenmenuebtm"); ?>">Payment</a>
				<!--<a href="#?regular_rec&cas_eval" id="<?php// echo activate_tabe($_GET['cas_eval'],"screenmenuebtm"); ?>">Evaluation</a> -->
                <?php
                if(user_is_admin($cn,$user_data['usr_id'])===true){
                ?>
                    <a href="userbehavadd.php?regular_rec&userbehavadd" id="<?php echo activate_tabe($_GET['userbehavadd'],"screenmenuebtm"); ?>">Behavior</a>
                    <a href="outlayform.php?regular_rec&outlayform" id="<?php echo activate_tabe($_GET['outlayform'],"screenmenuebtm"); ?>">Outlay</a>
                    <a href="incomeform.php?regular_rec&incomeform" id="<?php echo activate_tabe($_GET['incomeform'],"screenmenuebtm"); ?>">Income</a>
                <?php
                }
                ?>
            </div>
			