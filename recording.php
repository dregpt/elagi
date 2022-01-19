<?php 
include("core/init.php");
include("head.php"); 


?>

		



<?php include("includes/menues/record_screenmenu.php"); 

header("regular_rec.php");

?>

			<div class="screen">
				<div class="leftscreen">Left screen</div>
				<div class="rightscreen">Right screen</div>
			</div>
		</div>
		<div class="sidebar">sidebar</div>
	</div>
</div>












<?php include("foot.php");
If(is_logged_in()===false){
    header('location:lgn.php');
}
?>