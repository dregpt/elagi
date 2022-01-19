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
		if(email_is_found($cn,$_POST['eml'])===true){
			$email=$_POST['eml'];
			$message[]= "This email is already registered: (".$email.")";
		}
			
		if((phon_is_found($cn,$_POST['ph1'])===true)||(phon_is_found($cn,$_POST['ph2'])===true)){
			$phon1 = $_POST['ph1'];
			$phon2 = $_POST['ph2'];
			$message[]= "The phone number is already registered for another user ";
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
		
		if(fullname_is_found($cn,$_POST['frst_nm'],$_POST['scnd_nm'],$_POST['thrd_nm'],$_POST['lst_nm'])===true){
			$message[]= "This full name (".$_POST['frst_nm']." ".$_POST['scnd_nm']." ".$_POST['thrd_nm']." ".$_POST['lst_nm'].") is previously registered";
		}
        
        if(file_id_is_found($cn,$_POST['file_id'])===true){
			$message[]= "This file id number is already in use!";
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
			"mthr_wrk"  =>mysqli_real_escape_string($cn, $_POST['mthr_wrk']),
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
	
		add_user($cn,$register_data);
												$first_name=$register_data['frst_nm'];
												$last_name = $register_data['lst_nm'];

	//echo "<pre>"; print_r($_POST); echo "</pre>";
		$message[]="Case (".$first_name." ".$last_name.") is successfully added!";
}


if(isset($_GET['casedeleted'])===true){
	$message[] = "Case is deleted!";
}

?>

			<div class="screen">
				<form action="caseadd.php" method="post">
				<div class="screencontainer">Add new case: <br>
				<?php //test:	
				//echo uc_frst_char_words("ibRAHIm saLeM");
				?>
					
					<?php  echo messages($message); ?>
					<div class="leftscreen">
						<div class="discreen">
							<div class="formcolumn">
								<fieldset>
								<legend>Personal Information</legend>
                                    <div class="startendgrid">
									<label> Case's first name:</label><label> Case's 2nd name:</label>
									<input type="text" class="txtbx" name="frst_nm"  placeholder="" required maxlength="15">
									<input type="text" class="txtbx" name="scnd_nm"  placeholder="" required maxlength="15">
                                    </div>
                                    <div class="startendgrid">
                                    <label> Case's 3rd name:</label><label> Case's 4th name:</label>
									<input type="text" class="txtbx" name="thrd_nm"  required maxlength="15">
									<input type="text" class="txtbx" name="lst_nm"  required maxlength="15">
                                    </div>
                                    <label> Father's work:</label><br>
									<input type="text" class="txtbx" name="fthr_wrk"  required maxlength="200"><br>
                                    <div class="startendgrid">
									<label> Mother's name:</label><label> Mother's work:</label>
									<input type="text" class="txtbx" name="mthr_nm"  required maxlength="80">
									<input type="text" class="txtbx" name="mthr_wrk"  required maxlength="200">
                                    </div>
								</fieldset>
								<fieldset>
								<legend>Contact information</legend>

									<label> Address:</label>
									<input type="text" class="txtbx" name="address"><br>

									<label> Email:</label>
									<input type="email" class="txtbx" name="eml"  maxlength="200">
                                    <div class="startendgrid">
                                    <label> Phone 1 number :</label><label> Phone 2 number :</label>
									<input type="tel" class="txtbx" name="ph1"  placeholder="" pattern="[0-9]{11}" maxlength="11" required>
									<input type="tel" class="txtbx" name="ph2"  placeholder="" pattern="[0-9]{11}" maxlength="11">
                                    </div>
								</fieldset>
							</div>
							<div class="formcolumn">
								<fieldset>
								<legend>Index data</legend>
									<label> File ID:</label><br>
									<input type="tel" class="txtbx" name="file_id"  placeholder="17000" pattern="[0-9]{5}" maxlength="5" required><br>
									<label> Date of first evaluation (DOF):</label><br>
									<input type="date" class="txtbx" name="dof"  required><br>
									<label> Date of birth (DOB):</label><br>
									<input type="date" class="txtbx" name="dob"  required><br>
									<label> Referral:</label><br>
									<input type="text" class="txtbx" name="referral"  ><br>
								</fieldset>
                                <input type="hidden" value="7" name="usr_catg">
                                <input type="hidden" value="<?php echo time();?>" name="submit_timestamp">
                                <input type="hidden" value="<?php echo $user_data['usr_id']; ?>" name="submitter">
                                <input type="button" class="buttom1" onClick="window.location.reload()" value="Refresh">
                                <input type="button" class="buttom1" onclick="window.location.href='caseadd.php?caseedit'" value="New">
                                <input type="submit" class="buttom1" value="Add case">
                                <input type="button" class="buttom1" onclick="window.location.href='caseedit.php?caseedit'" value="Edit case">
                            </div>
						</div>
					</div>
				</div>
				</form>
				<div class="rightscreen">Recently added cases: <br>
					<div class="rightscreendata">
						<?php
							get_recent_added_cases_list($cn);
						?>
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












<?php include("foot.php"); ?>