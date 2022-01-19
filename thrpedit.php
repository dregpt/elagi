<?php 
include("core/init.php");
include("head.php");


If(is_logged_in()===false){
	header('location:lgn.php');
}
?>


<?php include("includes/menues/ther_screenmenu.php");

if(isset($_GET['usr_id'])){
    $usr_id=$_GET['usr_id']?? false;
}elseif(isset($_POST['user'])){
    $register_data = $_POST['user'];
    $usr_id=get_user_id_from_email($cn,$register_data['eml']);
}

if(!empty($usr_id)) {
    $user = Therapist::find_by_id($usr_id);


    if ((empty($_POST) === false) && (empty($message) === true)) {
        $register_data = $_POST['user'];

        $first_name = $register_data['frst_nm'];
        $last_name = $register_data['lst_nm'];
        $user->merge_attributes($register_data);
        $result = $user->save();

        $message = $user->errors;
        if ($result === true) {
            $message[] = "User (" . $first_name . " " . $last_name . ") is successfully updated!";
        }
    }


?>

			<div class="screen">
				<form id="caseeditform" action="thrpedit.php" method="post">
				<div class="screencontainer">Edit therpist: <br>

					<?php  echo messages($message); ?>
					<div class="leftscreen">
						<div class="discreen">
							<div class="formcolumn">
								<fieldset>
								<legend>Personal Information</legend>
                                    <div class="startendgrid">
									<label> First name:</label><label> Second name:</label>
									<input type="text" class="txtbx" name="user[frst_nm]" placeholder="" required maxlength="15" value="<?php echo $user->frst_nm; ?>">
									<input type="text" class="txtbx" name="user[scnd_nm]" placeholder="" required maxlength="15" value="<?php echo $user->scnd_nm; ?>">
                                    </div>
                                    <div class="startendgrid">
									<label> Third name:</label><label> Fourth name:</label>
									<input type="text" class="txtbx" name="user[thrd_nm]" placeholder="" required maxlength="15" value="<?php echo $user->thrd_nm; ?>">
									<input type="text" class="txtbx" name="user[lst_nm]" placeholder="" required maxlength="15" value="<?php echo $user->lst_nm; ?>">
                                    </div>
								</fieldset>
								<fieldset>
								<legend>Contact information</legend>
									<label> Address:</label><br>
									<input type="text" class="txtbx" name="user[address]" maxlength="200" value="<?php echo $user->address; ?>"><br>
									<label> Email:</label><br>
									<input type="email" class="txtbx" name="user[eml]" maxlength="200" value="<?php echo $user->eml; ?>"><br>
                                    <div class="startendgrid">
									<label> Phone 1 number:</label><label> Phone 2  number:</label>
									<input type="tel" class="txtbx" name="user[ph1]" placeholder="" pattern="[0-9]{11}" maxlength="11" required value="<?php echo $user->ph1; ?>">
									<input type="tel" class="txtbx" name="user[ph2]" placeholder="" pattern="[0-9]{11}" maxlength="11" value="<?php echo $user->ph2; ?>">
                                    </div>
								</fieldset>

							</div>
							<div class="formcolumn">
								<fieldset>
								<legend>Index data</legend>
									<label> Date of birth (DOB):</label><br>
									<input type="date" class="txtbx" name="user[dob]" required value="<?php echo $user->dob; ?>"><br>
                                    <label> First day of work (DOW):</label><br>
                                    <input type="date" class="txtbx" name="dow" value="<?php echo date('Y-m-d',(int)($user->dow)); ?>" ><br>

									<label> Therpist category:</label><br>
									<select id="usr_categ" class="txtbx" name="user[usr_catg]" required >
									  <option disabled selected value value=""> -- Select therpist category -- </option>
									  <?php
										 get_thrp_categories_opt($cn,$user->usr_id);
									  ?>
									</select><br>
								</fieldset>
                                <input type="hidden" value="<?php echo time();?>" name="user[submit_timestamp]">
                                <input type="hidden" value="<?php echo $user_data['usr_id']; ?>" name="user[submitter]">
                                <!--<input type="reset" class="buttom1"> -->
                                <input type="button" class="buttom1" onclick="window.location.href='thrpadd.php?thrpedit'" value="New">
                                <input type="submit" class="buttom1" value="Save" >
							</div>
						</div>
					</div>
				</div>
				</form>
                <?php  } ?>
				<div class="rightscreen">Recently added therapists:
                    <input type="button" class="" onclick="window.location.href='thrpadd.php'" value="New therapist">
                    <br>
					<div class="rightscreendata">
						<?php
                        get_all_employees_list($cn);
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