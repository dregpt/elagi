<?php
?>


<!doctype html>
<html>
<head>
    <script data-ad-client="ca-pub-3380658568454331" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<link rel="stylesheet" href="styles/all.css"/>	
	<link rel="stylesheet" href="styles/session.css"/>
    <meta http-equiv="Content-Type" content="text/html" charset=utf-8"/>

	<title>Elagi</title>

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3380658568454331"
            crossorigin="anonymous"></script>
</head>

<body>
	<div class="allsite">
		<!--<div class="header"> 
		</div> -->
		<div class="main">
             <div class="controlmenu">
                <a href="index.php" id="logo"> <img src="img/elgicon.png" alt="Elagi" width="48" height="48" ></a>

                <?php
                if(is_logged_in()===true){
                 include("includes/menues/control_menu.php");
                    echo "<div class='yellowfont'>".$user_data['frst_nm']." ".$user_data['lst_nm']."</div>";
                ?>
                <a id="logout" onClick="return confirm('Are you sure you want to logout?')" href="logout.php" class="logout">
                    <img src="img/icons/power-button.png" class="icon" title="logout">
                </a> 
                 
                 <?php
                 }
                 ?>
            </div>
			
