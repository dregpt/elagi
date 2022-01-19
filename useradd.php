<?php 
include("core/init.php");
include("head.php");

If(is_logged_in()===false){
	header('location:lgn.php');
}	
?>

	



<?php include("includes/menues/admin_screenmenu.php"); 



if((empty($_POST)===false) && (empty($message)===true)  ){
			$register_data=array(
            "frst_nm"   => uc_frst_char_words($_POST['frst_nm']),
            "scnd_nm"   =>'',
            "thrd_nm"   => '',
			"lst_nm"    => uc_frst_char_words($_POST['lst_nm']),
            "dob"       => strtotime($_POST['dob']),
            "dow"       => strtotime($_POST['dow']),
            "address"   => $_POST['address'],
            "eml"       => $_POST['eml'],
            "pswrd"     => $_POST['pswrd'],
            "pswrd2"    => $_POST['pswrd2'],
			"ph1"       => $_POST['ph1'],
			"ph2"       => $_POST['ph2'],
			"prv"       => $_POST['prv'],
			"actv"      => $_POST['actv'],
			"prtct"     => $_POST['prtct'],
			"submitter" => $_POST['submitter'],
			"submit_timestamp" => $_POST['submit_timestamp']
		);

		//add_user($cn,$register_data);
												$first_name=$register_data['frst_nm'];
												$last_name = $register_data['lst_nm'];
        $user= new User($register_data);
//        echo"<br>".$user->predicted_id();
//        echo"<br>". $user->email_is_found();
        $result=$user->save();
       // echo $result;

            $message=$user->errors;

        if($result===true) {
            $message[] = "User (" . $first_name . " " . $last_name . ") is successfully added!";
        }
}

if(isset($_GET['userdeleted'])===true){
	$message[] = "User is deleted!";
}
?>

			<div class="screen">
				<form action="useradd.php" method="post">
				<div class="screencontainer">Add new user:
					<?php
                    echo messages($message);
                    ?>
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
									<input type="date" class="txtbx" name="dob" ><br>
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
									<label> User privilege:</label><br>
									<select class="txtbx" name="prv" required>
									  <option disabled selected value value=""> -- select user category -- </option>
									  <?php
										 get_user_categories_opt($cn);
									  ?>
									</select><br>
								<legend>Profile setting:</legend>
									<input type="hidden" name="actv" value="0"><input type="checkbox" name="actv"  value="1"> Active user<br>
									<input type="hidden" name="prtct" value="0"><input type="checkbox" name="prtct"  value="1"> Protected user
								</fieldset>
                                <input type="hidden" value="<?php echo $user_data['usr_id']; ?>" name="submitter">
                                <input type="hidden" value="<?php echo time();?>" name="submit_timestamp">
                                <input type="button" class="buttom1" onClick="window.location.href='useradd.php'" value="Refresh">
                                <input type="button" class="buttom1" onclick="window.location.href='useradd.php'" value="New">
                                <input type="submit" class="buttom1" value="Add user">
                                <input type="button" class="buttom1" onclick="window.location.href='useredit.php'" value="Edit user">
							</div>

						</div>
					</div>
				</div>
				</form>
				<div class="rightscreen">Recently added users: <br>
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