<?php 
include("core/init.php");
include("head.php");


If(is_logged_in()===false){
	header('location:lgn.php');
}
?>

<!-- <a onClick="confirm('message!')" href="index.php"  ><img src='img/icons/bin-2.png' class="icon" style=""></a> -->



<?php include("includes/menues/record_screenmenu.php"); 


if((empty($_POST)===false) && (empty($message)===true)){
			$register_data=array(
			"cas_id"      => $_POST['cas_id'],
			"amount"      => $_POST['amount'],
			"month"       => $_POST['month'],
			"details"     => $_POST['details'],
			"rcvd_by"     => $_POST['rcvd_by'],
			"submitter"   => $_POST['submitter'],
			"submit_timestamp" => $_POST['submit_timestamp']
		);
	
	//echo"<pre>";print_r($_POST);echo"</pre>";
	//echo"<pre>";print_r($register_data);echo"</pre>";
    $casid = $register_data['cas_id'];
    
		// update case:
	    add_payment($cn,$register_data,$user_data);
	header("location:payform.php?regular_rec&payform&payrecorded&cas_id=".$casid);
}




if(isset($_GET['paydeleted'])===true){
	$message[]="Payment is deleted!";
}
if(isset($_GET['payrecorded'])===true && isset($_GET['cas_id'])===true){
		$nm=get_fullname_from_user_id($cn,$_GET['cas_id']);
							$first_name =$nm['frst_nm'];
							$last_name =$nm['lst_nm'];
		$message[]="Payment for (".$first_name." ".$last_name.") is successfully recorded";
}


?>
			<div class="screen">
				<form id="payform" action="payform.php" method="post">
				<div class="screencontainer"> 					
					<?php  echo messages($message); ?>
					<div class="leftscreen">
						<div class="discreen">
							<div class="formcolumn">
								<div class="sessions">
									<?php
                                        today_payments($cn);
                                    ?>
								</div>
							</div>
							<div class="formcolumn">
								<fieldset>
								<legend>Add new payment</legend>
                                    <label > Case name: </label><br>
									<select class="txtbx" name="cas_id" title="Select a case from the dropdown list">
									<?php
										all_cas_names_op($cn);   
									?> 
									</select><br>
									<label>Amount (L.E.):</label><br>
                                        <input type="number" class="txtbx" name="amount" required title="Enter a value in Egyptian pound"><br>
									<label>Payment for:</label><br>
									<select class="txtbx" name="month" required>
                                        <option value="<?php echo date("Y-m",strtotime("first day of -1 month")); ?>" ><?php echo date("F Y",strtotime("first day of -1 month"));?></option>
                                        <option value="<?php echo date("Y-m",strtotime("first day of this month")); ?>"selected><?php echo date("F Y",strtotime("first day of this month"));?></option>
                                        <option value="<?php echo date("Y-m",strtotime("first day of +1 month")); ?>" ><?php echo date("F Y",strtotime("first day of +1 month"));?></option>
                                        <option value="<?php echo date("Y-m",strtotime("first day of +2  month")); ?>" ><?php echo date("F Y",strtotime("first day of +2  month"));?></option>
									</select><br>
                                    <label> Details:</label><br>
									<textarea class="txtbx" name="details" required></textarea>
                                    <label> Recieved by:</label><br>
									<select class="txtbx" name="rcvd_by" required>
                                        <?php
                                            users_list_opt($cn,1);
                                        ?>
                                    </select>
                                    <input type="hidden" value="<?php echo time();?>" name="submit_timestamp">
                                    <input type="hidden" value="<?php echo $user_data['usr_id']; ?>" name="submitter">
                                    <input type="submit" class="buttom1" value="Add payment" >
								</fieldset>
							</div>
							<?php
 
                            ?>
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
		<div class="sidebar">
			<table>
				<?php
					include('widgets/indexwid/tot_today_pays.php');
				?>
			</table>
		</div>
	</div>
</div>












<?php include("foot.php"); ?>