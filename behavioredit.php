<?php 
include("core/init.php");
include("head.php");


If(is_logged_in()===false){
	header('location:lgn.php');
}
?>


<?php include("includes/menues/admin_screenmenu.php");

if(isset($_GET['behav_id'])===true){
    $behav_id=$_GET['behav_id'];
    $behavior=Behavior::find_by_id($behav_id);
}else{
    $arrayy=$_POST['data'];
    $behavior=Behavior::find_by_id($arrayy['behav_id']);
}


if((empty($_POST)===false) && (empty($message)===true)  ){
    $register_data=$_POST['data'];

    $register_data['detail']=nl2br(htmlentities($register_data['detail'], ENT_QUOTES, 'UTF-8'));
//	echo "<pre>"; print_r($_POST); echo "</pre>";
    $array1=$register_data;
    $string='';
    foreach($array1 as $key => $value){
        if(strstr($key,"trigs")){
            $string.=",".$value;
            unset($register_data[$key]);
        }
    }
    $string= substr($string,1);
    $register_data['trigs']=$string;

    $behavior->merge_attributes($register_data);
    if(!empty($behavior->errors)){
        $message = $behavior->errors;
    }

    $result= $behavior->save();
    $message=$behavior->errors;
    if($result===true){
        $message[] = "Behavior ({$behavior->behav_nm}) is updated.";
    }
}

?>

			<div class="frmscreen">
				<form action="behavioredit.php" method="post">

                <div class="leftscreen">Edit Trigger: <br><br><?php  echo messages($message); ?>

                    <?php include("includes/forms/behaviorform.php");  ?>
                    <input type="submit" class="buttom1" value="Save">
                    </div>
                    </fieldset>
                </div>
				</form>
				<div class="rightscreen">All behaviors: <br>
					<div class="rightscreendata">
                        <?php

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