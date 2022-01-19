			
				



                <a href="regular_rec.php?regular_rec" id="<?php echo activate_tabe($_GET['regular_rec'],"record") ?>">
                    <img src="././img/icons/common-file-text-edit.png" class="iconLarge">
                    Record
                </a>

				<a href="caseedit.php?caseedit" id="<?php echo activate_tabe($_GET['caseedit'],"record") ?>">
                    <img src="././img/icons/multiple-circle.png" class="iconLarge">
                    Cases
                </a>

				<a href="thrpedit.php?thrpedit" id="<?php echo activate_tabe($_GET['thrpedit'],"record") ?>">
                    <img src="././img/icons/medical-specialty-back.png" class="iconLarge">
                    Therapists
                </a>

				<a href="reports.php?reports" id="<?php echo activate_tabe($_GET['reports'],"record") ?>">
                    <img src="././img/icons/common-file-text-search.png" class="iconLarge">
                    Reports
                </a>
                
            <?php
                if(allowed_prv($cn,$user_data['usr_id'],$args=[1])===true){
            ?>

				<a href="admin.php?admin" id="<?php echo activate_tabe($_GET['admin'],"record") ?>">
                    <img src="././img/icons/single-man-setting.png" class="iconLarge">
                    Administration
                </a>

				<!-- <a href="#" class="pays">Payments</a> -->
				<!-- <a href="#" class="schedule">Schedule</a> -->
                
            <?php
                }
            ?>
			