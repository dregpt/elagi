<?php 
include("core/init.php");
include("head.php");


If(is_logged_in()===false){
	header('location:lgn.php');
}
?>


<?php include("includes/menues/admin_screenmenu.php"); 



if((empty($_POST)===false) && (empty($message)===true)  ){
			$register_data=$_POST['data'];
	
$register_data['detail']=nl2br(htmlentities($register_data['detail'], ENT_QUOTES, 'UTF-8'));

//	echo "<pre>"; print_r($_POST); echo "</pre>";

    $trigger=new Trigger($register_data);

    $result= $trigger->save();
    $message = $trigger->errors;
    if($result===true){

        $message[] = "New trigger ({$trigger->trig_nm}) is added.";
    }



}


if(isset($_GET['trigdeleted'])===true){
	$message[] = "Trigger is deleted!";
}

?>

			<div class="frmscreen">
				<form action="triggeradd.php" method="post">

                <div class="leftscreen">Add Trigger: <br><br><?php  echo messages($message); ?>

                    <?php include("includes/forms/triggersform.php");  ?>
                    <input type="submit" class="buttom1" value="Add trigger">
                    </div>
                    </fieldset>
                </div>
				</form>
				<div class="rightscreen">All behavior triggers: <br>
					<div class="rightscreendata">
                        <?php

                        triggers_table();
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