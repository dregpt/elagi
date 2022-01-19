<?php 
include("core/init.php");
include("head.php");

If(is_logged_in()===false){
	header('location:lgn.php');
}	
?>

	



<?php include("includes/menues/admin_screenmenu.php"); 

if(empty($_POST)===false){
	//$message[]="submitted!";
	
	if(empty($message)===true){
		if(email_is_found($cn,$_POST['eml'])===true){
			$email=$_POST['eml'];
			$message[]= "This email is already registered: (".$email.")";
		}
		
		if($_POST['pswrd'] !==  $_POST['pswrd2']){
			$message[]= "Passwords not match!";
		}
		
		if((phon_is_found($cn,$_POST['ph1'])===true)||(phon_is_found($cn,$_POST['ph2'])===true)){
			$phon1 = $_POST['ph1'];
			$phon2 = $_POST['ph2'];
			$message[]= "This phone number is already registered for another user: (".$phon1.$phon2.")";
		}
		
		if(preg_match("/\\s/",$_POST['frst_nm'])==true){
			$frst_nam=ucfirst($_POST['frst_nm']);
			$message[]= "First name is only one name and mustn't contain any spaces: (".$frst_nam.")";
		}		
		
		if(preg_match("/\\s/",$_POST['lst_nm'])==true){
			$lst_nam=ucfirst($_POST['lst_nm']);
			$message[]= "Last name is only one name and mustn't contain any spaces: (".$lst_nam.")";
		}
	}
}

if((empty($_POST)===false) && (empty($message)===true)  ){
			$register_data=array(
			"frst_nm"   => uc_frst_char_words($_POST['frst_nm']),
			"lst_nm"    => uc_frst_char_words($_POST['lst_nm']),
			"dob"       => strtotime($_POST['dob']),
			"eml"       => $_POST['eml'],
			"pswrd"     => $_POST['pswrd'],
			"ph1"       => $_POST['ph1'],
			"ph2"       => $_POST['ph2'],
			"dow"       => strtotime($_POST['dow']),
			"usr_catg"  => $_POST['usr_catg'],
			"fxd_sal"   => $_POST['fxd_sal'],
			"sal"       => $_POST['sal'],
			"rat_sal"   => $_POST['rat_sal'],
			"rat_catg"  => $_POST['rat_catg'],  
			"rat_by"    => $_POST['rat_by'],
			"submitter" => $_POST['submitter'],
			"submit_timestamp" => $_POST['submit_timestamp']
		);
	
		add_user($cn,$register_data);
												$first_name=$register_data['frst_nm'];
												$last_name = $register_data['lst_nm'];
	//print_r($_POST);
		$message[]="User (".$first_name." ".$last_name.") is successfully added!";
}

if(isset($_GET['userdeleted'])===true){
	$message[] = "User is deleted!";
}
?>

			<div class="screen">
				<form action="useradd.php" method="post">
				<div class="screencontainer">Edit user categories:
					<?php  echo messages($message); ?>
					<div class="leftscreen">
						<div class="discreen">
							<div class="formcolumn">
								<fieldset>
								<legend>Personal Information</legend>
									<label> First name:</label><br>
									<input type="text" class="txtbx" name="frst_nm" required maxlength="20"><br>
									<label> Last name:</label><br>
									<input type="text" class="txtbx" name="lst_nm" required maxlength="20"><br>
									<label> Date of birth (DOB):</label><br>
									<input type="date" class="txtbx" name="dob"><br>
								</fieldset>
								<fieldset>
								<legend>Contact information</legend>
									<label> Address:</label><br>
									<input type="text" class="txtbx" name="address" maxlength="300"><br>
									<label> Email:</label><br>
									<input type="email" class="txtbx" name="eml" required maxlength="100"><br>
									<label>Password:</label><br>
									<input type="password" class="txtbx" name="pswrd" required maxlength="30"><br>
									<label> Retype password:</label><br>
									<input type="password" class="txtbx" name="pswrd2" required maxlength="30"><br>
									<label> Phone number 1:</label><br>
									<input type="tel" class="txtbx" name="ph1" placeholder="" pattern="[0-9]{11}" required maxlength="11"><br>
									<label> Phone number 2:</label><br>
									<input type="tel" class="txtbx" name="ph2" placeholder="" pattern="[0-9]{11}" maxlength="11"><br>

								</fieldset>
							</div>
							<div class="formcolumn">
								<fieldset>
								<legend>Index data</legend>
									<label> First date of work (DOW):</label><br>
									<input type="date" class="txtbx" name="dow"><br>
									<label> User category:</label><br>
									<select class="txtbx" name="usr_catg" required>
									  <option disabled selected value value=""> -- select user category -- </option>
									  <?php
										 get_user_categories_opt($cn);
									  ?>
									</select><br>
								</fieldset>
								<fieldset>
								<legend>Sallary setting</legend>
									<label> <input type="hidden" name="fxd_sal" value="0"> <input type="checkbox" name="fxd_sal"  value="1" >Fixed sallary:</label><br>
									<input type="number"  class="txtbx" name="sal" step=1><br>
									<label> <input type="hidden" name="rat_sal" value="0"> <input type="checkbox" name="rat_sal"  value="1"> Rate category:</label><br>
									<input type="hidden" name="rat_catg" value="0"><select class="txtbx" name="rat_catg">
									  <option disabled selected value value=""> -- select rate category -- </option>
									  <?php
										 get_rat_categories_opt($cn);
									  ?>
									</select><br>
									<label> Rate by:</label><br><input type="hidden" name="rat_by" value="0">
									<input type="radio" name="rat_by" class="txtbx" value="1">Hour<br>
									<input type="radio" name="rat_by" class="txtbx" value="2">Session
								</fieldset>
							</div>
							<div class="formcolumn">
								<input type="hidden" value="<?php echo $user_data['usr_id']; ?>" name="submitter">
								<input type="hidden" value="<?php echo time();?>" name="submit_timestamp">
								<input type="button" class="buttom1" onClick="window.location.href='usercatgadd.php'" value="Refresh">
								<input type="button" class="buttom1" onclick="window.location.href='usercatgadd.php'" value="New">
								<input type="submit" class="buttom1" value="Add user">
								<input type="button" class="buttom1" onclick="window.location.href='usercatgedit.php'" value="Edit user">

							</div>
						</div>
					</div>
				</div>
				</form>
				<div class="rightscreen">Added categories: <br>
					<div class="rightscreendata">
						<?php
							get_recent_added_users($cn);
					 	?>
					</div>
				</div>	
		</div>
		</div>
		<div class="sidebar">
			<table>
				<?php
					include('widgets/indexwid/nouserswid.php');
				?>
			</table>
		</div>
	</div>
</div>












<?php include("foot.php"); ?>