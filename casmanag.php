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
				<div class="screencontainer">Manage case:
					<?php  echo messages($message); ?>
					<div class="leftscreen">
						<div class="discreen">
							<div class="formcolumn">
								<fieldset>
								<legend>Session prices</legend>
									<label> First name:</label><br>
									<input type="text" class="txtbx" name="usr_nm1"><br>
								</fieldset>
								<fieldset>
								<legend>Profile setting:</legend>
									<label> Address:</label><br>
									<input type="text" class="txtbx" name="ch_address"><br>
								</fieldset>
								<fieldset>
								<legend>Session system</legend>
									<label> Address:</label><br>
									<input type="text" class="txtbx" name="ch_address"><br>
								</fieldset>
							</div>
							<div class="formcolumn">
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