<?php 
include("core/init.php");
include("head.php");


If(is_logged_in()===false){
	header('location:lgn.php');
}
?>


<?php include("includes/menues/cases_screenmenu.php"); 

if(empty($_POST)===false){
	
	if(empty($message)===true){
		if(get_email_from_user_id($cn,$_POST['usr_id'])!==$_POST['eml']){
			if(email_is_found($cn,$_POST['eml'])===true){
				$email=$_POST['eml'];
				$message[]= "This email is already registered: (".$email.")";
			}
		}
		
		$phones = get_phones_from_user_id($cn,$_POST['usr_id']);
		if($phones['ph1']!==$_POST['ph1']){
			if((phon_is_found($cn,$_POST['ph1'])===true)||(phon_is_found($cn,$_POST['ph2'])===true)){
				$phon1 = $_POST['ph1'];
				$message[]= "The phone1 number (".$phon1.") is already registered for another user ";
			}
		}
		if(preg_match("/\\s/",$_POST['frst_nm'])==true){
			$frst_nam=ucfirst($_POST['frst_nm']);
			$message[]= "First name is only one name and mustn't contain any spaces: (".$frst_nam.")";
		}
		if(preg_match("/\\s/",$_POST['scnd_nm'])==true){
			$frst_nam=ucfirst($_POST['scnd_nm']);
			$message[]= "Second name is only one name and mustn't contain any spaces: (".$frst_nam.")";
		}
		if(preg_match("/\\s/",$_POST['thrd_nm'])==true){
			$frst_nam=ucfirst($_POST['thrd_nm']);
			$message[]= "Third name is only one name and mustn't contain any spaces: (".$frst_nam.")";
		}
		
		if(preg_match("/\\s/",$_POST['lst_nm'])==true){
			$lst_nam=ucfirst($_POST['lst_nm']);
			$message[]= "Last name is only one name and mustn't contain any spaces: (".$lst_nam.")";
		}
		
		$name = get_fullname_from_user_id($cn,$_POST['usr_id']);
		if($name['frst_nm']!==$_POST['frst_nm']&&$name['scnd_nm']!==$_POST['scnd_nm']&&$name['thrd_nm']!==$_POST['thrd_nm']&&$name['lst_nm']!==$_POST['lst_nm']){
			if(fullname_is_found($cn,$_POST['frst_nm'],$_POST['scnd_nm'],$_POST['thrd_nm'],$_POST['lst_nm'])===true){
				$message[]= "This full name (".$_POST['frst_nm']." ".$_POST['scnd_nm']." ".$_POST['thrd_nm']." ".$_POST['lst_nm'].") is previously registered";
			}
		}
	}
}

if((empty($_POST)===false) && (empty($message)===true)){
			$register_data=array(
			"frst_nm"   => uc_frst_char_words(mysqli_real_escape_string($cn,$_POST['frst_nm'])),
			"scnd_nm"   => uc_frst_char_words(mysqli_real_escape_string($cn,$_POST['scnd_nm'])),
			"thrd_nm"   => uc_frst_char_words(mysqli_real_escape_string($cn,$_POST['thrd_nm'])),
			"lst_nm"    => uc_frst_char_words(mysqli_real_escape_string($cn,$_POST['lst_nm'])),
			"fthr_wrk"  => mysqli_real_escape_string($cn,$_POST['fthr_wrk']),
			"mthr_nm"   => uc_frst_char_words(mysqli_real_escape_string($cn,$_POST['mthr_nm'])),
			"mthr_wrk"  => mysqli_real_escape_string($cn,$_POST['mthr_wrk']),
			"address"   => mysqli_real_escape_string($cn,$_POST['address']),
			"dob"       => strtotime($_POST['dob']),
			"eml"       => $_POST['eml'],
			"ph1"       => $_POST['ph1'],
			"ph2"       => $_POST['ph2'],
			"file_id"   => $_POST['file_id'],
			"referral"  => mysqli_real_escape_string($cn,$_POST['referral']),
			"dof"       => strtotime($_POST['dof']),
			"usr_catg"  => $_POST['usr_catg'],
			"submitter" => $_POST['submitter'],
			"submit_timestamp" => $_POST['submit_timestamp']
		);
		 $usr_id= $_POST['usr_id'];
		// update case:
	    update_user($cn,$register_data, $usr_id);
		header("location:cont.php?edcasid=".$usr_id);

	//echo "<pre>"; print_r($_POST); echo "</pre>";
													$first_name =$register_data['frst_nm'];
													$last_name =$register_data['lst_nm'];
		$message[]="Case (".$first_name." ".$last_name.") is successfully updated!";
}


if(isset($_GET['casedit'])===true){

?>
	<input type="hidden" id="frst_nm" value="<?php echo $_GET['frst_nm']; ?>">
	<input type="hidden" id="scnd_nm" value="<?php echo $_GET['scnd_nm']; ?>">
	<input type="hidden" id="thrd_nm" value="<?php echo $_GET['thrd_nm']; ?>">
	<input type="hidden" id="lst_nm" value="<?php echo $_GET['lst_nm']; ?>">
	<input type="hidden" id="fthr_wrk" value="<?php echo $_GET['fthr_wrk']; ?>">
	<input type="hidden" id="mthr_wrk" value="<?php echo $_GET['mthr_wrk']; ?>">
	<input type="hidden" id="mthr_nm" value="<?php echo $_GET['mthr_nm']; ?>">
	<input type="hidden" id="address" value="<?php echo $_GET['address']; ?>">
	<input type="hidden" id="dob" value="<?php echo date('Y-m-d',(int)($_GET['dob'])); ?>">
	<input type="hidden" id="eml" value="<?php echo $_GET['eml']; ?>">
	<input type="hidden" id="ph1" value="<?php echo $_GET['ph1']; ?>">
	<input type="hidden" id="ph2" value="<?php echo $_GET['ph2']; ?>">
	<input type="hidden" id="file_id" value="<?php echo $_GET['file_id']; ?>">
	<input type="hidden" id="referral" value="<?php echo $_GET['referral']; ?>">
	<input type="hidden" id="dof" value="<?php echo date('Y-m-d',(int)($_GET['dof'])); ?>">
<?php
}

if(isset($_GET[''])===true){
	//$message[]="You have to select a case first from the left hand side list. ";
}


?>

			<div class="screen">
				<form id="caseeditform" action="caseedit.php" method="post">
				<div class="screencontainer">Edit case: <br>
				<?php //test:	
				//echo uc_frst_char_words("ibRAHIm saLeM");
				?>
					
					<?php  echo messages($message); ?>
					<div class="leftscreen">
						<div class="discreen">
							<div class="formcolumn">
								<fieldset>
								<legend>Personal Information</legend>
									<input type="hidden" id="usr_id" name="usr_id" value="<?php echo $_GET['cd']?>">
                                    <div class="startendgrid">
									<label> Case's first name:</label><label> Case's 2nd name:</label>
									<input type="text" class="txtbx" name="frst_nm" placeholder="" required maxlength="15" value="<?php
                                        if(isset($_GET['casedit'])===true){echo $_GET['frst_nm'];}?>" >
									<input type="text" class="txtbx" name="scnd_nm" placeholder="" required maxlength="15" value="<?php
                                        if(isset($_GET['casedit'])===true){echo $_GET['scnd_nm'];}?>">
                                    </div>
                                    <div class="startendgrid">
									<label> Case's 3rd name:</label><label> Case's 4th name:</label>
									<input type="text" class="txtbx" name="thrd_nm" required maxlength="15"  value="<?php
                                        if(isset($_GET['casedit'])===true){echo $_GET['thrd_nm'];}?>" >
									<input type="text" class="txtbx" name="lst_nm" required maxlength="15"   value="<?php
                                        if(isset($_GET['casedit'])===true){echo $_GET['lst_nm'];}?>" >
                                    </div>
									<label> Father's work:</label><br>
									<input type="text" class="txtbx" name="fthr_wrk" required maxlength="200" value="<?php
                                        if(isset($_GET['casedit'])===true){echo $_GET['fthr_wrk'];}?>"><br>
                                    <div class="startendgrid">
									<label> Mother's name:</label><label> Mother's work:</label>
									<input type="text" class="txtbx" name="mthr_nm" required maxlength="80"   value="<?php
                                        if(isset($_GET['casedit'])===true){echo $_GET['mthr_nm'];}?>">
									<input type="text" class="txtbx" name="mthr_wrk" required maxlength="200" value="<?php
                                        if(isset($_GET['casedit'])===true){echo $_GET['mthr_wrk'];}?>">
                                    </div>
								</fieldset>
								<fieldset>
								<legend>Contact information</legend>
									<label> Address:</label><br>
									<input type="text" class="txtbx" name="address" maxlength="200" value="<?php
                                        if(isset($_GET['casedit'])===true){echo $_GET['address'];}?>"><br>
									<label> Email:</label><br>
									<input type="email" class="txtbx" name="eml" maxlength="200" value="<?php
                                        if(isset($_GET['casedit'])===true){echo $_GET['eml'];}?>"><br>
                                    <div class="startendgrid">
									<label> Phone 1 number:</label><label> Phone 2 number:</label>
									<input type="tel" class="txtbx" name="ph1" placeholder="" pattern="[0-9]{11}" maxlength="11" required value="<?php
                                        if(isset($_GET['casedit'])===true){echo $_GET['ph1'];}?>">
									<input type="tel" class="txtbx" name="ph2" placeholder="" pattern="[0-9]{11}" maxlength="11" value="<?php
                                        if(isset($_GET['casedit'])===true){echo $_GET['ph2']; }?>">
                                    </div>
								</fieldset>
							</div>
							<div class="formcolumn">
								<fieldset>
								<legend>Index data</legend>
									<label> File ID:</label><br>
									<input type="tel" class="txtbx" name="file_id" placeholder="17000" pattern="[0-9]{5}" maxlength="5" required value="<?php
                                        if(isset($_GET['casedit'])===true){echo $_GET['file_id'];}?>"><br>
									<label> Date of first evaluation (DOF):</label><br>
									<input type="date" class="txtbx" name="dof" required value="<?php
                                        if(isset($_GET['casedit'])===true){echo date('Y-m-d',(int)($_GET['dof']));}?>"><br>
									<label> Date of birth (DOB):</label><br>
									<input type="date" class="txtbx" name="dob" required value="<?php
                                        if(isset($_GET['casedit'])===true){echo date('Y-m-d',(int)($_GET['dob']));}?>"><br>
									<label> Referral:</label><br>
									<input type="text" class="txtbx" name="referral" value="<?php
                                        if(isset($_GET['casedit'])===true){echo $_GET['referral'];}?>"><br>
								</fieldset>
                                <input type="hidden" value="7" name="usr_catg">
                                <input type="hidden" value="<?php echo time();?>" name="submit_timestamp">
                                <input type="hidden" value="<?php echo $user_data['usr_id']; ?>" name="submitter">
                                <!--<input type="reset" class="buttom1"> -->
                                <input type="button" class="buttom1" onClick="window.location.href='caseedit.php?caseedit" value="Refresh">
                                <input type="button" class="buttom1" onclick="window.location.href='caseadd.php?caseedit'" value="New">
                                <input type="submit" class="buttom1" value="Save" >
							</div>
						</div>
					</div>
				</div>
				</form>
				<div class="rightscreen">Recently added cases: <br>
					<div class="rightscreendata">
						<?php
							get_all_cases_list($cn);
						?>
					</div>
				</div>	
		</div>
		</div>
		<div class="sidebar">
			<table>
				<?php
					include('widgets/indexwid/nocaseswid.php');
					include('widgets/indexwid/num_cur_month_new_cases.php');
				?>
			</table>
		</div>
	</div>
</div>












<?php include("foot.php"); ?>