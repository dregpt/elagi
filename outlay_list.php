<?php 
include("core/init.php");
include("head.php"); 
?>

		



<?php include("includes/menues/reports_screenmenu.php"); ?>

			<div class="singlesceen">
                <fieldset class="">
                    <legend>Select a month for outlay list report:</legend>
                    <form class="inlineform" action="outlay_list.php" method="get">
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
                        <input type="submit" class="buttom2" value="Report" >
                    </form>
                </fieldset>
                <div class="outlaytableheader">
                    <div class="payth">Details</div>
                    <div class="payth">Amount</div>
                    <div class="payth">Month</div>
                    <div class="payth">Modifier</div>
                    <div class="payth">Time</div>
                    <div class="payth">Expender</div>
                </div>
 
                
                <div class="paymentstable">
                    
                        
                        <?php
                        if(isset($_GET['month'])){
                            $month=$_GET['month'];
                        }else{
                            $month=date("Y-m",time());
                        }
                        $outlays=Outlay::find_all();
                        current_month_outlays($cn,$outlays,$month);
                        ?>
                    
                    
                </div>
                
                
                <div class="outlaytablefooter">
                    <div class="">Total outlay transactions of <?php echo date("F",strtotime($month)); ?> :</div>
                    <div class="payth">
                        <?php
                            if(isset($_GET['month'])){
                                $month=$_GET['month'];
                            }else{
                                $month=date("Y-m");
                            }
                            echo total_month_outlays($outlays,$month);
                        ?>
                    </div>
                    <div class=""></div>
                    <div class=""></div>
                    <div class=""></div>
                    <div class=""></div>
                    <div class=""></div>
                </div>
			</div>
		</div>
		<div class="sidebar">
            <table class="inforows">
				<?php
					include('widgets/indexwid/nocaseswid.php');
					include('widgets/indexwid/Num_lst_month_actv_cases.php');
					include('widgets/indexwid/Num_crnt_month_actv_cases.php');
				?>
			</table>
        </div>
	</div>
</div>












<?php include("foot.php"); ?>