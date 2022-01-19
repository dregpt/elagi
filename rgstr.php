<?php 
include("core/init.php");
include("head.php"); 

include("includes/menues/login_screenmenu.php");
?>

			
			
			<div class="login_screen">
				<form action="lgn.php" method="post">
					<fieldset class="login_form">
					<legend>Login</legend>
						<label> Email:</label><br>
						<input type="email" class="txtbx" name="email"><br>
						<label> Password:</label><br>
						<input type="password" class="txtbx" name="ch_name"><br>
						<input type="submit" class="buttom1" value="Login"><br><br>	
						<a href="rgstr.php"></a>
					</fieldset>
				</form> 
			</div>
		</div>
	</div>
</div>












<?php include("foot.php"); ?>