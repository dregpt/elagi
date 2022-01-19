<?php 
include("core/init.php");
include("head.php");

If(is_logged_in()===false){
	header('location:lgn.php');
}	
?>


<?php include("includes/menues/admin_screenmenu.php");

if(isset($_GET['usr_id'])){
    $usr_id=$_GET['usr_id']?? false;
}elseif(isset($_POST['user'])){
    $register_data = $_POST['user'];
    $usr_id=get_user_id_from_email($cn,$register_data['eml']);
}

if(!empty($usr_id)) {
    $user = User::find_by_id($usr_id);


    if ((empty($_POST) === false) && (empty($message) === true)) {
        $register_data = $_POST['user'];

        $first_name = $register_data['frst_nm'];
        $last_name = $register_data['lst_nm'];
        $user->merge_attributes($register_data);
         $result = $user->save();
//echo $user->phon1_is_found();
        $message=$user->errors;
        if ($result === true) {
            $message[] = "User (" . $first_name . " " . $last_name . ") is successfully updated!";
        }
    }



?>

			<div class="screen">
				<form action="useredit.php" method="post">
                    <div class="screencontainer">Edit user profile for: <spam class="yellowfont"><?php echo $user->full_name(); ?></spam>

					<?php  echo messages($message); ?>
					<div class="leftscreen">
						<div class="discreen">
							<div class="formcolumn">
								<fieldset>
								<legend>Personal Information</legend>
									<label> First name:</label><br>
									<input type="text" class="txtbx" name="user[frst_nm]" required maxlength="20" value="<?php echo $user->frst_nm; ?>"><br>
                                    <input type="hidden" name="user[scnd_nm]" value="">
                                    <input type="hidden" name="user[thrd_nm]" value="">
									<label> Last name:</label><br>
									<input type="text" class="txtbx" name="user[lst_nm]" required maxlength="20" value="<?php echo $user->lst_nm; ?>"><br>
									<label> Date of birth (DOB):</label><br>
									<input type="date" class="txtbx" name="user[dob]" value="<?php echo date('Y-m-d',(int)($user->dob)); ?>"><br>
								</fieldset>
								<fieldset>
								<legend>Contact information</legend>
									<label> Address:</label><br>
									<input type="text" class="txtbx" name="user[address]" maxlength="300" value="<?php echo $user->address; ?>"><br>
									<label> Email:</label><br>
									<input type="email" class="txtbx" name="user[eml]" required maxlength="100" value="<?php echo $user->eml; ?>"><br>
									<label>Password:</label><br>
									<input type="password" class="txtbx" name="user[pswrd]" required maxlength="30" value="<?php echo $user->pswrd; ?>"><br>
									<label> Retype password:</label><br>
									<input type="password" class="txtbx" name="user[pswrd2]" required maxlength="30" value="<?php echo $user->pswrd; ?>"><br>
									<label> Phone number 1:</label><br>
									<input type="tel" class="txtbx" name="user[ph1]" placeholder="" pattern="[0-9]{11}" required maxlength="11" value="<?php echo $user->ph1; ?>"><br>
									<label> Phone number 2:</label><br>
									<input type="tel" class="txtbx" name="user[ph2]" placeholder="" pattern="[0-9]{11}" maxlength="11" value="<?php echo $user->ph2; ?>"><br>

								</fieldset>
							</div>
							<div class="formcolumn">
								<fieldset>
								<legend>Index data</legend>

                                    <label> User privilege:</label><br>
									<select class="txtbx" name="user[prv]" required>
									  <option disabled selected value value=""> -- select user category -- </option>
									  <?php
										 get_user_categories_opt($cn,$user->usr_id);
									  ?>
									</select><br>
								</fieldset>
                                <fieldset>
								<legend>Profile setting:</legend>
                                    <input type="hidden" name="user[actv]" value="0" > <br>
                                    <input type="checkbox" name="user[actv] "value="1"  <?php if($user->actv==1){echo "checked";} ?> > Active user<br>
                                    <input type="hidden" name="user[prtct]" value="0" > <br>
                                    <input type="checkbox" name="user[prtct]" value="1"  <?php if($user->prtct==1){echo "checked";}  ?> > Protected user
								</fieldset>
                                <input type="hidden" value="<?php echo $user_data['usr_id']; ?>" name="user[submitter]">
                                <input type="hidden" value="<?php echo time(); ?>" name="user[submit_timestamp]">
                                <input type="button" class="buttom1" onClick="window.location.href='useredit.php'" value="Refresh">
                                <input type="button" class="buttom1" onclick="window.location.href='useradd.php'" value="New">
                                <input type="submit" class="buttom1" value="Save">
							</div>
						</div>
					</div>
				</div>
				</form>
                <?php  } ?>
				<div class="rightscreen">All users: <br>
					<div class="rightscreendata">
						<?php
							get_all_users_names($cn);
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