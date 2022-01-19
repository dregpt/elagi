<?php  


include("core/init.php");					



include("head.php"); 

include("body.php"); 
//include("test.php"); 

 include("foot.php");

If(is_logged_in()===false){
	header('location:lgn.php');
}

?>
