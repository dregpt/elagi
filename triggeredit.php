<?php 
include("core/init.php");
include("head.php");


If(is_logged_in()===false){
	header('location:lgn.php');
}
?>


<?php include("includes/menues/admin_screenmenu.php");

if(isset($_GET['trig_id'])===true){
    $trig_id=$_GET['trig_id'];
    $trigger=Trigger::find_by_id($trig_id);
}else{
    $arrayy=$_POST['data'];
    $trigger=Trigger::find_by_id($arrayy['trig_id']);
}


if((empty($_POST)===false) && (empty($message)===true)  ){
    $register_data=$_POST['data'];

    $register_data['detail']=nl2br(htmlentities($register_data['detail'], ENT_QUOTES, 'UTF-8'));
//	echo "<pre>"; print_r($_POST); echo "</pre>";


    $trigger->merge_attributes($register_data);
    if(!empty($trigger->errors)){
        $message = $trigger->errors;
    }

    $result= $trigger->save();
    $message=$trigger->errors;
    if($result===true){
        $message[] = "Trigger ({$trigger->trig_nm}) is updated.";
    }



}

?>

			<div class="frmscreen">
				<form action="triggeredit.php" method="post">

                <div class="leftscreen">Edit Trigger: <br><br><?php  echo messages($message); ?>

                    <?php include("includes/forms/triggersform.php");  ?>
                    <input type="submit" class="buttom1" value="Save">
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