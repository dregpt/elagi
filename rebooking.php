<?php 
include("core/init.php");
include("head.php");


If(is_logged_in()===false){
	header('location:lgn.php');
}
?>


<?php include("includes/menues/record_screenmenu.php"); 


if((empty($_POST)===false) && (empty($message)===true)){
    
           $rglr_price=get_ses_price($cn,$_POST['cas_id'],$_POST['srv_cd'],1);
           $sngl_price=get_ses_price($cn,$_POST['cas_id'],$_POST['srv_cd'],0);
           $excuse_fn=get_ses_fine($cn,$_POST['srv_cd'],1);
           $absence_fn=get_ses_fine($cn,$_POST['srv_cd'],0);
    
			$register_data=array(
			"cas_id"           => $_POST['cas_id'],
			"thrp_id"          => $_POST['thrp_id'],
			"ses_id"           => $_POST['ses_id'],
			"srv_cd"           => $_POST['srv_cd'],
			"stat"             => $_POST['stat']  ,
			"rebook_stat"      => $_POST['rebook_stat']  ,
			"price_stat"       => 1,
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
		 $casid= $register_data['cas_id'];
		 $ses_id= $register_data['ses_id'];
	
	//echo"<pre>";print_r($register_data);echo"</pre>";
		// update case:
	    update_session($cn,$register_data, $ses_id);
		header("location:rebooking.php?regular_rec&rebooking&casid=".$casid."&sesid=".$ses_id);
	
		$nm=get_fullname_from_user_id($cn,$_GET['casid']);
							$first_name =$nm['frst_nm'];
							$last_name =$nm['lst_nm'];
		$message[]="Session for (".$first_name." ".$last_name.") is successfully updated!";
}




if(isset($_GET[''])===true){
	//$message[]="You have to select a case first from the left hand side list. ";
}


?>

			<div class="screen">
				<form id="casesesform" action="rebooking.php" method="post">
				<div class="screencontainer">Excuses that can be re-booked for
					<?php 
                    
                    echo date("(Y-m)",strtotime("today"))." :";
						if (isset($_GET['casid'])===true){
							$nm=get_fullname_from_user_id($cn,$_GET['casid']);
				            $nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm'];
						}					
					?><br>
				<?php //test:	
				//echo uc_frst_char_words("ibRAHIm saLeM");
				?>
					
					<?php  echo messages($message); ?>
					<div class="leftscreen">
						<div class="discreen">
							<div class="formcolumn">
								<div class="sessions">
									
									<?php
									
                                            $month=date("Y-m",time());
                                           allwed_excuses_for_rebooking($cn,$month); 


                                    ?>
																		
								</div>
							</div>
							<?php
								if(isset($_GET['sesid'])===true){
									$ses_data=ses_data($cn,$_GET['sesid']);
									$srv_cd= $ses_data['srv_cd'];
									$srv_nm=get_servname_from_servcod($cn, $srv_cd);
									$thrp_id= $ses_data['thrp_id'];
									$ses_stat= $ses_data['stat'];
									$ses_day= $ses_data['ses_day'];
									$ses_day=date('Y-m-d',strtotime($ses_day));
									$ses_rf_tm= $ses_data['ses_rf_tm'];
									$attend_tm= $ses_data['attend_tm'];
									$ses_rc_strt= $ses_data['ses_rc_strt'];
									$ses_rc_end= $ses_data['ses_rc_end'];
									$note= $ses_data['note'];
                                    $ses_rc_day= $ses_data['ses_rc_day'];
                                    $rebook_stat= $ses_data['rebook_stat'];
							?>
							<div class="formcolumn">
								<fieldset>
								<legend>Edit session</legend>
									
									<label> Case name: </label><br>
									<?php echo $nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm'];?><br>
									<input type="hidden" name="cas_id" value="<?php echo $_GET['casid']?>">
									<input type="hidden" name="ses_id" value="<?php echo $_GET['sesid']?>">
									<label> Session type: </label><br>
									<select class="txtbx" name="srv_cd" <?php if(allowed_prv($cn,$user_data['usr_id'],$args=[1,2])===false){echo "style='pointer-events: none;'";}?>>
									<?php
										session_type($cn,$srv_cd);
									?> 
									</select><br>
									<label> Session status: </label><br>
									<select class="txtbx" name="stat" <?php if(allowed_prv($cn,$user_data['usr_id'],$args=[1,2])===false){echo "style='pointer-events: none;'";}?>>
									<?php 
										rebooking_rec_ses_stat_op($cn, $ses_stat);
									?>
									</select><br>
                                    <div class="startendgrid">
									<label>Session date:</label><label>Session time:</label>
									<input type="date" class="txtbx" value="<?php echo $ses_day; ?>" name="ses_day" <?php if(allowed_prv($cn,$user_data['usr_id'],$args=[1,2])===false)
									{echo "style='pointer-events: none;'";}?>>
									<input type="time" class="txtbx" value="<?php echo $ses_rf_tm; ?>" name="ses_rf_tm" <?php if(allowed_prv($cn,$user_data['usr_id'],$args=[1,2])===false)
									{echo "style='pointer-events: none;'";}?>><br>
                                    </div>
									<label> Therapist:</label><br>
									<select class="txtbx" name="thrp_id" <?php if(allowed_prv($cn,$user_data['usr_id'],$args=[1,2])===false){echo "style='pointer-events: none;'";}?>>
										<?php
											therapist_list_op($cn,$thrp_id);
										?>
									</select><br>
									<label>Case attendance (or excuse) at:</label><br>
									<input type="date" class="txtbx" value="<?php echo $ses_rc_day;?>" name="ses_rc_day" <?php if(allowed_prv($cn,$user_data['usr_id'],$args=[1,2])===false){echo "style='pointer-events: none;'";}?>><br>
									<input type="time" class="txtbx" value="<?php echo $attend_tm; ?>" name="attend_tm" <?php if(allowed_prv($cn,$user_data['usr_id'],$args=[1,2])===false){echo "style='pointer-events: none;'";}?>><br>
                                    <div class="startendgrid">
                                    <label>Start time:</label><label>End time:</label>
									<input type="time" class="txtbx" value="<?php echo $ses_rc_strt; ?>" name="ses_rc_strt" <?php if(allowed_prv($cn,$user_data['usr_id'],$args=[1,2])===false)
									{echo "style='pointer-events: none;'";}?>>
									<input type="time" class="txtbx" value="<?php echo $ses_rc_end; ?>" name="ses_rc_end" <?php if(allowed_prv($cn,$user_data['usr_id'],$args=[1,2])===false)
									{echo "style='pointer-events: none;'";}?>>
                                    </div>
									<label> Note:</label><br>
									<textarea class="txtarea" name="note" <?php if(allowed_prv($cn,$user_data['usr_id'],$args=[1,2])===false){echo "style='pointer-events: none;'";}?>><?php echo $note; ?></textarea>
                                    <input type="hidden" name="rebook_stat" value="1">
                                    <input type="checkbox" name="rebook_stat" value="0"  <?php if(allowed_prv($cn,$user_data['usr_id'],$args=[1,2])===false){echo "style='pointer-events: none;'";}   if($rebook_stat==0){echo"checked";}  ?>> <label>Hide from rebooking</label>
                                    <input type="hidden" value="<?php echo time();?>" name="submit_timestamp">
                                    <input type="hidden" value="<?php echo $user_data['usr_id']; ?>" name="submitter">
                                    <!--<input type="reset" class="buttom1"> -->
                                    <input type="submit" class="buttom1" value="Save" >								</fieldset>
                            </div>
							<?php
								}
							?>
						</div>
					</div>
				</div>
				</form>
				<div class="rightscreen">    <br>
					<div class="rightscreendata">
						<?php
							//ses_case_list($cn);
						?>
					</div>
				</div>	
		</div>
		</div>
		<div class="sidebar">
			<table class="inforows">
				<?php
					//include('widgets/indexwid/nocaseswid.php');
					include('widgets/indexwid/num_month_excused_ses.php');
					include('widgets/indexwid/num_month_cancelled_ses.php');
					include('widgets/indexwid/num_month_takenrebook_ses.php');
				?>
			</table>
		</div>
	</div>
</div>












<?php include("foot.php"); ?>