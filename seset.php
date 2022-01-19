<?php 
include("core/init.php");
include("head.php"); 


//unset($_SESSION["caset_is_set"]);
//unset($_SESSION["nxt_mnth_sess_deleted"]);

//$_SESSION["no_case_to_delete"];
?>

	



<?php include("includes/menues/cases_screenmenu.php"); 

if (isset($_GET['sesetcol'])===true){
	
	$nm=get_fullname_from_user_id($cn,$_GET['sesetcol']);
}

if((empty($_POST)===false)){
		
	$update_data=array();		
	$update_data=$_POST;
	
	
	$case_id=$update_data['casid'];
	//echo "<pre>"; print_r($update_data); echo"</pre>";
	update_seset($cn,$update_data,$case_id);
    if(isset($_SESSION["caset_is_set"])===true){
        header("locastion:seset.php?caseedit&seset");
        $nm=get_fullname_from_user_id($cn,$_SESSION["caset_is_set"]);
		$message[]="Sessions of (".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm'].") is successfully booked for the next month!";
        unset($_SESSION["caset_is_set"]);
    }
}elseif(isset($_POST["casid"])===true && empty($_POST["casid"])===true){
  $message[]="You have to choose a case first to setup his/her booking!"; 
}

if(isset($_GET['mesgalrset'])){
	
    $nm=get_fullname_from_user_id($cn,$_GET['caset']);
    $message[]="The session setting for this case (".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm'].") is already set for the next month!";
    $message[]="You have to delete all sessions for this case first and return back to set them again here.";
} 


if(isset($_SESSION["nxt_mnth_sess_deleted"])===true){
    $nm=get_fullname_from_user_id($cn,$_SESSION["nxt_mnth_sess_deleted"]);
    $message[]="All session bookings of the next month for (".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm'].") is deleted!";
    unset($_SESSION["nxt_mnth_sess_deleted"]);
}

if(isset($_GET["no_case_to_delete"])===true){
    $message[]="You have to choose a case first to delete his/her booking!";
    //unset($_SESSION["no_case_to_delete"]);
}

if(isset($_SESSION['message'])==true){
    $message[]=$_SESSION['message'];
    unset($_SESSION['message']);
}
?>
									
			<div class="screen">
				<form action="seset.php" method="post"> <br>
				  <div class="screencontainer"> Book next month (<?php echo date("F",strtotime("first day of +1 month")) ?> sessions) for :
					<?php  echo messages($message); ?>
					<div class="leftscreen">
                                <?php
                                if(isset($_GET['sesetcol'])===true){
                                ?>
						<div class="uniscreen"><spam class="yellowfont" width="10" style="margin: 5px;">
						<?php
								if (isset($_GET['sesetcol'])===true){
									echo $nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm']; 
								}
						?>
                        
						</spam>
                            <?php
                                    $month=date("Y-m",strtotime("first day of +1 month"));
                                if(is_case_booked_a_month($cn,$_GET['sesetcol'],$month)===true){
                            ?>
                            <spam class="greennote">
                            (This case has sessions booking for (<?php echo date("F Y",strtotime("first day of +1 month"));  ?>) - you have to cancel them to re-book again)
                            </spam>
                            <?php
                                     echo" <div>";
                                }else{
                            ?>

							<div class="formcolumn">
								<fieldset>
								<legend>
                                </legend>
									<table class="session_timing" >
									  <tr>
										<th></th>
										<th><input type="hidden" value="Sat">Saturday</th>
										<th><input type="hidden" value="Sun">Sunday</th>
										<th><input type="hidden" value="Mon">Monday</th>
										<th><input type="hidden" value="Tue">Tuesday</th>
										<th><input type="hidden" value="Wed">Wednesday</th>										  
										<th><input type="hidden" value="Thu">Thursday</th>										  
										<th><input type="hidden" value="Fri">Friday</th>										  
									  </tr>
										<?php
										
											seset_form($cn);
										
										?>
									</table>
								</fieldset>
                                
                                <input type="hidden" name="casid" value="<?php if(isset($_GET['sesetcol'])===true){echo $_GET['sesetcol'];} ?>">
								<input type="hidden" value="<?php echo time();?>" name="submit_timestamp">
								<input type="hidden" value="<?php echo $user_data['usr_id']; ?>" name="submitter">
								<input type='submit' class='buttom1' value='Setup sessions booking for next month'>

                               <?php
                                   
                                }
                                  
                                 if(is_case_booked_a_month($cn,$_GET['sesetcol'],$month)===true){   
                                ?>
                               
								<input type='button' onclick="<?php
                                                                if(isset($_GET['sesetcol'])===true){
                                                              ?>
                                                              location.href='cont.php?deleteallseset=<?php echo $_GET['sesetcol']; ?>';
                                                              <?php
                                                                }else{
                                                              ?>
                                                                    location.href='seset.php?caseedit&seset&no_case_to_delete'
                                                              <?php
                                                                }
                                                              ?>  
                                                              "
                                       class='buttom1' value='Cancel all sessions booking of the next month for this case'>
                                <?php
                                 }
                                 ?>
                                
							</div>
						</div>
                                <?php
                                }
                                ?>
					</div>
				</div>
				</form>
				
				<div class="rightscreen">All cases setting:
					<div class="rightscreendata">
						<?php
							all_case_setting($cn);
						?>
					</div>
				</div>		
			
		</div>
		</div>
		<div class="sidebar">			
            <table class="inforows">
				<?php
					include('widgets/indexwid/nocaseswid.php');
					include('widgets/indexwid/Num_lst_month_actv_cases.php');
					include('widgets/indexwid/Num_crnt_month_actv_cases.php');
					include('widgets/indexwid/Num_nxt_month_actv_cases.php');
				?>
			</table>
</div>
	</div>
</div>












<?php include("foot.php"); ?>