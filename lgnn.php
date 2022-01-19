<?php
include("core/init.php");
include("head.php");
include("includes/menues/login_screenmenu.php");


if(empty($_POST)===false){
	
	$email=$_POST['eml'];
	$password=$_POST['pswrd'];
	
	//echo($email."<br>".$password);
	
	if(empty($email)===true || empty($password)===true ){
		$message[]="Enter your email and password";
		
	}elseif(email_is_found($cn,$email)===false){
		$message[]="Invalid login";
		
	}elseif(user_is_active($cn,$email) ===false){
		$message[]="This account isn't activated";
	}else{
		$login=login($cn,$email,$password);
		if($login ===false){
		$message[]="Invalid Email/password";
		}else{
			//set user session
			$_SESSION['user_id']=$login;
			//redirect user to home
			header("location:index.php");
			exit();
		}
	}
}



?>
		<div class="screencontainer">Login:
			<?php  echo messages($message); ?>	
			<div class="login_screen">
				<form action="lgn.php" method="post">
					<fieldset class="login_form">
					<legend>Login</legend>
						<label> Email:</label><br>
						<input type="email" class="txtbx" name="eml"><br>
						<label> Password:</label><br>
						<input type="password" class="txtbx" name="pswrd"><br>
						<input type="submit" class="buttom1" value="Login"><br><br>	
						<a href="rgstr.php">Register</a>
					</fieldset>
				</form> 
			</div>
		</div>
	</div>
</div>












<?php include("foot.php"); ?>