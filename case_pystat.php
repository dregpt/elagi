<?php 
include("core/init.php");
include("head.php"); 



// Taafeel equations

if (isset($_GET['casid'])===true){

    $case_id=$_GET['casid'];
    



}


?>

		



<?php include("includes/menues/reports_screenmenu.php"); ?>

			<div class="screen">
				<div class="leftcont">
                    <?php
                    if(isset($_GET['casid'])===true){
                    ?>
                    <div class="pagetitle">Pay status of: 
                        <span class="yellowfont">
                        <?php 
                            if (isset($_GET['casid'])===true){
                                $nm=get_fullname_from_user_id($cn,$_GET['casid']);
                                echo $nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm'];
                            }					
                        ?>
                        </span>
                    </div>
                    <div class="monthform">
                        <fieldset class="">
								<legend>Select a month for payment report:</legend>
                                    <form class="inlineform" action="case_pystat.php" method="get">
                                        <label> </label>
                                        <select class="txtbx" name="month">
                                        <?php   
                                            if(isset($_GET['month'])===true){
                                                months_6list_options($_GET['month']);
                                            }else{
                                                $month=date('Y-m',time());
                                                months_6list_options($month);
                                            }
                                        ?>
                                        </select>
                                        <input type="hidden" name="casid" value="<?php if (isset($_GET['casid'])===true){echo $_GET['casid'];} ?>">
                                        <input type="hidden" name="reports" value="">
                                        <input type="hidden" name="case_pystat" value="">
                                        <input type="submit" class="buttom2" value="Report" >
                            
                                    </form> 
                        </fieldset>
                    </div>
                    <div class="gridrow5050">
                        <table class="datatable">
                            <thead>
                            <tr >
                                <th >Type</th>
                                <th >Booked</th>
                                <th >Taken</th>
                                <th >Re-booked</th>
                                <th >Excuses</th>
                                <th >Absence</th>
                                <th >Cancelled</th>
                                <th >Next month</th>
                            </tr>
                            </thead>
                            <?php
                            if(isset($_GET['casid'])===true && isset($_GET['month'])===true){
                                $month=$_GET['month'];
                                $case_id= $_GET['casid'];
                                
                                case_ses_total_stat($cn,$case_id,$month);
                                total_ses_costs($cn,$case_id,$month);
                            }
                                    
                            ?>
                            
                        </table>
                        <?php
                            if(isset($_GET['casid'])===true && isset($_GET['month'])===true){
                                $month=$_GET['month'];
                                $cas_id= $_GET['casid'];
                        ?>
                        <div class="totaltables">
                            <div class="costable">
                                <div class="rwtitle" title="All costs of taken sessions (including re-booked sessions) and excuse and absence fines">Total current month cost:</div>
                                    <div class="rwdata" title="All costs of taken sessions (including re-booked sessions) and excuse and absence fines">
                        <?php
                                                rndr_cst_cur_mnth($cn,$cas_id,$month);
                                                echo sw_cst_cur_mnth($cn,$cas_id, $month);
                        ?>
                                            
                                    </div>
                                <div class="rwtitle" title=" All returns of <?php echo date("M Y", strtotime('-1 month')); ?>">Previous month returns:</div>
                                    <div class="rwdata" title=" All returns of <?php echo date("M Y", strtotime('-1 month')); ?>">
                        <?php
                                        echo  sw_rtrn_prv_mnth($cn,$cas_id,$month);
                        ?>

                                    </div>
                                <div class="rwtitle" title=" All returns of <?php echo date("M Y", time()); ?>">Current month returns:</div>
                                    <div class="rwdata" title=" All returns of <?php echo date("M Y", time()); ?>">
                        <?php
                                        echo sw_rtrn_cur_mnth($cn,$cas_id, $month);
                        ?>
                                    </div>
                                <div class="rwtitle" title="Sum of all <?php echo date("M Y", time()); ?> payment transactions">Total payments for current month:</div>
                                    <div class="rwdata" title="Sum of all <?php echo date("M Y", time()); ?> payment transactions">
                        <?php
                                        echo total_cas_current_month_payments($cn,$cas_id,$month);
                        ?>
                                    </div><br>
                                    
                            </div>
                            <div class="paytable">
                                <div class="rwtitle">Required prepaid current month booking:</div>
                                <div class="rwdata">
                        <?php
                                         echo   sw_rq_pay_cur_mnth($cn,$cas_id,$month);   
                        ?>
                                </div>
                                <div class="rwtitle" title="Sum all payment transactions of <?php echo date("M Y", time()); ?>  and returns of <?php echo date("M Y", strtotime('-1 month')); ?>">Total payment balance (payments + previous returns):</div>
                                <div class="rwdata" title="Sum all payment transactions of <?php echo date("M Y", time()); ?>  and returns of <?php echo date("M Y", strtotime('-1 month')); ?>">
                        <?php
                                       
                                echo   sw_cur_mnth_balance($cn,$cas_id,$month);    
                        ?>
                                </div>
                                <div class="rwtitle">Required prepaid next month booking:</div><div class="rwdata">
                        <?php
                                        echo   sw_rq_pay_nxt_mnth($cn,$case_id,$month);    
                        ?>
                                
                                </div>
                            </div>
                        
                        </div>
                        
                        <?php
                            rndr_rq_pay_nxt_mnth ($cn,$cas_id,$month);
                            
                            }?>
                    </div>
                <?php
                    }
                ?>
                </div>
				<div class="rightscreen">Cases: <br>
					<div class="rightscreendata">
						<?php
                        if(isset($_GET['month'])===true){
                            rep_case_pay_list($cn,$_GET['month']);
                        }else{
                            rep_case_pay_list($cn,date("Y-m"));
                        }

						?>
					</div>
				</div>	

			</div>
		</div>
		<div class="sidebar">
            <table class="inforows">
				<?php
					include('widgets/indexwid/nocaseswid.php');
					include('widgets/indexwid/Num_lst_month_actv_cases.php');
					include('widgets/indexwid/Num_crnt_month_actv_cases.php');
					include('widgets/indexwid/num_cur_month_new_cases.php');
					include('widgets/indexwid/Num_nxt_month_actv_cases.php');
				?>
			</table>
        </div>
	</div>
</div>












<?php include("foot.php"); ?>