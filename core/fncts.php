
<?php


//include("cn.php");


//String functions:


function uc_frst_char_word($words){ //Uppercase first character of the first word only
	$words=$words;
    $lowercase= strtolower($words);
    return ucfirst($lowercase);
}
 
function uc_frst_char_words($words){ //Upper case first character of each word
	$words=$words;
    $lowercase= strtolower($words);
    return ucwords($lowercase);
}



//User functions:

function is_logged_in(){
	if(isset($_SESSION['user_id'])){
		return true;
	}else{
		return false;
	}
}

function fullname_is_found($cn,$frst_nm,$scnd_nm,$thrd_nm,$lst_nm){
	$frst_nm=uc_frst_char_words($frst_nm);
	$scnd_nm=uc_frst_char_words($scnd_nm);
	$thrd_nm=uc_frst_char_words($thrd_nm);
	$lst_nm =uc_frst_char_words($lst_nm);
	
	$query  = "SELECT `usr_id` FROM `users` WHERE `frst_nm`='$frst_nm' AND `scnd_nm`='$scnd_nm' AND `thrd_nm`='$thrd_nm' AND `lst_nm`='$lst_nm'";
	$data =mysqli_query($cn,$query);
	if(mysqli_num_rows($data)===1){
		return true;
	}else{
		return false;
	}}

function another_fullname_is_found($cn,$frst_nm,$scnd_nm,$thrd_nm,$lst_nm){
	$frst_nm=uc_frst_char_words($frst_nm);
	$scnd_nm=uc_frst_char_words($scnd_nm);
	$thrd_nm=uc_frst_char_words($thrd_nm);
	$lst_nm =uc_frst_char_words($lst_nm);
	
	$query  = "SELECT `usr_id` FROM `users` WHERE `frst_nm`='$frst_nm' AND `scnd_nm`='$scnd_nm' AND `thrd_nm`='$thrd_nm' AND `lst_nm`='$lst_nm'";
	$data =mysqli_query($cn,$query);
	if(mysqli_num_rows($data)===2){
		return true;
	}else{
		return false;
	}}


function email_is_found($cn,$email){
	$query = "SELECT `usr_id` FROM `users` WHERE `eml`='$email' ";
	$data =mysqli_query($cn,$query);
	if(mysqli_num_rows($data)===1){
		return true;
	}else{
		return false;
	}
}

function file_id_is_found($cn,$file_id){
	$query = "SELECT `file_id` FROM `users` WHERE `file_id`='$file_id' ";
	$data =mysqli_query($cn,$query);
	if(mysqli_num_rows($data)===1){
		return true;
	}else{
		return false;
	}
}



function another_email_is_found($cn,$email){
	$query = "SELECT `usr_id` FROM `users` WHERE `eml`='$email' ";
	$data =mysqli_query($cn,$query);
	if(mysqli_num_rows($data)===2){
		return true;
	}else{
		return false;
	}
}

function phon_is_found($cn,$phon){
	$query = "SELECT `usr_id` FROM `users` WHERE `ph1`='$phon'";
	$data =mysqli_query($cn,$query);
	if(mysqli_num_rows($data)===1){
		return true;
	}else{
		return false;
	}
}

function another_phon_is_found($cn,$phon){
	$query = "SELECT `usr_id` FROM `users` WHERE `ph1`='$phon'";
	$data =mysqli_query($cn,$query);
	if(mysqli_num_rows($data)===2){
		return true;
	}else{
		return false;
	}
}



function user_is_active($cn,$user_email){
	$query = "SELECT `usr_id` FROM `users` WHERE `eml`='$user_email' AND `actv`=1";
	$data =mysqli_query($cn,$query);
	if(mysqli_num_rows($data)===1){
		return true;
	}else{
		return false;
	}
}

function get_user_id_from_email($cn,$email){
	$query = "SELECT `usr_id` FROM `users` WHERE `eml`='$email'";
	$data=mysqli_query($cn,$query);
	$row= mysqli_fetch_assoc($data);
	return $row['usr_id'];
}

function get_email_from_user_id($cn,$usr_id){
	$query = "SELECT `eml` FROM `users` WHERE `usr_id`='$usr_id'";
	$data=mysqli_query($cn,$query);
	$row= mysqli_fetch_assoc($data);
	return $row['eml'];
}

function get_phones_from_user_id($cn,$usr_id){
	$query="SELECT `ph1`,`ph2`FROM `users` WHERE `usr_id`=$usr_id";
	$run=mysqli_query($cn,$query);
	$phones= mysqli_fetch_assoc($run);
	return $phones;
}

function get_fullname_from_user_id($cn,$usr_id){
	$usr_id=(int)$usr_id;
	$query="SELECT `frst_nm`,`scnd_nm`,`thrd_nm`,`lst_nm` FROM `users` WHERE `usr_id`=$usr_id";
	$run= mysqli_query($cn,$query);
	return mysqli_fetch_assoc($run);
}
function get_frst_lstname_from_user_id($cn,$usr_id){
	$query="SELECT `frst_nm`, `lst_nm` FROM `users` WHERE `usr_id`=$usr_id";
	$run= mysqli_query($cn,$query);
	return mysqli_fetch_assoc($run);
}

function login($cn,$email,$pswrd){
	$user_id=get_user_id_from_email($cn,$email);
	$query = "SELECT `usr_id`,`eml`,`pswrd` FROM `users` WHERE `eml`='$email'";
	$data=mysqli_query($cn,$query);
	$row= mysqli_fetch_assoc($data);
	$user_id=$row['usr_id'];
	
	if(($email===$row['eml'])&&($pswrd===$row['pswrd'])){
		return $user_id;		
	}else{
		return false;
	}
}

function user_data($user_id,$cn){
	$data = array();
	$user_id = (int)$user_id;
	$func_num_args = func_num_args();
	$func_get_args = func_get_args();
	if($func_num_args>0){
		unset($func_get_args[0]);
		unset($func_get_args[1]);
		
		$fields = "`".implode("`, `",$func_get_args)."`";
		$query= "SELECT $fields FROM `users` WHERE `usr_id`= $user_id ";
		$result= mysqli_query($cn,$query);
		$userdata= mysqli_fetch_assoc($result);
		
		return $userdata;
	}
	
}

function user_rule($cn,$user_id){
		$query= "SELECT `prv` FROM `users` WHERE `usr_id`= $user_id ";
		$result= mysqli_query($cn,$query);
		$userdata= mysqli_fetch_assoc($result);
	
	return $userdata['prv'];
}

function user_rule_nm($cn,$user_id){
	$user_rule=(int)user_rule($cn,$user_id);
	switch($user_rule){
		case 1:
			echo "Administrator";
			break;
		case 2:
			echo "Moderator";
			break;
		case 3:
			echo "Therapist";
			break;
		case 4:
			echo "Worker";
			break;
		case 5:
			echo "Case";
			break;
	}
}

function get_prv_from_user_catg_id($cn,$usr_catg_id){
		$query="SELECT `usr_catg_prv` FROM `user_categ` WHERE `usr_catg_id`='$usr_catg_id'";
		$result= mysqli_query($cn,$query);
		$data= mysqli_fetch_assoc($result);
		return $data['usr_catg_prv'];
}


function add_user($cn,$register_data){
	 $fields =' `'.implode('` , `', array_keys($register_data)).'`';
	 $data = ' \''.implode('\' , \'',$register_data).'\'';
	
	$query1= "INSERT INTO `users` ($fields) VALUES ($data)";
	
	mysqli_query($cn, $query1);
	
	$user_eml = $register_data['eml'];
	$user_catg_id=$register_data['usr_catg'];
	$user_catg_prv = get_prv_from_user_catg_id($cn,$user_catg_id);
	$query2 ="UPDATE `users` SET `prv`='$user_catg_prv', `actv`=1 WHERE `eml`='$user_eml'";
	mysqli_query($cn, $query2);
	
	
	$user_id= get_user_id_from_email($cn,$user_eml);
	$submitter=$register_data['submitter'];
	$submit_timestamp= $register_data['submit_timestamp'];
	if($user_catg_id== 7){
		$query3="INSERT INTO `seset` (`case_id`, `submitter`, `submit_timestamp`) VALUE ($user_id, $submitter, $submit_timestamp)";
		mysqli_query($cn, $query3);
        
        //Create cas payment account for previous month:
        $prv_month=date("Y-m",strtotime('first day of -1 month'));
        $query5="INSERT INTO `acc`  (`cas_id`, `month`) VALUES ($user_id, '$prv_month')";
        mysqli_query($cn, $query5);

        //Create cas payment account for current month:
        $cur_month=date("Y-m",time());
        $query4="INSERT INTO `acc`  (`cas_id`, `month`) VALUES ($user_id, '$cur_month')";
        mysqli_query($cn, $query4);
        
        //Create cas payment account for next month:
        $nxt_month=date("Y-m",strtotime('first day of +1 month'));
        $query4="INSERT INTO `acc`  (`cas_id`, `month`) VALUES ($user_id, '$nxt_month')";
        mysqli_query($cn, $query4);
        
        $nm=get_fullname_from_user_id($cn,$user_id);
        mail("dregpt@gmail.com, Dr.Ramykasem88@hotmail.com","New case!", "A new case (".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm'].") has been successfully added.");
	}
	
}

function get_usr_id_from_submit_timestamp($cn,$submit_timestamp){
	$submit_timestamp=(int)$submit_timestamp;
	echo $query = "SELECT `usr_id` FROM `users` WHERE `submit_timestamp`='$submit_timestamp'";
	$data=mysqli_query($cn,$query);
	$row= mysqli_fetch_assoc($data);
	//return $row['usr_id'];
}

function update_user($cn,$register_data,$usr_id){
	$fields=array_keys($register_data);
	$data=$register_data;
	
	$clumndata= join(', ', array_map(
		function ($fields, $data) { return "$fields = '$data'"; },
		$fields,
		$data
    ));
	$user_eml=$register_data['eml'];
	$submit_timestamp = $register_data['submit_timestamp'];

		$query1="UPDATE `users` SET ".$clumndata." WHERE `usr_id`=$usr_id";
		mysqli_query($cn, $query1);

	
	$user_catg_id=$register_data['usr_catg'];
	$user_catg_prv = get_prv_from_user_catg_id($cn,$user_catg_id);
	$query2 ="UPDATE `users` SET `prv`='$user_catg_prv' WHERE `usr_id`='$usr_id'";
	mysqli_query($cn, $query2);
	
	// You have to protect useres from edit !!!!!!!!!
}






//User Category functions:

function get_user_categories_opt($cn,$usr_id=0){
	$query="SELECT * FROM `prv`";
	$data=mysqli_query($cn, $query);
	while($user_categories= mysqli_fetch_assoc($data)){
		echo "<option value='".$user_categories['prv_id']."'";
		if($usr_id>0){
            $run=mysqli_query($cn,"select prv from users where usr_id=$usr_id");
            while($d=mysqli_fetch_assoc($run)) {
                if($d['prv']==$user_categories['prv_id']){echo "selected";}
            }
		}
		echo">".$user_categories['prv_nm']."</option>";
	}
}



function get_user_catg_nm_from_usr_catg_id($cn,$usr_catg_id){
		$query="SELECT `usr_catg_name` FROM `user_categ` WHERE `usr_catg_id`='$usr_catg_id'";
		$result= mysqli_query($cn,$query);
		$data= mysqli_fetch_assoc($result);
		return $data['usr_catg_name'];
}


function get_user_catg_cod_from_usr_catg_id($cn,$usr_catg_id){
		$query="SELECT `usr_catg_cod` FROM `user_categ` WHERE `usr_catg_id`='$usr_catg_id'";
		$result= mysqli_query($cn,$query);
		$data= mysqli_fetch_assoc($result);
		return $data['usr_catg_cod'];
}

function is_user_protected($cn,$usr_id){
	$query = "SELECT `usr_id` FROM `users` WHERE `usr_id`='$usr_id' AND `prtct`=1";
	$data =mysqli_query($cn,$query);
	if(mysqli_num_rows($data)===1){
		return true;
	}else{
		return false;
	}
}

function get_recent_added_users($cn){
	$query="SELECT * FROM `users`  ORDER BY `users`.`usr_id` DESC";
	$data=mysqli_query($cn, $query);
	while($recent_added_users= mysqli_fetch_assoc($data)){
		$email=$recent_added_users['eml'];
		$usr_id=get_user_id_from_email($cn,$email);
		$frst_nm=$recent_added_users['frst_nm'];
		$scnd_nm=$recent_added_users['scnd_nm']; 
		$thrd_nm=$recent_added_users['thrd_nm']; 
		$lst_nm =$recent_added_users['lst_nm'];
		$usr_catg_id= $recent_added_users['usr_catg'];
		$usr_catg_cod = get_user_catg_cod_from_usr_catg_id($cn,$usr_catg_id);
		$user_protection= is_user_protected($cn,$usr_id);
		
		echo "<div class='rightscreenrow'>
				<div class='rowusername' >".$frst_nm." ".$scnd_nm." ".$thrd_nm." ".$lst_nm."</div>
				<div class='fileid'>".$usr_catg_cod."</div>
				<div class='controller_del'><a  href=\"cont.php?delusrid=".$usr_id."\" onClick=\"return confirm('Are you sure you want to delete this user?')\">Delete</a></div>
			  </div>";
			  
		
	}
}

function get_all_users_names($cn){
	$query="SELECT * FROM `users`  ORDER BY `users`.`frst_nm` ASC";
	$data=mysqli_query($cn, $query);
	while($recent_added_users= mysqli_fetch_assoc($data)){
		$email=$recent_added_users['eml'];
		$usr_id=get_user_id_from_email($cn,$email);
		$frst_nm=$recent_added_users['frst_nm'];
		$scnd_nm=$recent_added_users['scnd_nm']; 
		$thrd_nm=$recent_added_users['thrd_nm']; 
		$lst_nm =$recent_added_users['lst_nm'];
		$usr_catg_id= $recent_added_users['usr_catg'];
		$usr_catg_cod = get_user_catg_cod_from_usr_catg_id($cn,$usr_catg_id);
		echo "<div class='rightscreenrow'>
				<div class='rowusername' >".$frst_nm." ".$scnd_nm." ".$thrd_nm." ".$lst_nm."</div>
				<div class='fileid'>".$usr_catg_cod."</div>
				<div class='controller_ed'><a  href='useredit.php?admin&useredit&usr_id=$usr_id'>Edit</a></div>
			  </div>";
			//get_user_id_from_email($cn,$email);
	}
}

//function get_all_workers_names_sal($cn){
//    $query="SELECT eml, frst_nm, scnd_nm, thrd_nm, lst_nm, usr_catg FROM `users` where prv<>5  ORDER BY `users`.`frst_nm` ASC";
//    $data=mysqli_query($cn, $query);
//    while($recent_added_users= mysqli_fetch_assoc($data)){
//        $email=$recent_added_users['eml'];
//        $usr_id=get_user_id_from_email($cn,$email);
//        $frst_nm=$recent_added_users['frst_nm'];
//        $scnd_nm=$recent_added_users['scnd_nm'];
//        $thrd_nm=$recent_added_users['thrd_nm'];
//        $lst_nm =$recent_added_users['lst_nm'];
//        $usr_catg_id= $recent_added_users['usr_catg'];
//        $usr_catg_cod = get_user_catg_cod_from_usr_catg_id($cn,$usr_catg_id);
//        echo "<div class='rightscreenrow'>
//				<div class='rowusername' >".$frst_nm." ".$scnd_nm." ".$thrd_nm." ".$lst_nm."</div>
//				<div class='fileid'>".$usr_catg_cod."</div>
//				<div class='controller_ed'><a  href='salset.php?admin&salset&usr_id=$usr_id'>Edit</a></div>
//			  </div>";
//        //get_user_id_from_email($cn,$email);
//    }
//}

function get_all_workers_names_sal($cn){
    $query="select usr_id from users where usr_id in (select usr_id from sal_set) order by frst_nm, lst_nm";
    $run=mysqli_query($cn, $query);
    while ($d=mysqli_fetch_assoc($run)){
        $user=User::find_by_id($d['usr_id']);
        $fulllongname=$user->full_long_name($d['usr_id']);
        $usr_id=$user->usr_id;
        if(user_is_active($cn,$user->eml)===true) {
        echo "<div class='rightscreenrow'>
				<div class='rowusername' >".$fulllongname."</div>
				<div class='fileid'></div>
				<div class='controller_ed'><a  href='salset.php?admin&salset&usr_id=$usr_id'>Edit</a></div>
			  </div>";
        }
    }
}

function get_case_file_id_from_user_id($cn,$user_id){
		$query="SELECT `file_id` FROM `users` WHERE `usr_id`='$user_id'";
		$result= mysqli_query($cn,$query);
		$data= mysqli_fetch_assoc($result);
		return $data['file_id'];
}

function get_recent_added_cases_list($cn){
	$query="SELECT * FROM `users`  WHERE `usr_catg`='7' ORDER BY `users`.`usr_id` DESC";
	$data=mysqli_query($cn, $query);
	while($recent_added_users= mysqli_fetch_assoc($data)){
		$email=$recent_added_users['eml'];
		$usr_id=get_user_id_from_email($cn,$email);
		$frst_nm=$recent_added_users['frst_nm'];
		$scnd_nm=$recent_added_users['scnd_nm']; 
		$thrd_nm=$recent_added_users['thrd_nm']; 
		$lst_nm =$recent_added_users['lst_nm'];
		$file_id= get_case_file_id_from_user_id($cn,$usr_id);
		$user_protection= is_user_protected($cn,$usr_id);
		
		if($user_protection===true){
			echo "<div class='rightscreenrow'>
					<div class='rowusername' >".$frst_nm." ".$scnd_nm." ".$thrd_nm." ".$lst_nm."</div>
					<div class='fileid'>".$file_id."</div>
					<div class='controller_del'>
						<a href='#'></a>
					</div>
				  </div>";
		}else{
			echo "<div class='rightscreenrow'>
					<div class='rowusername' >".$frst_nm." ".$scnd_nm." ".$thrd_nm." ".$lst_nm."</div>
					<div class='fileid'>".$file_id."</div>
					<div class='controller_del'>
						<a class='deleteicon' onClick=\"return confirm('Are you sure you want to delete this case? Warning! if you click OK, all case data including previous payments and sessions will be deleted!')\"  href='cont.php?delcaseid=".$usr_id."'>
						 <img src='img/icons/bin-2.png' class='icon' style='' title='Delete case'>
						 </a>
					</div>
				  </div>";
		}
			//get_user_id_from_email($cn,$email);
	}
}


function get_all_cases_list($cn){
	$query="SELECT * FROM `users`  WHERE `usr_catg`='7' ORDER BY `frst_nm`, `scnd_nm`, `thrd_nm`, `lst_nm` ASC";
	$data=mysqli_query($cn, $query);
	while($recent_added_users= mysqli_fetch_assoc($data)){
		$email=$recent_added_users['eml'];
		$usr_id=get_user_id_from_email($cn,$email);
		$frst_nm=$recent_added_users['frst_nm'];
		$scnd_nm=$recent_added_users['scnd_nm']; 
		$thrd_nm=$recent_added_users['thrd_nm']; 
		$lst_nm =$recent_added_users['lst_nm'];
		$file_id= get_case_file_id_from_user_id($cn,$usr_id);
		
		echo "<div class='rightscreenrow'>
				<div class='rowusername' ><a href='cont.php?edcasid=".$usr_id."'>".$frst_nm." ".$scnd_nm." ".$thrd_nm." ".$lst_nm."</a></div>
				<div class='fileid'>".$file_id."</div>
				<div class='controller_ed'><a href='cont.php?edcasid=".$usr_id."'>Edit</a></div>
			  </div>";
			//get_user_id_from_email($cn,$email);
	}
}

function get_case_data($cn,$usrid){
	$query="SELECT `frst_nm`,`scnd_nm`, `thrd_nm`, `lst_nm`, `fthr_wrk`, `mthr_nm`, `mthr_wrk`, `address`, `dob`, `eml`, `ph1`, `ph2`, `file_id`, `referral`, `dof` FROM `users` WHERE `usr_id`=$usrid";
	$data=mysqli_query($cn,$query);
	$case_data=mysqli_fetch_assoc($data);
	return $case_data;
	
    //echo "<pre>"; print_r($case_data); echo "</pre>";
}



function get_all_cases_list_op(){
	
}

function get_thrp_categories_opt($cn,$usr_id=0){
	$query="SELECT * FROM `user_categ` WHERE `usr_catg_prv`='4'";
    $data=mysqli_query($cn, $query);
    while($user_categories= mysqli_fetch_assoc($data)){
        echo "<option value='".$user_categories['usr_catg_id']."'";
        if($usr_id>0){
            $run=mysqli_query($cn,"select usr_catg from users where usr_id=$usr_id");
            while($d=mysqli_fetch_assoc($run)) {
                if($d['usr_catg']==$user_categories['usr_catg_id']){echo "selected";}
            }
        }
        echo">".$user_categories['usr_catg_name']."</option>";
    }
}



function get_recent_added_employees_list($cn){
	$query="SELECT * FROM `users` WHERE `prv`='4' or prv=2 ORDER BY `users`.`usr_id` DESC";
	$data=mysqli_query($cn, $query);
	while($recent_added_users= mysqli_fetch_assoc($data)){
		$email=$recent_added_users['eml'];
		$usr_id=get_user_id_from_email($cn,$email);
		$frst_nm=$recent_added_users['frst_nm'];
		$scnd_nm=$recent_added_users['scnd_nm']; 
		$thrd_nm=$recent_added_users['thrd_nm']; 
		$lst_nm =$recent_added_users['lst_nm'];
		$usr_catg_id= $recent_added_users['usr_catg'];
		$usr_catg_cod = get_user_catg_cod_from_usr_catg_id($cn,$usr_catg_id);
		$user_protection= is_user_protected($cn,$usr_id);
		
		if($user_protection===true){
			echo "<div class='rightscreenrow'>
					<div class='rowusername' >".$frst_nm." ".$scnd_nm." ".$thrd_nm." ".$lst_nm."</div>
					<div class='fileid'>".$usr_catg_cod."</div>
					<div class='controller_del'>
						<a href='#'></a>
					</div>
				  </div>";
		}else{
			echo "<div class='rightscreenrow'>
					<div class='rowusername' >".$frst_nm." ".$scnd_nm." ".$thrd_nm." ".$lst_nm."</div>
					<div class='fileid'>".$usr_catg_cod."</div>
					<div class='controller_del'>
						<a onClick=\"return confirm('Are you sure you want to delete this therapist?')\" href='cont.php?delthrpid=".$usr_id."'>Delete</a>
					</div>
				  </div>";
		}
			//get_user_id_from_email($cn,$email);
	}
}

function get_all_employees_list($cn){
	$query="SELECT * FROM `users` WHERE `prv`=4 or prv=2 or prv=1 ORDER BY `users`.`frst_nm` ASC";
	$data=mysqli_query($cn, $query);
	while($recent_added_users= mysqli_fetch_assoc($data)){
		$email=$recent_added_users['eml'];
		$usr_id=get_user_id_from_email($cn,$email);
		$frst_nm=$recent_added_users['frst_nm'];
		$scnd_nm=$recent_added_users['scnd_nm']; 
		$thrd_nm=$recent_added_users['thrd_nm']; 
		$lst_nm =$recent_added_users['lst_nm'];
		$usr_catg_id= $recent_added_users['usr_catg'];
		$usr_catg_cod = get_user_catg_cod_from_usr_catg_id($cn,$usr_catg_id);
		$user_protection= is_user_protected($cn,$usr_id);
			echo "
			<div class='rightscreenrow'>
					<div class='rowusername' ><a href='thrpedit.php?thrpedit&thrped&usr_id=".$usr_id."'>".$frst_nm." ".$scnd_nm." ".$thrd_nm." ".$lst_nm."</a></div>
					<div class='fileid'>".$usr_catg_cod."</div>
					<div class='controller_ed'>
						<a href='thrpedit.php?thrpedit&thrped&usr_id=".$usr_id."'>Edit</a>
					</div>
				  </div>";
			//echo get_user_id_from_email($cn,$email);
	}
}

function month_therapists_list($cn,$month){
    $query="SELECT * FROM `users` WHERE (`prv`=4 or `prv`=1 or `prv`=2)";
    $query.=" and usr_id in (select thrp_id from ses where substring(ses_day,1,7)='$month') ";
    $query.="ORDER BY `users`.`frst_nm` ASC";
   // echo $query;
    $data=mysqli_query($cn, $query);
    while($recent_added_users= mysqli_fetch_assoc($data)){
        $email=$recent_added_users['eml'];
        $usr_id=get_user_id_from_email($cn,$email);
        $frst_nm=$recent_added_users['frst_nm'];
        $scnd_nm=$recent_added_users['scnd_nm'];
        $thrd_nm=$recent_added_users['thrd_nm'];
        $lst_nm =$recent_added_users['lst_nm'];
        $usr_catg_id= $recent_added_users['usr_catg'];
        $usr_catg_cod = get_user_catg_cod_from_usr_catg_id($cn,$usr_catg_id);
        $user_protection= is_user_protected($cn,$usr_id);
        echo "
			<div class='rightscreenrow'>
					<div class='rowusername' ><a href='ther_sessions.php?thrpedit&ther_sessions&month=".$month."&usr_id=".$usr_id."'>".$frst_nm." ".$scnd_nm." ".$thrd_nm." ".$lst_nm."</a></div>
					<div class='fileid'>".$usr_catg_cod."</div>
					<div class='controller_ed'>
						<a href='ther_sessions.php?thrpedit&ther_sessions&month=".$month."&usr_id=".$usr_id."'>Edit</a>
					</div>
				  </div>";

    }
}



function get_thrp_data($cn,$usrid){
	echo $query="SELECT `frst_nm`,`scnd_nm`, `thrd_nm`, `lst_nm`, `address`, `dob`, `eml`, `ph1`, `ph2`, `usr_catg` FROM `users` WHERE `usr_id`=$usrid";
	$data=mysqli_query($cn,$query);
	$thrp_data=mysqli_fetch_assoc($data);
	return $thrp_data;
	
   // echo "<pre>"; print_r($thrp_data); echo "</pre>";
}


function delete_user($cn,$usr_id,$user_data){


        $nm=get_fullname_from_user_id($cn,$usr_id);
        $snm=get_fullname_from_user_id($cn,$user_data['usr_id']);
        mail("dregpt@gmail.com, Dr.Ramykasem88@hotmail.com","A user is deleted!", "The user (".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm'].") is deleted by ".$snm['frst_nm']." ".$snm['lst_nm'].".");
    $query ="DELETE FROM `users` WHERE `users`.`usr_id` = $usr_id";
    mysqli_query($cn,$query);
}

function delete_case($cn,$usr_id){
    
        $nm=get_fullname_from_user_id($cn,$usr_id);
        mail("dregpt@gmail.com, Dr.Ramykasem88@hotmail.com","A case is deleted!", "The case (".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm'].") <br>is deleted.");
    
    //To delete all case profile data:
	$query ="DELETE FROM `users` WHERE `users`.`usr_id` = $usr_id";
	mysqli_query($cn,$query);
	
    //To delete all case session setting:
	$query ="DELETE FROM `seset` WHERE `seset`.`case_id` = $usr_id";
	mysqli_query($cn,$query);
    
    // To delete all recorded sessions for this case:
	$query ="DELETE FROM `ses` WHERE `ses`.`cas_id` = $usr_id";  
	mysqli_query($cn,$query);
    
    // To delete payment account for this case:
	$query6 ="DELETE FROM `acc` WHERE `acc`.`cas_id` = $usr_id";
	mysqli_query($cn,$query6);
    

}


function get_prv_opt($cn){
	$query="SELECT * FROM `prv`";
	$data=mysqli_query($cn, $query);
	while($prv= mysqli_fetch_assoc($data)){
		echo "<option value='".$prv['prv_id']."'>".$prv['prv_nm']."</option>";
	}
}


function get_usr_prv_cd_from_usr_catg_id($cn,$usr_catg_id){ // to Get privilege code from user category ID:
	// 1- Get privilege ID from user category table according to user category ID:
	$query="SELECT `usr_catg_prv` FROM `user_categ` WHERE `usr_catg_id`='$usr_catg_id'";
	$data=mysqli_query($cn, $query);
	$result=mysqli_fetch_assoc($data);
	$prv_id=$result['usr_catg_prv'];
	// 2- Get privilege code from privileges table according to privilege ID:
	$query="SELECT `prv_cd` FROM `prv` WHERE `prv_id`='$prv_id'";
	$data=mysqli_query($cn, $query);
	$result=mysqli_fetch_assoc($data);
	return $result['prv_cd'];
}

function get_default_user_categories($cn){
	$query="SELECT * FROM `user_categ`	WHERE `def`='1'";
	$data=mysqli_query($cn, $query);
	while($user_catg= mysqli_fetch_assoc($data)){
		$user_catg_nm= $user_catg['usr_catg_name'];
		$user_catg_id= $user_catg['usr_catg_id'];
		$user_prv_cd= get_usr_prv_cd_from_usr_catg_id($cn,$user_catg['usr_catg_id']);
		echo "<div class='rightscreenrow'>
				<div class='rowusername' >".$user_catg_nm."</div>
				<div class='fileid'>".$user_prv_cd."</div>
				<div class='controller_del'><a href='#'></a></div>
			  </div>";
	}
}


function get_all_user_categories($cn){
	$query="SELECT * FROM `user_categ`	WHERE `def`='0'";
	$data=mysqli_query($cn, $query);
	while($user_catg= mysqli_fetch_assoc($data)){
		$user_catg_nm= $user_catg['usr_catg_name'];
		$user_catg_prv= $user_catg['usr_catg_cod'];
		$user_catg_id= $user_catg['usr_catg_id'];
		$user_prv_cd= get_usr_prv_cd_from_usr_catg_id($cn,$user_catg['usr_catg_id']);
		echo "<div class='rightscreenrow'>
				<div class='rowusername' >".$user_catg_nm."</div>
				<div class='fileid'>".$user_prv_cd."</div>
				<div class='controller_del'><a href='cont.php?delusercatgid=".$user_catg_id."'>Delete</a></div>
			  </div>";
	}
}

function category_is_found($cn,$usr_catg_name){
	$query = "SELECT `usr_catg_id` FROM `user_categ` WHERE `usr_catg_name`='$usr_catg_name' ";
	$data =mysqli_query($cn,$query);
	if(mysqli_num_rows($data)===1){
		return true;
	}else{
		return false;
	}

}


function category_cd_is_found($cn,$usr_catg_cod){
	$query = "SELECT `usr_catg_id` FROM `user_categ` WHERE `usr_catg_cod`='$usr_catg_cod' ";
	$data =mysqli_query($cn,$query);
	if(mysqli_num_rows($data)===1){
		return true;
	}else{
		return false;
	}
	
}


function add_user_category($cn,$register_data){
	 $fields =' `'.implode('` , `', array_keys($register_data)).'`';
	 $data = ' \''.implode('\' , \'',$register_data).'\'';
	
	$query1= "INSERT INTO `user_categ` ($fields) VALUES ($data)";
	
	//return $query1;
	mysqli_query($cn, $query1);
}

function delete_user_catg($cn,$usr_catg_id){
	$query ="DELETE FROM `user_categ` WHERE `usr_catg_id` = '$usr_catg_id'";
	mysqli_query($cn,$query);
}



//Sidebar widgets functions:

function number_of_users($cn){
	$query = "SELECT * FROM `users`";
	$data =mysqli_query($cn,$query);
	echo mysqli_num_rows($data);
}



function number_of_cases($cn){
	$query = "SELECT * FROM `users`	 WHERE `usr_catg`='7'";
	$data =mysqli_query($cn,$query);
	echo mysqli_num_rows($data);
}

function number_of_therpists($cn){
	$query = "SELECT * FROM `users`	 WHERE `prv`='3'";
	$data =mysqli_query($cn,$query);
	echo mysqli_num_rows($data);
}

//General functions:

function output_messages($messages){
	if(empty($messages)===false){
	return	 '<ul><li>'.implode('</li><li>',$messages).'</li></u>';
	}
}

function messages($messages){
	if(empty (output_messages($messages)) ===false){
		return "<div class='message'>".output_messages($messages)."</div>";
	}	
}



function regular_record_notation($regular_record_notes){
    return	 '<ul><li class="yellow_note" >'.implode('</li><li class="yellow_note" >',$regular_record_notes).'</li></u>';

}

//print_r(login($cn,'user1@gmail.com'));


//Strin function

// to capitalize first letter of a string: ucfirst($foo)


function users_list_opt($cn,$prv){
	$query="SELECT * FROM `users` WHERE `prv`=$prv ORDER BY `usr_id` desc ";
	$data=mysqli_query($cn, $query);
	while($user_data= mysqli_fetch_assoc($data)){
		echo "<option value='".$user_data['usr_id']."'>Dr. ".$user_data['frst_nm']." ".$user_data['lst_nm']."</option>";
	}
}


function activate_tabe($page,$tabeclass){
    if(isset($page)===true){
        return $tabeclass;
    }
    
}


function user_is_admin($cn,$user_id){
    $query="SELECT `prv` FROM `users` WHERE `usr_id`=$user_id";
    $run1=mysqli_query($cn, $query);
    while($res=mysqli_fetch_assoc($run1)){
       $prv= $res['prv'];
        if($prv==1){
            return  true;
        }else{return false;}
    }
}


function allowed_prv($cn,$user_id,$prv_args=[]){
//    1/*admins*/ ,2/*Mods*/ ,3/*Sec*/ ,4/*Therapists*/ ,5/*Cases*/ ,6/*Workers*/
    foreach ($prv_args as $key => $value) {
        $query = "SELECT `prv` FROM `users` WHERE `usr_id`=$user_id";
        $run1 = mysqli_query($cn, $query);
        $res = mysqli_fetch_assoc($run1);
            $prv = $res['prv'];
            if ($prv == $value) {
                return true;
            }else{
                return false;
            }
    }
}






function add_rebooking_limit($cn, $register_data){
	 $fields =' `'.implode('` , `', array_keys($register_data)).'`';
	 $data = ' \''.implode('\' , \'',$register_data).'\'';
	
	$query1= "INSERT INTO `exc_limit` ($fields) VALUES ($data)";
	
	//return $query1;
	mysqli_query($cn, $query1);
}


function shw_rebooking_limits($cn){
    
    $query="select * from exc_limit order by frm";
    $run=mysqli_query($cn,$query);
    while($d=mysqli_fetch_assoc($run)){
        $frm=$d['frm'];
        $t=$d['t'];
        $rebook_limit=$d['rebook_limit'];
        echo"
            <div class='smalldatalistr'>
                <div class='smalldatalistd'>".$frm."</div>
                <div class='smalldatalistd'>".$t."</div>
                <div class='smalldatalistd'>".$rebook_limit."</div>
                <div class='smalldatalistd'><a class='deleteicon' onClick=\'return confirm('Are you sure you want to delete this rebooking limit?')\' href='cont.php?delete_exclimit=".$d['limit_id']."' ><img src='img/icons/bin-2.png' class='icon' style='' title='Delete limit'></a></div>
            </div>
                                            
            ";
    }
                                            
}


function delete_rebooking_limit($cn,$limit_id){
    mysqli_query($cn,"delete from exc_limit where limit_id=$limit_id");
}




function is_case_is_active_lat_months($cn,$cas_id, $num_months){
    $query="select cas_id,ses_day from ses where cas_id=$cas_id";
    $run=mysqli_query($cn,$query);
    $y=0;
    while($d=mysqli_fetch_assoc($run)){
            $x=0;
            while($x<=$num_months){
                
                $ses_month=date("Y-m",strtotime($d['ses_day']));
                $month=date("Y-m",strtotime("-".$x." month",time()));
                if($ses_month===$month){
                  //  echo"<br>".$d['cas_id'];
                   // echo"<br>".$ses_month;
                    $y++;
                }
                $x++;
            }
        }
    if($y>0){
       // echo "true";
        return true;
    }else{
       // echo "false";
        return false;
    }
}


function number_of_active_cases_in_month($cn,$num_month){
    $month=date("Y-m",strtotime("first day of ".$num_month." month"));
    $query="SELECT COUNT(DISTINCT cas_id) FROM `ses` WHERE SUBSTR(ses_day,1,7)='$month'";
    $run=mysqli_query($cn, $query);
    while($d=mysqli_fetch_array($run)){
        return $d[0];
    }
}



function is_case_booked_a_month($cn,$cas_id,$month){
    $query="SELECT COUNT(DISTINCT cas_id) FROM `ses` WHERE SUBSTR(ses_day,1,7)='$month' and cas_id=$cas_id";
    $run=mysqli_query($cn, $query);
    while($d=mysqli_fetch_array($run)){
        if($d[0]==1){
           return true;
        }elseif($d[0]==0){
            return false;
        }
    }
}







function setting_status($cn,$set_id,$property){
    $query="select $property from sets where set_id=$set_id";
    $run=mysqli_query($cn,$query);
    while($d=mysqli_fetch_assoc($run)){
       return $d[$property];
    }
}



function set_setting($cn,$set_id,$register_data){
	$fields=array_keys($register_data);
	$data=$register_data;
	
	$clumndata= join(', ', array_map(
		function ($fields, $data) { return "$fields = '$data'"; },
		$fields,
		$data
    ));
	$submit_timestamp = $register_data['submit_timestamp'];

		$query1="UPDATE `sets` SET ".$clumndata." where set_id= $set_id";
		mysqli_query($cn, $query1);
}



function num_month_cases($cn,$month){
    $run=mysqli_query($cn,"select count(distinct usr_id) from users where usr_catg=7 and from_unixtime(dof,'%Y-%m')='$month'");
    while($d=mysqli_fetch_array($run)){
        return $d[0];
    }
}



// notification functions

function get_emails_inarray($cn, $user_categ){ // to get emails of certain user category in array
    $run=mysqli_query($cn, "select eml from users where usr_catg=$user_categ");
    $x=0;
    $emls=array();
    while($d=mysqli_fetch_assoc($run)){
      $emls[$x]= $d['eml'];
      $x++;
    }
    return $emls;
}


function month_total_outlays($args=[], $month){
    foreach ($args as $key=>$value){
       $outlay_month=$args[$key]->month;
       if($outlay_month===$month){
           $results[]=$args[$key]->amount;
       }
    }
    if(!empty($results)) {
        return array_sum($results);
    }else{
        return 0;
    }
}

function month_total_incomes($args=[], $month){
    foreach ($args as $key=>$value){
        $outlay_month=$args[$key]->month;
        if($outlay_month===$month){
            $results[]=$args[$key]->amount;
        }
    }
    if(!empty($results)) {
        return array_sum($results);
    }else{
        return 0;
    }
}




function fill_sal($cn){
    $query1="select usr_id from users where prv<>5";
    $run=mysqli_query($cn, $query1);
    while ($d=mysqli_fetch_assoc($run)){
                $query3="insert into sal_set (usr_id) values (".$d['usr_id'].")";
                mysqli_query($cn,$query3);
    }
}


function rat_catg_table(){
    $query="select * from rat_categ order by rat_nm";
  $obj_array=RateCatg::find_by_sql($query);

  echo"  <table style='padding-top: 5px;'>
                            <caption></caption>
                            <thead class='ratcatgthead'>
                            <tr>
                                <th>Rate name</th>
                                <th>Code</th>
                                <th>Rate</th>
                                <th colspan='5'>Details</th>
                            </tr>
                            </thead>
                            <tbody class='ratcatgtbody'>
                            ";


  foreach($obj_array as $key=>$property){
 $rat_id=$property->rat_id;

        echo"<tr>
                <th >{$property->rat_nm}</th>
                <td class='data'>{$property->rat_cd}</td>
                <td class='data'>{$property->rat}</td>
                <td class='datalt'>{$property->detail} </td>
                <td class='data'><a href='ratcatgedit.php?rat_id={$rat_id}' ><img src='img/icons/edite-1.png' class='iconwhite' title='Edit'></a></td>
                <td class='data'><a onclick=\"return confirm('Are you sure you want to delete this category?')\" href='cont.php?ratcatgdelete=".$rat_id."' ><img src='img/icons/bin-2.png' class='iconwhite' title='Delete'></a></td>
            </tr>";

  }

  echo"</tbody>
            </table>";
}


function triggers_table(){
    $query="select * from trig order by trig_nm";
    $obj_array=Trigger::find_by_sql($query);

    echo"  <table style='padding-top: 5px;'>
                            <caption></caption>
                            <thead class='ratcatgthead'>
                            <tr>
                                <th>Trigger name</th>
                                <th>Details</th>
                                <th colspan=''>Reset every</th>
                                <th colspan='10'></th>
                            </tr>
                            </thead>
                            <tbody class='ratcatgtbody'>
                            ";
    foreach($obj_array as $key=>$property){
        $trig_id=$property->trig_id;
        $trig_reset=ucwords($property->trig_reset);
        echo"<tr>
                <th >{$property->trig_nm}</th>
                <td class='datalt'>{$property->detail}</td>
                <td class='data'>{$trig_reset} </td>
                <td class='data'><a href='triggeredit.php?admin&triggeradd&trig_id={$trig_id}' ><img src='img/icons/edite-1.png' class='iconwhite' title='Edit'></a></td>
                <td class='data'><a onclick=\"return confirm('Are you sure you want to delete this trigger?')\" href='cont.php?trigdelete=".$trig_id."' ><img src='img/icons/bin-2.png' class='iconwhite' title='Delete'></a></td>
            </tr>";

    }

    echo"</tbody>
            </table>";
}

function behaviors_table(){
    $sql="select * from behaviors order by behav_nm asc";
    $obj_array=Behavior::find_by_sql($sql);

    echo"  <table style='padding-top: 5px;'>
                            <caption></caption>
                            <thead class='ratcatgthead'>
                            <tr>
                                <th>Behavior name</th>
                                <th>Details</th>
                                <th colspan='4'></th>
                            </tr>
                            </thead>
                            <tbody class='ratcatgtbody'>
                            ";
    foreach($obj_array as $key=>$property){
        $behav_id=$property->behav_id;
        echo"<tr>
                <th >{$property->behav_nm}</th>
                <td class='datalt'>{$property->detail}</td>
                <td class='data'><a href='behavioredit.php?admin&behavioradd&behav_id={$behav_id}' ><img src='img/icons/edite-1.png' class='iconwhite' title='Edit'></a></td>
                <td class='data'><a onclick=\"return confirm('Are you sure you want to delete this behavior?')\" href='cont.php?behavdelete=".$behav_id."' ><img src='img/icons/bin-2.png' class='iconwhite' title='Delete'></a></td>
            </tr>";

    }

    echo"</tbody>
            </table>";
}



function triggers_options(){
    echo"<div class='smalldatalistHr1col'>
           <div class='smalldatalistHd'>Triggers</div>
          </div>
";
    $sql="select * from trig order by trig_nm asc";
    $trigger_objects=Trigger::find_by_sql($sql);
    foreach($trigger_objects as $property){
        echo"
            <div class='smalldatalistr1col'>
                <div class='smalldatalistd' title='{$property->detail}'>
                    <input type='checkbox' name='data[trigs".$property->trig_id."]' value='{$property->trig_id}'> {$property->trig_nm}
                </div>
            </div>
            ";
    }

}


function triggers_rec_options($args=[]){
    echo"<div class='smalldatalistHr1col'>
           <div class='smalldatalistHd'>Triggers</div>
          </div>
";

    $trigger_objects=Trigger::find_all();
    foreach($trigger_objects as $property){
        $trig_id=$property->trig_id;
        echo"
            <div class='smalldatalistr1col'>
                <div class='smalldatalistd' title='{$property->detail}'>
                    <input type='checkbox' name='data[trigs".$property->trig_id."]' value='{$property->trig_id}'";
        foreach ($args as $key=>$vall){
            if($vall==$trig_id){echo" checked ";}
        }
            echo"> {$property->trig_nm}
        
                </div>
            </div>
            ";
    }

}




















?>