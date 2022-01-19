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
$register_data['rat_cd']=strtoupper($register_data['rat_cd']);

//	echo "<pre>"; print_r($_POST); echo "</pre>";

    $rat_catg=new RateCatg($register_data);
    $result= $rat_catg->save();
    if($result===true){

        $message[] = "New rate category ({$rat_catg->rat_nm}) is added.";
    }



}


if(isset($_GET['ratdeleted'])===true){
	$message[] = "Rate category is deleted!";
}

?>

			<div class="frmscreen">
				<form action="ratcatgadd.php" method="post">

                <div class="leftscreen">Add rate category: <br><br><?php  echo messages($message); ?>
                            <fieldset>
                                <legend></legend>
                                <label> Category name:</label><br>
                                <input type="text" class="txtbx" name="data[rat_nm]" placeholder="" required maxlength="20"><br>
                                <label> Category code:</label><br>
                                <input type="text" class="txtbx" name="data[rat_cd]" placeholder="" required maxlength="2"><br>
                                <label> Rate value (in L.E):</label><br>
                                <input type="number" class="txtbx" name="data[rat]" placeholder="" required ><br>
                                <label> Details:</label><br>
                                <textarea class="txtarea" name="data[detail]" placeholder="" requilred> </textarea><br>
                                <div class="btns">
                                    <input type="hidden" value="<?php echo time();?>" name="data[submit_timestamp]">
                                    <input type="hidden" value="<?php echo $user_data['usr_id']; ?>" name="data[submitter]">
                                    <input type="button" class="buttom1" onClick="window.location.href='ratcatgadd.php?admin&ratcatgadd'" value="Refresh">
                                    <input type="button" class="buttom1" onclick="window.location.href='ratcatgadd.php?admin&ratcatgadd'" value="New">
                                    <input type="submit" class="buttom1" value="Add category">
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