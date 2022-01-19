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
//    	echo "<pre>"; print_r($register_data); echo "</pre>";

    $behavior=new Behavior($register_data);

    $result= $behavior->save();
    $message = $behavior->errors;
    if($result===true){

        $message[] = "New behavior ({$behavior->behav_nm}) is added.";
    }
}


if(isset($_GET['behavdeleted'])===true){
	$message[] = "Behavior is deleted!";
}

?>

			<div class="frmscreen">
				<form action="behavioradd.php" method="post">

                <div class="leftscreen">Add behavior: <br><br><?php  echo messages($message); ?>

                    <?php include("includes/forms/behaviorform.php");  ?>
                    <input type="submit" class="buttom1" value="Add behavior">
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