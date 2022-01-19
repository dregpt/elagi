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
		if(category_is_found($cn,$_POST['usr_catg_name'])===true){
			$usr_catg_name=$_POST['usr_catg_name'];
			$message[]= "This category is already registered: (".$usr_catg_name.")";
		}
		if(category_cd_is_found($cn,$_POST['usr_catg_cod'])===true){
			$usr_catg_cod=$_POST['usr_catg_cod'];
			$message[]= "This code is already registered: (".$usr_catg_cod.")";
		}
			
	}
}

if((empty($_POST)===false) && (empty($message)===true)  ){
			$register_data=array(
			"usr_catg_name"    => uc_frst_char_words($_POST['usr_catg_name']),
			"usr_catg_cod"     => uc_frst_char_words($_POST['usr_catg_cod']),
			"usr_catg_prv"     => $_POST['usr_catg_prv'],
			"submitter"        => $_POST['submitter'],
			"submit_timestamp" => $_POST['submit_timestamp']
		);
	
		add_user_category($cn,$register_data);
												$usr_catg_name=$register_data['usr_catg_name'];

	//echo "<pre>"; print_r($_POST); echo "</pre>";
		$message[]="Therapist (".$usr_catg_name.") is successfully added!";
}


if(isset($_GET['usercatgdeleted'])===true){
	$message[] = "Category is deleted!";
}

?>

			<div class="screen">
				<form action="usercatgadd.php" method="post">
				<div class="screencontainer"><!--Add page title here --> <br>

					
					<?php  echo messages($message); ?>
					<div class="leftscreen">
						<div class="discreen">
							<div class="formcolumn">
							</div>
							<div class="formcolumn">Add user category: <br>
								<fieldset>
								<legend>Index data</legend>
									<label> Category name:</label><br>
									<input type="text" class="txtbx" name="usr_catg_name" placeholder="" required maxlength="50"><br>
									<label> Category code:</label><br>
									<input type="text" class="txtbx" name="usr_catg_cod" placeholder="" required maxlength="5"><br>
									<label> Privilege:</label><br>
									<select class="txtbx" name="usr_catg_prv" required>
									  <option disabled selected value value=""> -- Privilege -- </option>
									  <?php
										 get_prv_opt($cn);
									  ?>
									</select><br>
								</fieldset>
                                <input type="hidden" value="<?php echo time();?>" name="submit_timestamp">
                                <input type="hidden" value="<?php echo $user_data['usr_id']; ?>" name="submitter">
                                <input type="button" class="buttom1" onClick="window.location.href='usercatgadd.php?admin&usercatgadd'" value="Refresh">
                                <input type="button" class="buttom1" onclick="window.location.href='usercatgadd.php?admin&usercatgadd'" value="New">
                                <input type="submit" class="buttom1" value="Add category">
							</div>
						</div>
					</div>
				</div>
				</form>
				<div class="rightscreen">User categories: <br>
					<div class="rightscreendata">

						<?php
							get_default_user_categories($cn);
							get_all_user_categories($cn);
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