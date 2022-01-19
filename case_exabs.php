<?php 
include("core/init.php");
include("head.php"); 





?>

		



<?php include("includes/menues/reports_screenmenu.php"); ?>
			<div class="snglescreen">
                <div class="pagetitle">Excuses, cancellations and absences of <?php echo date("M Y", time()) ?>: 
                </div>
                <div class="exabstables">
                            <div class="ltable">Excused &amp; cancelled sessions:
                                <div class="exabstrh">
                                    <div class="datath">S</div>
                                    <div class="datath">Date</div>
                                    <div class="datath">Session</div>
                                    <div class="datath">Case name</div>
                                </div>

                                <?php 
                                        $month=date("Y-m",time());
                                        cas_month_excuses($cn,$month);
                                ?>


                            </div>
                            <div class="ltable">Absences sessions:
                                <div class="exabstrh">
                                    <div class="datath">S</div>
                                    <div class="datath">Date</div>
                                    <div class="datath">Session</div>
                                    <div class="datath">Case name</div>
                                </div>

                                <?php 
                                        $month=date("Y-m",time());
                                        cas_month_absences($cn,$month);
                                ?>


                            </div>
                </div>
              </div>	



		</div>
		<div class="sidebar">
            <table class="inforows">
				<?php
					include('widgets/indexwid/num_month_excused_ses.php');
					include('widgets/indexwid/num_month_cancelled_ses.php');
					include('widgets/indexwid/num_month_takenrebook_ses.php');
				?>
			</table>
        </div>
	</div>
</div>












<?php include("foot.php"); ?>