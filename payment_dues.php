<?php 
include("core/init.php");
include("head.php");

//mysqli_query($cn,"delete from pay_dues");

?>

		



<?php include("includes/menues/reports_screenmenu.php"); ?>

			<div class="singlesceen">
                <div class="tableheader">
                    <div class="payth">Case name</div>
                    <div class="payth">Payment balance</div>
                    <div class="payth">Costs</div>
                    <div class="payth">Dues </div>
                </div>
 
                
                <div class="paymentstable">
                    <?php
                    if(isset($_POST)){
//                        echo"<pre>"; print_r($_POST); echo"</pre>";
                         foreach ($_POST as $keys => $values){
                            mysqli_query($cn,"update pay_dues set notify=$values where cas_id = $keys");
                        }

//                        echo"<pre>"; print_r($columns); echo"</pre>";
//                        echo"<pre>"; print_r($register_data); echo"</pre>";
                    }
                    ?>
                    
                     <form name="pay_dues" method="post"  action="payment_dues.php" >
                        <?php
                            current_month_payment_dues($cn,$user_data['usr_id']);

                            if(allowed_prv($cn,$user_data['usr_id'],$args=[1,2])===true){
                        ?>
                         <input type="submit" value="Save" class="buttom1">
                         <?php
                            }
                         ?>
                     </form>
                    
                </div>
                
                
                <div class="tablefooter">
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
					include('widgets/indexwid/Num_nxt_month_actv_cases.php');
				?>
			</table>
        </div>
	</div>
</div>












<?php
//echo"<pre>"; print_r($cases_dues); echo"</pre>";

include("foot.php"); ?>