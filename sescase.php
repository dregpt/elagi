<?php 
include("core/init.php");
include("head.php");


If(is_logged_in()===false){
	header('location:lgn.php');
}
?>


<?php include("includes/menues/cases_screenmenu.php"); 

//if(isset($_GET['casid'])){

if((empty($_POST)===false) && (empty($message)===true)) {

    if (allowed_prv($cn,$user_data['usr_id'],$args=[1,2]) === false) {
        $rglr_price = get_ses_price($cn, $_POST['cas_id'], $_POST['srv_cd'], 1);
        $sngl_price = get_ses_price($cn, $_POST['cas_id'], $_POST['srv_cd'], 0);
        $excuse_fn = get_ses_fine($cn, $_POST['srv_cd'], 1);
        $absence_fn = get_ses_fine($cn, $_POST['srv_cd'], 0);
    } else {
        $rglr_price = $_POST['rglr_price'];
        $sngl_price = $_POST['sngl_price'];
        $excuse_fn = $_POST['exc_fine'];
        $absence_fn = $_POST['abs_fine'];
    }


    $register_data = array(
        "cas_id" => $_POST['cas_id'],
        "thrp_id" => $_POST['thrp_id'],
        "ses_id" => $_POST['ses_id'],
        "srv_cd" => $_POST['srv_cd'],
        "stat" => $_POST['stat'],
        "rebook_stat" => $_POST['rebook_stat'],
        "price_stat" => $_POST['price_stat'],
        "rglr_price" => $rglr_price,
        "sngl_price" => $sngl_price,
        "exc_fine" => $excuse_fn,
        "abs_fine" => $absence_fn,
        "ses_day" => $_POST['ses_day'],
        "ses_rc_day" => $_POST['ses_rc_day'],
        "ses_rf_tm" => $_POST['ses_rf_tm'],
        "attend_tm" => $_POST['attend_tm'],
        "ses_rc_strt" => $_POST['ses_rc_strt'],
        "ses_rc_end" => $_POST['ses_rc_end'],
        "note" => mysqli_real_escape_string($cn,$_POST['note']),
        "submitter" => $_POST['submitter'],
        "submit_timestamp" => $_POST['submit_timestamp']
    );
    $casid = $register_data['cas_id'];
    $ses_id = $register_data['ses_id'];

    //echo"<pre>";print_r($register_data);echo"</pre>";
    // update case:
    update_session($cn, $register_data, $ses_id);
    header("location:sescase.php?caseedit&sescase&casid=" . $casid . "&sesid=" . $ses_id);

    $nm = get_fullname_from_user_id($cn, $_GET['casid']);
    $first_name = $nm['frst_nm'];
    $last_name = $nm['lst_nm'];
    $message[] = "Session for (" . $first_name . " " . $last_name . ") is successfully updated!";


}

if(isset($_GET['sesdeleted'])===true){
	$message[]="Session was deleted! ";
}


?>

			<div class="screen">

				<div class="screencontainer">
                    <form action="sescase.php" method="get" name="cas_month">
                    <?php
                    if(isset($_GET['casid'])===true) {
                        if(isset($_GET['ses_mnth'])===true){
                           $month=$_GET['ses_mnth'];
                        }else{
                            $month=date("Y-m",time());
                        }
                    ?>
                        <select name="ses_mnth">
                    <?php
                        case_months_opt($cn, $_GET['casid'],$month);
                    ?>
                        </select>
                        <input type="hidden" name="caseedit">
                        <input type="hidden" name="sescase">
                        <input type="hidden" name="casid" value="<?php echo $_GET['casid']; ?>">
                        <input type="submit" name="cas_month" value="Show">
                    </form>
                    <?php
                    }
                    ?>sessions of:

					<?php 
						if (isset($_GET['casid'])===true){
							$nm=get_fullname_from_user_id($cn,$_GET['casid']);
							echo "<spam class='yellowfont'>".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm']."</spam>";
						}					
					?><br>
				<?php //test:	
				//echo uc_frst_char_words("ibRAHIm saLeM");
				?>
					
					<?php  echo messages($message); ?>
                    <form id="casesesform" action="sescase.php" method="post">
					<div class="leftscreen">
						<div class="discreen">
							<div class="formcolumn">
								<div class="sessions">
									
									<?php
									
                                        if (isset($_GET['casid'])===true){
                                            $case_id=$_GET['casid'];
                                            case_sessions($cn, $case_id,$user_data['usr_id'],$month);
                                        }

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
                                    $exc_fine=$ses_data['exc_fine'];
                                    $abs_fine=$ses_data['abs_fine'];
                                    $price_stat=$ses_data['price_stat'];
                                    $rglr_price= $ses_data['rglr_price'];
                                    $sngl_price= $ses_data['sngl_price'];
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
									<select class="txtbx" name="srv_cd"<?php if(allowed_prv($cn,$user_data['usr_id'],$args=[1,2])===false){echo "style='pointer-events: none;'";}?>>
									<?php
										session_type($cn,$srv_cd);
									?> 
									</select><br>
									<label> Session status: </label><br>
									<select class="txtbx" name="stat">
									<?php
                                    if(allowed_prv($cn,$user_data['usr_id'],$args=[1,2])===true){
										ses_stat_op($cn, $ses_stat);
                                    }else{
                                    
                                       nonadmin_ses_stat_op($cn, $stat_id); 
                                        
                                       // mail_notify($cn,$to,$usr_id,$note_id);
                                    }
									?>
									</select><br>
									<label>Session date:</label><br>
									<input type="date" class="txtbx" value="<?php echo $ses_day; ?>" name="ses_day" <?php if(allowed_prv($cn,$user_data['usr_id'],$args=[1,2])===false){echo "style='pointer-events: none;'";}?>><br>
									<label>Session reference time:</label><br>
									<input type="time" class="txtbx" value="<?php echo $ses_rf_tm; ?>" name="ses_rf_tm" <?php if(allowed_prv($cn,$user_data['usr_id'],$args=[1,2])===false){echo "style='pointer-events: none;'";}?>><br>
									<label> Therapist:</label><br>
									<select class="txtbx" name="thrp_id">
										<?php
											therapist_list_op($cn,$thrp_id);
										?>
									</select><br>
									<label>Case attendance (or excuse) at:</label><br>
									<input type="date" class="txtbx" value="<?php echo $ses_rc_day;?>" name="ses_rc_day"><br>									
									<input type="time" class="txtbx" value="<?php echo $attend_tm; ?>" name="attend_tm"><br>									
									<label>Session actual start time:</label><br>
									<input type="time" class="txtbx" value="<?php echo $ses_rc_strt; ?>" name="ses_rc_strt"><br>									
									<label>Session actual end time:</label><br>
									<input type="time" class="txtbx" value="<?php echo $ses_rc_end; ?>" name="ses_rc_end"><br>									
									<label> Note:</label><br>
									<textarea class="txtbx" name="note"><?php echo $note; ?></textarea>
                                <?php
                                      if(allowed_prv($cn,$user_data['usr_id'],$args=[1])==true){
                                ?>
                                    <input type="radio" name="price_stat" value="1" <?php if ($price_stat==1) {echo "checked='checked'";} ?>></inpu><label>Regular session</label> 
                                    <input type="radio" name="price_stat" value="0" <?php if ($price_stat==0) {echo "checked='checked'";} ?>><label>Single session</label></br></br>
                            
                                    <label> Regular price:  	</label><input type="number" class="txtboxnum" name="rglr_price" value="<?php echo $rglr_price; ?>"></br>
                                    <label> Single price: </label>&nbsp;  <input type="number" class="txtboxnum" name="sngl_price" value="<?php echo $sngl_price; ?>"></br>
                                    <label> Excuse  fine:  	&nbsp; 	&nbsp;</label><input type="number" class="txtboxnum" name="exc_fine" value="<?php echo $exc_fine; ?>"></br>
                                    <label> Absence fine: </label><input type="number" class="txtboxnum" name="abs_fine" value="<?php echo $abs_fine; ?>"><br>
                
                                    <input type="hidden" name="rebook_stat" value="1">
                                    <input type="checkbox" name="rebook_stat" value="0"  <?php if(allowed_prv($cn,$user_data['usr_id'],$args=[1,2])===false){echo "style='pointer-events: none;'";}   if($rebook_stat==0){echo"checked";}  ?>> <label>Hide this session from rebooking</label>
                                    
                                <?php
                                      }else{ // auto-fill data acredited for admins only
                                ?>  
                                          <input type="hidden" name="rebook_stat" value="<?php echo $rebook_stat; ?>">
                                          <input type="hidden" name="price_stat" value="<?php echo $price_stat; ?>">
                                          <input type="hidden" name="rglr_price" value="<?php echo $rglr_price; ?>">
                                          <input type="hidden" name="sngl_price" value="<?php echo $sngl_price; ?>">
                                          <input type="hidden" name="exc_fine" value="<?php echo $exc_fine; ?>">
                                          <input type="hidden" name="abs_fine" value="<?php echo $abs_fine; ?>">
                                <?php
                                      }
                                ?>
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
                <?php // } ?>
				<div class="rightscreen">Cases: <br>
					<div class="rightscreendata">
						<?php
							ses_case_list($cn,$month);
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
					include('widgets/indexwid/Num_nxt_month_actv_cases.php');
				?>
			</table>
		</div>
	</div>
</div>












<?php include("foot.php"); ?>