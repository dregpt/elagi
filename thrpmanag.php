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
}

?>

			<div class="screen">
				<form action="admin.php" method="post">
				<div class="screencontainer">Setting:
					<?php  echo messages($message); ?>
					<div class="leftscreen">
						<div class="discreen">
							<div class="formcolumn">
								<fieldset>
								<legend>General</legend>
									<label> First name:</label><br>
									<input type="text" class="txtbx" name="usr_nm1"><br>
								</fieldset>
								<fieldset>
								<legend>User</legend>
									<label> Address:</label><br>
									<input type="text" class="txtbx" name="ch_address"><br>
								</fieldset>
								<fieldset>
								<legend>Session system</legend>
									<label> Address:</label><br>
									<input type="text" class="txtbx" name="ch_address"><br>
								</fieldset>
								<fieldset>
								<legend>Privileges</legend>
									<label> Address:</label><br>
									<input type="text" class="txtbx" name="ch_address"><br>
								</fieldset>
							</div>
							<div class="formcolumn">
								<fieldset>
								<legend>Sallary category</legend>
									<label> First date of work (DOW):</label><br>
									<input type="date" class="txtbx" name="dow"><br>
									<label> User category:</label><br>
									<select class="txtbx" name="user_categ">
									  <option value="ptst">Physical therpist</option>
									  <option value="otst">Ocupational therapist</option>
									  <option value="spst">Speech therapist</option>
									  <option value="edest">Special educator</option>
									  <option value="secr">Secretary</option>
									  <option value="worker">Worker</option>
									  <option value="case">Case</option>
									  <option value="modr">Moderator</option>
									  <option value="admin">Administrator</option>
									</select><br>
								</fieldset>
								<fieldset>
								<legend>Sallary setting</legend>
									<label> <input type="checkbox" name="sal_type"  value="fixed">Fixed sallary:</label><br>
									<input type="number"  class="txtbx" name="fixed_sal" step=1><br>
									<label><input type="checkbox" name="sal_type"  value="rate"> Rate category:</label><br>
									<select class="txtbx" name="rate_categ">
									  <option value="1">A</option>
									  <option value="2">B</option>
									  <option value="3">C</option>
									  <option value="4">D</option>
									  <option value="5">E</option>
									  <option value="6">F</option>
									</select><br>
									<label> Rate by:</label><br>
									<input type="radio" name="rat_by" class="txtbx" value="1">Hour<br>
									<input type="radio" name="rat_by" class="txtbx" value="2">Session
								</fieldset>
							</div>
							<div class="formcolumn"> 
								<input type="submit" class="buttom1" value="Save">
							</div>
						</div>
					</div>
				</div>
				</form>
				<div class="rightscreen">Recently added cases: <br>
					<div class="rightscreendata">
						<div>Ahmed Mohammed Abderahaman Elsayyed</div><div class="fileid">17023</div>
						<div>Ali Sayyed Hossain Farghaly</div><div class="fileid">17180</div>
						<div>Khadiga Mostafa Ahmed Mohammed</div><div class="fileid">17134</div>
						<div>Mohammed Mamdoh Abdelaleem Hussein</div><div class="fileid">17324</div>
						<div>Ahmed Mohammed Abderahaman Elsayyed</div><div class="fileid">17023</div>
						<div>Ali Sayyed Hossain Farghaly</div><div class="fileid">17180</div>
						<div>Khadiga Mostafa Ahmed Mohammed</div><div class="fileid">17134</div>
						<div>Mohammed Mamdoh Abdelaleem Hussein</div><div class="fileid">17324</div>
						<div>Ahmed Mohammed Abderahaman Elsayyed</div><div class="fileid">17023</div>
						<div>Ali Sayyed Hossain Farghaly</div><div class="fileid">17180</div>
						<div>Khadiga Mostafa Ahmed Mohammed</div><div class="fileid">17134</div>
						<div>Mohammed Mamdoh Abdelaleem Hussein</div><div class="fileid">17324</div>
						<div>Ahmed Mohammed Abderahaman Elsayyed</div><div class="fileid">17023</div>
						<div>Ali Sayyed Hossain Farghaly</div><div class="fileid">17180</div>
						<div>Khadiga Mostafa Ahmed Mohammed</div><div class="fileid">17134</div>
						<div>Mohammed Mamdoh Abdelaleem Hussein</div><div class="fileid">17324</div>
						<div>Ahmed Mohammed Abderahaman Elsayyed</div><div class="fileid">17023</div>
						<div>Ali Sayyed Hossain Farghaly</div><div class="fileid">17180</div>
						<div>Khadiga Mostafa Ahmed Mohammed</div><div class="fileid">17134</div>
						<div>Mohammed Mamdoh Abdelaleem Hussein</div><div class="fileid">17324</div>
						<div>Ahmed Mohammed Abderahaman Elsayyed</div><div class="fileid">17023</div>
						<div>Ali Sayyed Hossain Farghaly</div><div class="fileid">17180</div>
						<div>Khadiga Mostafa Ahmed Mohammed</div><div class="fileid">17134</div>
						<div>Mohammed Mamdoh Abdelaleem Hussein</div><div class="fileid">17324</div>
						<div>Ahmed Mohammed Abderahaman Elsayyed</div><div class="fileid">17023</div>
						<div>Ali Sayyed Hossain Farghaly</div><div class="fileid">17180</div>
						<div>Khadiga Mostafa Ahmed Mohammed</div><div class="fileid">17134</div>
						<div>Mohammed Mamdoh Abdelaleem Hussein</div><div class="fileid">17324</div>
						<div>Ahmed Mohammed Abderahaman Elsayyed</div><div class="fileid">17023</div>
						<div>Ali Sayyed Hossain Farghaly</div><div class="fileid">17180</div>
						<div>Khadiga Mostafa Ahmed Mohammed</div><div class="fileid">17134</div>
						<div>Mohammed Mamdoh Abdelaleem Hussein</div><div class="fileid">17324</div>
					</div>
				</div>	
		</div>
		</div>
		<div class="sidebar">sidebar</div>
	</div>
</div>












<?php include("foot.php"); ?>