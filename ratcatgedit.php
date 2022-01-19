<?php 
include("core/init.php");
include("head.php");


If(is_logged_in()===false){
	header('location:lgn.php');
}
?>


<?php include("includes/menues/admin_screenmenu.php"); 


if(isset($_GET['rat_id'])===true){
    $rat_id=$_GET['rat_id'];
    $rat_catg=RateCatg::find_by_id($rat_id);
}else{
    $arrayy=$_POST['data'];
    $rat_catg=RateCatg::find_by_id($arrayy['rat_id']);
}


if((empty($_POST)===false) && (empty($message)===true)  ){
			$register_data=$_POST['data'];
	
$register_data['detail']=nl2br(htmlentities($register_data['detail'], ENT_QUOTES, 'UTF-8'));
$register_data['rat_cd']=strtoupper($register_data['rat_cd']);
//	echo "<pre>"; print_r($_POST); echo "</pre>";


    $rat_catg->merge_attributes($register_data);
    $result= $rat_catg->save();
    if($result===true){
        $message[] = "Rate category ({$rat_catg->rat_nm}) is updated.";
    }



}


?>

			<div class="frmscreen">
				<form action="triggeredit.php" method="post">

                <div class="leftscreen">Edit rate category: <br><br><?php  echo messages($message); ?>
                            <fieldset>
                                <legend></legend>
                                <label> Category name:</label><br>
                                <input type="text" class="txtbx" name="data[rat_nm]" placeholder="" required maxlength="20"
                                 value="<?php echo $rat_catg->rat_nm; ?>"><br>
                                <label> Category code:</label><br>
                                <input type="text" class="txtbx" name="data[rat_cd]" placeholder="" required maxlength="2"
                                       value="<?php echo $rat_catg->rat_cd; ?>"><br>
                                <label> Rate value (in L.E):</label><br>
                                <input type="number" class="txtbx" name="data[rat]" placeholder="" required
                                       value="<?php echo $rat_catg->rat; ?>"><br>
                                <label> Details:</label><br>
                                <textarea class="txtarea" name="data[detail]" placeholder="" requilred >
                                <?php echo strip_tags(trim($rat_catg->detail)); ?></textarea><br>
                                <div class="btns">
                                    <input type="hidden" name="data[rat_id]" value="<?php echo $rat_catg->rat_id; ?>">
                                    <input type="hidden" value="<?php echo time();?>" name="data[submit_timestamp]"
                                           value="<?php echo $rat_catg->submit_timestamp; ?>">
                                    <input type="hidden" value="<?php echo $user_data['usr_id']; ?>" name="data[submitter]"
                                           value="<?php echo $rat_catg->submitter; ?>">
                                    <input type="button" class="buttom1" onClick="window.location.href='ratcatgadd.php?admin&ratcatgadd'" value="Refresh">
                                    <input type="button" class="buttom1" onclick="window.location.href='ratcatgadd.php?admin&ratcatgadd'" value="New">
                                    <input type="submit" class="buttom1" value="Save">
                                </div>
                            </fieldset>
                </div>
				</form>
				<div class="rightscreen">Rate categories: <br>
					<div class="rightscreendata">
                        <?php

                        rat_catg_table();
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