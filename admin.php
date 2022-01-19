<?php 
include("core/init.php");
include("head.php");

If(is_logged_in()===false){
	header('location:lgn.php');
}

// hello phpstorm

?>

	



<?php include("includes/menues/admin_screenmenu.php"); 

if(empty($_POST)===false){
	//$message[]="submitted!";
}

?>

			<div class="screen">
				<form action="admin.php" method="post">
				<div class="screencontainer">Setting:
					<?php // echo messages($message); ?>
					<div class="leftscreen">
						<div class="discreen">
							<div class="formcolumn">
                                
                            <fieldset><legend>General setting</legend>
                                <?php
                                    if(isset($_POST['savesets'])===true){
                                            if(empty($_POST['cont'])==true){$_POST['cont']=0;}
                                            $register_data=array(
                                            "cont"      => $_POST['cont'],
                                            "submitter"   => $_POST['submitter'],
                                            "submit_timestamp" => $_POST['submit_timestamp']
                                            );

                                            set_setting($cn,1,$register_data);
                                    }
                                ?>
                                <form action="admin.php" method="post" id="savesets" >
                                    <input type="checkbox" name="cont" value="1" <?php if(setting_status($cn,1,"cont")==1){echo "checked";} ?>>
                                    <label><?php echo setting_status($cn,1,'detail') ?></label><br>
                                    <input type="hidden" name="submitter" value="<?php echo $user_data['usr_id'] ?>">
                                    <input type="hidden" name="submit_timestamp" value="<?php echo time(); ?>">
                                    <input type="submit" class="buttomsmall" value="Save" name="savesets"><br>
                                </form>
                            </fieldset>
                            <?php
                              if(setting_status($cn,1,"cont")==1){  
                            ?>
                            <fieldset class="smallform">
                                <?php
                                    if(isset($_POST['rebooklimit'])===true){
                                        if($_POST['frm']<$_POST['t']){
                                            $register_data=array(
                                            "frm"      => $_POST['frm'],
                                            "t"      => $_POST['t'],
                                            "rebook_limit"      => $_POST['rebook_limit'],
                                            "submitter"   => $_POST['submitter'],
                                            "submit_timestamp" => $_POST['submit_timestamp']
                                            );

                                            add_rebooking_limit($cn,$register_data);
                                        }else{
                                            echo "<spam class='lredfont' style='font-size:15px;'>You have to ennter proper sessions range!</spam><br>";
                                        }
                                    }
                                ?>
                                    <legend>Re-book limit setting</legend>
                            <form action="admin.php" method="post" id="rebooklimit">
									<label> Number of booked sessions per month:</label><br>
                                        from: &#160; <input type="text" class="txtboxnum" name="frm" required> &#160; to &#160; <input type="text" class="txtboxnum" name="t" required><br>
                                        <label> Set limit for re-booking to: </label><input type="text" class="txtboxnum" name="rebook_limit" required><br>
                                        <input type="hidden" name="submitter" value="<?php echo $user_data['usr_id'] ?>">
                                        <input type="hidden" name="submit_timestamp" value="<?php echo time(); ?>">
                                        <input type="submit" class="buttomsmall" value="Add limit" name="rebooklimit"><br>

                             </form>
                                        <div class="smalldatalist">
                                            <div class="smalldatalistHr">
                                                <div class="smalldatalistHd">From</div>
                                                <div class="smalldatalistHd">To</div>
                                                <div class="smalldatalistHd">Limit</div>
                                                <div class="smalldatalistHd"></div>
                                            </div>
                                            <?php
                                                shw_rebooking_limits($cn);
                                            ?>
                                        </div>
								</fieldset>
                                <?php
                                          }
                                  ?>


<!--                                <fieldset>-->
<!--								<legend>Case Accounting</legend>-->
<!--                                    <form action="cont.php" method="post" id="acc">-->
<!--                                        --><?php
//                                            if(isset($_POST['acc'])===true){
//                                                header("location:cont.php?acc");
//                                            }
//                                            if(isset($_GET['accounted'])==true){
//                                                echo "All cases accountings are now ready!";
//                                            }
//                                        ?>
<!--                                        <input type="submit" class="buttom1" value="Account all cases for current month" name="acc">-->
<!--                                    </form>-->
<!--								</fieldset>-->

							</div>
							<div class="formcolumn">

							</div>
							<div class="formcolumn"> 
								<!--<input type="submit" class="buttom1" value="Save"> -->
							</div>
						</div>
					</div>
				</div>
				</form>
				<div class="rightscreen"> <br>
					<div class="rightscreendata">
 
                    </div>
				</div>	
		</div>
		</div>
		<div class="sidebar">sidebar</div>
	</div>
</div>












<?php include("foot.php"); ?>