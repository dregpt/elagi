<?php 
include("core/init.php");
include("head.php");


If(is_logged_in()===false){
	header('location:lgn.php');
}
?>

<!-- <a onClick="confirm('message!')" href="index.php"  ><img src='img/icons/bin-2.png' class="icon" style=""></a> -->



<?php include("includes/menues/record_screenmenu.php"); 

	//echo"<pre>";print_r($_POST);echo"</pre>";


if((empty($_POST)===false) && (empty($message)===true)){
    
           $rglr_price=get_ses_price($cn,$_POST['cas_id'],$_POST['srv_cd'],1);
           $sngl_price=get_ses_price($cn,$_POST['cas_id'],$_POST['srv_cd'],0);
           $excuse_fn=get_ses_fine($cn,$_POST['srv_cd'],1);
           $absence_fn=get_ses_fine($cn,$_POST['srv_cd'],0);
    
			$register_data=array(
			"cas_id"           => $_POST['cas_id'],
			"thrp_id"          => $_POST['thrp_id'],
			"srv_cd"           => $_POST['srv_cd'],
			"stat"             => $_POST['stat']  ,
			"price_stat"       => $_POST['price_stat']  ,
			"rglr_price"       => $rglr_price  ,
			"sngl_price"       => $sngl_price  ,
			"exc_fine"         => $excuse_fn  ,
			"abs_fine"         => $absence_fn  ,
            
            "ses_day"          => $_POST['ses_day'],
			"ses_rc_day"       => $_POST['ses_rc_day'],
			"ses_rf_tm"        => $_POST['ses_rf_tm'],
			"attend_tm"        => $_POST['attend_tm'],
			"ses_rc_strt"      => $_POST['ses_rc_strt'],
			"ses_rc_end"       => $_POST['ses_rc_end'],
			"note"             => $_POST['note'],
			"submitter"        => $_POST['submitter'],
			"submit_timestamp" => $_POST['submit_timestamp']
		);
	
	//echo"<pre>";print_r($_POST);echo"</pre>";
	//echo"<pre>";print_r($register_data);echo"</pre>";
    $casid = $register_data['cas_id'];
    
		// update case:
	    add_session($cn,$register_data,$user_data['usr_id']);
    
        
    
    header("location:record_single.php?regular_rec&record_single&cas_id=".$register_data['cas_id']);
	   
}




if(isset($_GET['cas_id'])===true){
		$nm=get_fullname_from_user_id($cn,$_GET['cas_id']);
							$first_name =$nm['frst_nm'];
							$last_name =$nm['lst_nm'];
		$message[]="Session for (".$first_name." ".$last_name.") is successfully recorded";
}


?>

			<div class="screen">
				<form id="casesesform" action="record_single.php" method="post">
				<div class="screencontainer"> 					
					<?php  echo messages($message); ?>
					<div class="leftscreen">
						<div class="discreen">
							<div class="formcolumn">
								<div class="sessions">
																											
								</div>
							</div>
							<div class="formcolumn">
								<fieldset>
								<legend>Add new session</legend>
                                    
                                    <input type="radio" name="price_stat" value="1" checked="checked"><label>Regular </label>
                                    <input type="radio" name="price_stat" value="0"><label>Single </label></br></br>
                            
                                    <label > Case name: </label><br>
									<select class="txtbx" name="cas_id" required>
									<?php
										all_cas_names_op($cn);   
									?> 
									</select><br>
									<label> Service: </label><br>
									<select class="txtbx" name="srv_cd" required>
									<?php
										session_type($cn,$srv_cd);
									?> 
									</select><br>
									<label> Session status: </label><br>
									<select class="txtbx" name="stat" required>
									<?php 
										ses_stat_op($cn, $ses_stat);
									?>
									</select>
                                    <div class="startendgrid">
									<label>Session date:</label><label>Session time:</label>
									<input type="date" class="txtbx" name="ses_day" required>
									<input type="time" class="txtbx" name="ses_rf_tm" required>
                                    </div>
									<label> Therapist:</label><br>
									<select class="txtbx" name="thrp_id">
										<?php
											therapist_list_op($cn,$thrp_id);
										?>
									</select><br>
									<label>Case attendance (or excuse) at:</label><br>
									<input type="date" class="txtbx"  name="ses_rc_day"><br>									
									<input type="time" class="txtbx"  name="attend_tm"><br>
                                    <div class="startendgrid">
									<label>Start time:</label><label>End time:</label>
									<input type="time" class="txtbx"  name="ses_rc_strt">
									<input type="time" class="txtbx"  name="ses_rc_end">
                                    </div>
									<label> Note:</label><br>
									<textarea class="txtbx" name="note"></textarea>
								</fieldset>
                                <input type="hidden" value="<?php echo time();?>" name="submit_timestamp">
                                <input type="hidden" value="<?php echo $user_data['usr_id']; ?>" name="submitter">
                                <!--<input type="reset" class="buttom1"> -->
                                <input type="submit" class="buttom1" value="Add session" >
							</div>
							<div class="formcolumn">
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
					include('widgets/indexwid/nocaseswid.php');
				?>
			</table>
		</div>
	</div>
</div>












<?php include("foot.php");

If(is_logged_in()===false){
    header('location:lgn.php');
}
?>