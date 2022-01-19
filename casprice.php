<?php 
include("core/init.php");
include("head.php"); 




?>

	



<?php include("includes/menues/cases_screenmenu.php"); ?>

<?php
if((empty($_POST)===false)){
		
	$update_data=array();		
	$update_data=$_POST;
    

	
	
	$case_id=$_POST['case_id'];
	//echo $case_id;
	//echo "<pre>"; print_r($update_data); echo"</pre>";
	update_ses_price($cn,$update_data,$case_id);

	header('location:casprice.php?caseedit&casprice&priceupdated&casid='.$case_id);

		//add_service($cn,$register_data);

	//echo "<pre>"; print_r($_POST); echo "</pre>";
		//$message[]="Service (".$srv_nm.") is successfully added!";
}

if(isset($_GET['priceupdated'])){
	
	$nm=get_fullname_from_user_id($cn,$_GET['casid']);
				$message[]="Session prices for (".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm'].") have been successfuly updated!";
} 

?>
									
			<div class="screen">
				<form action="casprice.php" method="post"> <br>
				  <div class="screencontainer"> Set session prices for : 
					<?php  
								if (isset($_GET['casid'])===true){
                                    $nm= get_fullname_from_user_id($cn,$_GET['casid']);
									echo "<spam class='yellowfont'>".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm']."</spam>"; 
								}
                    ?>
                    <?php  echo messages($message); ?>
					<div class="leftscreen">
						<div class="uniscreen">
							<div class="formcolumn">
                                
                                <?php   if(isset($_GET['casid'])===true){      ?>
                                <fieldset>
								<legend>

                                </legend>
									<table class="session_timing" >
									  <tr>
										<th></th>
										<th><input type="hidden" value="Sat">Regular price</th>
										<th><input type="hidden" value="Sun">Single price</th>
									  </tr>	

                                        <?php
										
											seprice_form($cn,$_GET['casid']);
                                        
                                        ?>
									</table>
                                    <input type="hidden" value="<?php echo time();?>" name="submit_timestamp">
                                    <input type="hidden" value="<?php if(isset($_GET['casid'])===true){echo $_GET['casid'];} ?>" name="case_id">
                                    <input type="hidden" value="<?php echo $user_data['usr_id']; ?>" name="submitter">
                                    <input type='submit' class='buttom1' value='Set session prices'>
								</fieldset>
                                 <?php   }      ?>
							</div>
						</div>
					</div>
				</div>
				</form>
				
				<div class="rightscreen">All cases setting:
					<div class="rightscreendata">
						<?php
							all_case_price_setting($cn);
						?>
					</div>
				</div>		
			
		</div>
		</div>
		<div class="sidebar">sidebar</div>
	</div>
</div>












<?php include("foot.php"); ?>