	<div class="container">
		<div class="mainscreen">
			<div class="screenmenu">
				<a href="caseadd.php?caseadd&caseadd" id="<?php echo activate_tabe($_GET['caseadd'],"screenmenuebtm") ?>">Manage cases</a>
				<a href="seset.php?caseedit&seset" id="<?php echo activate_tabe($_GET['seset'],"screenmenuebtm") ?>">Session booking</a>
				<a href="sescase.php?caseedit&sescase" id="<?php echo activate_tabe($_GET['sescase'],"screenmenuebtm") ?>">Sessions</a>
				<!-- <a href="case_evaluation.php?caseedit&case_evaluation" id="<?php //echo activate_tabe($_GET['case_evaluation'],"screenmenuebtm") ?>">Evaluation</a> -->
            <?php
                if(allowed_prv($cn,$user_data['usr_id'],$args=[1])===true){
            ?>
                <a href="casprice.php?caseedit&casprice" id="<?php echo activate_tabe($_GET['casprice'],"screenmenuebtm") ?>">Price setting</a>
                
            <?php } ?>
			</div>
			
			
			