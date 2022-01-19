<?php 
include("core/init.php");
include("head.php");


If(is_logged_in()===false){
	header('location:lgn.php');
}
?>


<?php include("includes/menues/record_screenmenu.php");



if((empty($_POST)===false) && (empty($message)===true)  ){
			$register_data=$_POST['data'];
	
$register_data['note']=nl2br(htmlentities($register_data['note'], ENT_QUOTES, 'UTF-8'));
	$array1=$register_data;
//    	echo "<pre>"; print_r($register_data); echo "</pre>";

    $userbehav=new UserBehav($register_data);

    $result= $userbehav->save();
    $message = $userbehav->errors;
    if($result===true){

        $message[] = "New behavior () is added for the user() is added.";
    }
}


if(isset($_GET['behavdeleted'])===true){
	$message[] = "Behavior is deleted!";
}

?>

			<div class="frmscreen">
				<form action="userbehavadd.php" method="post">

                <div class="leftscreen">Add behavior: <br><br><?php  echo messages($message); ?>

                    <?php include("includes/forms/userbehavform.php");  ?>
                    <input type="submit" class="buttom1" value="Add behavior">
                    </div>
                    </fieldset>
                </div>
				</form>
				<div class="rightscreen">All behaviors: <br>
					<div class="rightscreendata">
                        <?php
                       // user_behavs_table();
                        behaviors_table();
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