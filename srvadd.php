<?php 
include("core/init.php");
include("head.php");


If(is_logged_in()===false){
	header('location:lgn.php');
}
?>


<?php include("includes/menues/admin_screenmenu.php"); 

if(empty($_POST)===false){
	
	if(empty($message)===true){
		if(service_is_found($cn,$_POST['srv_nm'])===true){
			$srv_nm=$_POST['srv_nm'];
			$message[]= "This service is already registered on system: (".$srv_nm.")";
		}
		if(service_cd_is_found($cn,$_POST['srv_cd'])===true){
			$srv_cd=$_POST['srv_cd'];
			$message[]= "This service code is already registered: (".$srv_cd.")";
		}
			
	}
}

if((empty($_POST)===false) && (empty($message)===true)  ){
			$register_data=array(
			"srv_nm"         => uc_frst_char_words($_POST['srv_nm']),
			"srv_cd"         => strtoupper($_POST['srv_cd']),
			"srv_ordr"       => $_POST['srv_ordr'],
			"srv_hr"         => $_POST['srv_hr'], 
			"srv_sngl_price" => $_POST['srv_sngl_price'],
			"srv_rglr_price" => $_POST['srv_rglr_price'],
			"excuse_fn"      => $_POST['excuse_fn'],
			"absence_fn"     => $_POST['absence_fn'],
			
			"submitter"        => $_POST['submitter'],
			"submit_timestamp" => $_POST['submit_timestamp']
		);
	
		add_service($cn,$register_data);
												$srv_nm=$register_data['srv_nm'];

	//echo "<pre>"; print_r($_POST); echo "</pre>";
		$message[]="Service (".$srv_nm.") is successfully added!";
}


if(isset($_GET['srvdeleted'])===true){
	$message[] = "Service is deleted!";
}


?>

			<div class="screen">
				<form action="srvadd.php" method="post">
				<div class="screencontainer"><!--Add page title here --> <br>

					
					<?php  echo messages($message); ?>
					<div class="leftscreen">
						<div class="discreen">
							<div class="formcolumn">
							</div>
							<div class="formcolumn">Add therpeutic service: <br>
								<fieldset>
								<legend>Index data</legend>
									<label> Service name:</label><br>
									<input type="text" class="txtbx" name="srv_nm" placeholder="Choose a name for your therapeutic service .." required maxlength="100"><br>
									<label> Code:</label><br>
									<input type="text" class="txtbx" name="srv_cd" placeholder="Choose short name for the service like PT .." required maxlength="2"><br>
									<label>Ordering:</label><br>
									<input type="number" class="txtbx" name="srv_ordr" placeholder="Start with 10" required min="10" max="1000"><br>
									<label> Session length:</label><br>
									<select class="txtbx" name="srv_hr" required>
									  <option disabled selected value value=""> -- Select service session duration -- </option>
									  <option value="30">1/2 hour</option>
									  <option value="60">1 hour</option>
									  <option value="90">1.5 hours</option>
									  <option value="120">2 hours</option>
									  <option value="150">2.5 hours</option>
									  <option value="180">3 hours</option>
									</select><br>
									<label>Single session price:</label><br>
									<input type="number" class="txtbx" name="srv_sngl_price" placeholder="" required min="0" max="10000"><br>
									<label>Regular session price:</label><br>
									<input type="number" class="txtbx" name="srv_rglr_price" placeholder="" required min="0" max="10000"><br>
									<label>Excuse fine:</label><br>
									<input type="number" class="txtbx" name="excuse_fn" placeholder="" required min="0" max="500"><br>
									<label>Absence fine:</label><br>
									<input type="number" class="txtbx" name="absence_fn" placeholder="" required min="0" max="500"><br>
								</fieldset>
                                <input type="hidden" value="<?php echo time();?>" name="submit_timestamp">
                                <input type="hidden" value="<?php echo $user_data['usr_id']; ?>" name="submitter">
                                <input type="button" class="buttom1" onClick="window.location.href='srvadd.php'" value="Refresh">
                                <input type="button" class="buttom1" onclick="window.location.href='srvadd.php'" value="New">
                                <input type="submit" class="buttom1" value="Add service">
							</div>
						</div>
					</div>
				</div>
				</form>
				<div class="rightscreen">Servises: <br>
					<div class="rightscreendata">

						<?php
							get_all_srv_list($cn);
						?>
					</div>
				</div>	
		</div>
		</div>
		<div class="sidebar">
			<table>
				<?php
					//include('widgets/indexwid/nothrpswid.php');
				?>
			</table>
		</div>
	</div>
</div>












<?php include("foot.php"); ?>