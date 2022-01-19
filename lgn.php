<?php
include("core/init.php");



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

<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset=utf-8"/>
<!--    <meta name="viewport" content="width=device-width, initial-scale=1" >-->
<!--    <link rel="stylesheet" href="styles/all.css"/>-->
    <link rel="stylesheet" type="text/css" media="screen" href="styles/mobile.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="styles/widescreen.css"/>

    <title>Elagi</title>


</head>

<body>
<div class="mobsite">
        <div class="">
            <a href="index.php" ><img id="logo" src="img/elgicon.png" alt="Elagi" ></a>
        </div>
		<div class="screencontainer">
			<div class="message"><?php  echo messages($message); ?></div>
			<div class="">
				<form action="lgn.php" method="post">
					<fieldset class="login_form">
<!--					<legend>Login</legend>-->
						<label> Email:</label>
						<input type="email" class="txtbx" name="eml">
						<label> Password:</label>
						<input type="password" class="txtbx" name="pswrd">
						<input type="submit" class="buttom1" value="Login"><br><br>	
					</fieldset>
				</form> 
			</div>
		</div>
</div>

</body>

</html>














