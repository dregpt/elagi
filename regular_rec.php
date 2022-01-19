<?php 
include("core/init.php");
include("head.php");


If(is_logged_in()===false){
	header('location:lgn.php');
}
?>


<?php include("includes/menues/record_screenmenu.php"); 

//echo allowed_prv($cn,$user_data['usr_id'],$args=[1,2]);

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
			"note"             => mysqli_real_escape_string($cn,$_POST['note']),
			"submitter"        => $_POST['submitter'],
			"submit_timestamp" => $_POST['submit_timestamp']
		);
		 $casid= $register_data['cas_id'];
		 $ses_id= $register_data['ses_id'];
	
	//echo"<pre>";print_r($register_data);echo"</pre>";
		// update case:
     update_session($cn,$register_data, $ses_id);
     header("location:regular_rec.php?regular_rec&regular&casid=".$casid."&sesid=".$ses_id."&ses_day=".$register_data['ses_day']);
	
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
                <form name="sessionday" action="regular_rec.php" method="get">
				<div class="screencontainer">Sessions of <?php
                                                            if(isset($_GET['ses_day'])===true){
                                                                echo date("l",strtotime($_GET['ses_day']));
                                                            }else {
                                                                echo " " . date("l");
                                                            }
                                                            ?>

                        <input type="date" name="ses_day" value="<?php
                        if(isset($_GET['ses_day'])===true){
                            echo $_GET['ses_day'];
                        }else{echo date('Y-m-d');} ?>">
                    &nbsp; <input type="submit" name="sessionday" value="Show" >
                    </form>
					<?php 
                    //echo date("l (Y-m-d)",strtotime("today"))." :";
						if (isset($_GET['casid'])===true){
							$nm=get_fullname_from_user_id($cn,$_GET['casid']);
				            $nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm'];
						}					
					?><br>
				<?php //test:	
				//echo uc_frst_char_words("ibRAHIm saLeM");
				?>
					
					<?php  echo messages($message); ?>
                    <form id="casesesform" action="regular_rec.php" method="post">
					<div class="leftscreen">
						<div class="discreen">
							<div class="formcolumn">
								<div class="sessions">
									
									<?php
                                    if(isset($_GET['ses_day'])===true){
                                        $day= $_GET['ses_day'];
                                    }else{echo $day= date('Y-m-d');}


                                        day_sessions($cn,$day);

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
                                    
                                  
							?>
							<div class="formcolumn" >
								<fieldset <?php // to deactivate all form elements when no data is saved
                                               $start_time=strtotime($ses_data['ses_rf_tm']);
                                                $ses_duration=serv_duration($cn,$srv_cd)*60;

                                               $pre_cur_time=time()-((60*60*2)+$ses_duration);
                                               $post_cur_time=time()+(60*60*2)+$ses_duration;
                                    
                                            if(allowed_prv($cn,$user_data['usr_id'],$args=[1,2])===false){
                                                if(($start_time <= $pre_cur_time)||($start_time >= $post_cur_time)){
                                                    echo "disabled";
                                                    }
                                                }
                                            ?>
                                >
                                
								<legend>Edit session</legend>
									
									<label> Case name: </label><br>
									<?php echo $nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm'];?><br>
									<input type="hidden" name="cas_id" value="<?php echo $_GET['casid']?>">
									<input type="hidden" name="ses_id" value="<?php echo $_GET['sesid']?>">

									<label> Session type: </label>
									<select class="txtbx" name="srv_cd" <?php if(allowed_prv($cn,$user_data['usr_id'],$args=[1,2])===false){echo "style='pointer-events: none;'";}?>>
									<?php
										session_type($cn,$srv_cd);
									?> 
									</select>
									<label> Session status: </label>
									<select class="txtbx" name="stat">
									<?php 
										reg_rec_ses_stat_op($cn, $ses_stat);
									?>
									</select><br>
                                    <div class="startendgrid">
									<label>Session date:</label><label>Session time:</label>
									<input type="date" class="txtbx" value="<?php echo $ses_day; ?>" name="ses_day" <?php if(allowed_prv($cn,$user_data['usr_id'],$args=[1,2])===false){echo "style='pointer-events: none;'";}?>>
									<input type="time" class="txtbx" value="<?php echo $ses_rf_tm; ?>" name="ses_rf_tm" <?php if(allowed_prv($cn,$user_data['usr_id'],$args=[1,2])===false){echo "style='pointer-events: none;'";}?>>
                                    </div>
                                    <label> Therapist:</label><br>
									<select class="txtbx" name="thrp_id">
										<?php
											therapist_list_op($cn,$thrp_id);
										?>
									</select><br>
									<label>Case attendance (or excuse) at:</label><br>
                                    <div class="startendgrid">
									<input type="date" class="txtbx" value="<?php echo $ses_rc_day;?>" name="ses_rc_day">
									<input type="time" class="txtbx" value="<?php echo $attend_tm; ?>" name="attend_tm">
                                    </div>
                                    <div class="startendgrid">
									<label>Start time:</label><label>End time:</label>
									<input type="time" class="txtbx" value="<?php echo $ses_rc_strt; ?>" name="ses_rc_strt">

									<input type="time" class="txtbx" value="<?php echo $ses_rc_end; ?>" name="ses_rc_end">
                                    </div>
									<label> Note:</label><br>
									<textarea class="txtarea" name="note"><?php echo $note; ?></textarea>
                                    <input type="hidden" value="<?php echo time();?>" name="submit_timestamp">
                                    <input type="hidden" value="<?php echo $user_data['usr_id']; ?>" name="submitter">
                                    <!--<input type="reset" class="buttom1"> -->
                                    <input type="submit" class="buttom1" value="Save" >
								</fieldset>
							</div>
							<?php
                            }
							?>
						</div>
					</div>
				</div>
				</form>
				<div class="rightscreen">Notes of the day:    <br>
					<div class="rightscreendata">
						<?php
//                        if(isset())
                        if(empty($regular_record_notes)===false) {
                           echo  regular_record_notation($regular_record_notes);
                        }
						?>
					</div>
				</div>	
		</div>
		</div>
		<div class="sidebar">
			<table class="inforows">
				<?php
                include('widgets/indexwid/num_day_services.php');
                include('widgets/indexwid/emptyWid.php');
                include('widgets/indexwid/no_excused_ses.php');
					include('widgets/indexwid/no_absence_ses.php');
					include('widgets/indexwid/no_cancelled_ses.php');
					include('widgets/indexwid/no_waiting_ses.php');
					include('widgets/indexwid/notakenses.php');
					include('widgets/indexwid/noses.php');
				?>
			</table>
		</div>
	</div>
</div>












<?php include("foot.php"); ?>