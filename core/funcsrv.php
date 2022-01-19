<?php

//Service functions

function service_is_found($cn,$srv_nm){
	$query = "SELECT `srv_nm` FROM `services` WHERE `srv_nm`='$srv_nm' ";

	$data =mysqli_query($cn,$query);
	if(mysqli_num_rows($data)===1){
		return true;
	}else{
		return false;
	}
}


function service_cd_is_found($cn,$srv_cd){
	$query = "SELECT `srv_nm` FROM `services` WHERE `srv_cd`='$srv_cd' ";
	$data =mysqli_query($cn,$query);
	if(mysqli_num_rows($data)===1){
		return true;
	}else{
		return false;
	}
}

function get_srv_id_frm_srv_cd($cn,$srv_cd){
	$query="SELECT `srv_id` FROM `services` WHERE `srv_cd`='$srv_cd'";
	$data=mysqli_query($cn, $query);
	$result=mysqli_fetch_assoc($data);
	return $result['srv_id'];
}

function add_service($cn,$register_data){
	 $fields =' `'.implode('` , `', array_keys($register_data)).'`';
	 $data = ' \''.implode('\' , \'',$register_data).'\'';
	
	$query1= "INSERT INTO `services` ($fields) VALUES ($data)";
	//echo $query1;
	mysqli_query($cn, $query1);
 
	$srv_cd=$register_data['srv_cd'];
	$srv_sngl_price=(int)$register_data['srv_sngl_price'];
	$srv_rglr_price=(int)$register_data['srv_rglr_price'];
	$srv_id=get_srv_id_frm_srv_cd($cn,$srv_cd);
	
	$query2="
	ALTER TABLE seset
		ADD COLUMN `".$srv_cd."_sngl_price` INT(5) NOT NULL DEFAULT ".$srv_sngl_price.",
		ADD COLUMN `".$srv_cd."_rglr_price` INT(5) NOT NULL DEFAULT ".$srv_rglr_price."  AFTER `".$srv_cd."_sngl_price`,
		ADD COLUMN `$srv_cd` INT(5) NOT NULL DEFAULT 0 AFTER `".$srv_cd."_rglr_price`,
		ADD COLUMN `".$srv_cd."_tm_Sat` VARCHAR(15) NULL AFTER `".$srv_cd."`,
		ADD COLUMN `".$srv_cd."_tm_Sun` VARCHAR(15) NULL AFTER `".$srv_cd."_tm_Sat`,
		ADD COLUMN `".$srv_cd."_tm_Mon` VARCHAR(15) NULL AFTER `".$srv_cd."_tm_Sun`,
		ADD COLUMN `".$srv_cd."_tm_Tue` VARCHAR(15) NULL AFTER `".$srv_cd."_tm_Mon`,
		ADD COLUMN `".$srv_cd."_tm_Wed` VARCHAR(15) NULL AFTER `".$srv_cd."_tm_Tue`,
		ADD COLUMN `".$srv_cd."_tm_Thu` VARCHAR(15) NULL AFTER `".$srv_cd."_tm_Wed`,
		ADD COLUMN `".$srv_cd."_tm_Fri` VARCHAR(15) NULL AFTER `".$srv_cd."_tm_Thu`;
	";
	
	mysqli_query($cn, $query2);
	//echo $query2."<br><br><br>"; 
}

function delete_srv($cn,$srv_id){

	$srv_cd= get_srv_cd_from_srv_id($cn,$srv_id);

	$query3="
	ALTER TABLE seset
		DROP `$srv_cd`,
		DROP `".$srv_cd."_sngl_price`,
		DROP `".$srv_cd."_rglr_price`,
		DROP `".$srv_cd."_tm_Sat`,
		DROP `".$srv_cd."_tm_Sun`,
		DROP `".$srv_cd."_tm_Mon`,
		DROP `".$srv_cd."_tm_Tue`,
		DROP `".$srv_cd."_tm_Wed`,
		DROP `".$srv_cd."_tm_Thu`,
		DROP `".$srv_cd."_tm_Fri`;	
	";
	mysqli_query($cn,$query3);
	
	echo $query3;
	$query1 ="DELETE FROM `services` WHERE `srv_id` = '$srv_id'";
	mysqli_query($cn,$query1);

}

function get_srv_cd_from_srv_id($cn,$srv_id){
	$query="SELECT `srv_cd` FROM `services` WHERE `srv_id`='$srv_id'";
	$data=mysqli_query($cn, $query);
	$result=mysqli_fetch_assoc($data);
	
	return $result['srv_cd'];
}

function get_all_srv_list($cn){
	$query="SELECT * FROM `services` ORDER BY `srv_ordr`";
	$data=mysqli_query($cn, $query);
	while($srv= mysqli_fetch_assoc($data)){
		$srv_nm= $srv['srv_nm'];
		$srv_id= $srv['srv_id'];
		$srv_hr= $srv['srv_hr'];
		$srv_ordr=$srv['srv_ordr'];
		$srv_cd= get_srv_cd_from_srv_id($cn,$srv['srv_id']);
		echo "<div class='rightscreenrow4col'>
				<div class='rowusername' >".$srv_nm." (".$srv_cd.") </div>
				<div class='fileid'>".$srv_hr." m.</div>
				<div class='fileid'>".$srv_ordr."</div>
				<div class='controller_del'>";
		//echo"<a href='cont.php?delsrvid=".$srv_id."'>Delete</a>";
		echo"</div>
			  </div>";
	}
}




// Seset functions
 function all_case_setting($cn){
	$query="SELECT * FROM `users`  WHERE `usr_catg`='7' ORDER BY `users`.`frst_nm` ASC";
	$data=mysqli_query($cn, $query);
	while($recent_added_users= mysqli_fetch_assoc($data)){
		$email=$recent_added_users['eml'];
		$usr_id=get_user_id_from_email($cn,$email);
		$frst_nm=$recent_added_users['frst_nm'];
		$scnd_nm=$recent_added_users['scnd_nm']; 
		$thrd_nm=$recent_added_users['thrd_nm']; 
		$lst_nm =$recent_added_users['lst_nm'];
		$file_id= get_case_file_id_from_user_id($cn,$usr_id);
        $month=date("Y-m",strtotime("first day of +1 month",time()));
		$bookstat=is_case_booked_a_month($cn,$usr_id,$month);
		echo "<div class='rightscreenrow'>
				<div class='rowusername' ><a href='cont.php?caset=".$usr_id."'>".$frst_nm." ".$scnd_nm." ".$thrd_nm." ".$lst_nm."</a></div>
				<div class='controller_ed'><a href='cont.php?caset=".$usr_id."'>";
        if($bookstat===true){
            echo"Booked";
        }
           echo  "</a></div>
			  </div>";
			//get_user_id_from_email($cn,$email);
		
		$_SESSION['caset'.$usr_id] = $usr_id;
		$_SESSION['frst_nm'.$usr_id] = $frst_nm;
	}
 }

 function all_case_price_setting($cn){
	$query="SELECT * FROM `users`  WHERE `usr_catg`='7' ORDER BY `users`.`frst_nm` ASC";
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
				<div class='rowusername' ><a href='casprice.php?caseedit&casprice&casid=".$usr_id."'>".$frst_nm." ".$scnd_nm." ".$thrd_nm." ".$lst_nm."</a></div>
				<div class='fileid'>".$file_id."</div>
				<div class='controller_ed'><a href='#.php?caset=".$usr_id."'></a></div>
			  </div>";
			//get_user_id_from_email($cn,$email);
		
		$_SESSION['caset'.$usr_id] = $usr_id;
		$_SESSION['frst_nm'.$usr_id] = $frst_nm;
	}
 }

function get_times_op($cn){
	$query="SELECT * FROM `times` ORDER BY `tm_id` ASC";
	$run= mysqli_query($cn, $query);
	
	
	while($times = mysqli_fetch_assoc($run)){
		$value=$times['tm_val'];
		$label=$times['tm_lbl'];
		
		$tm_op=array();
		
		echo"<option value='".$value."'>
				$label
			</option>";
	}
	
}
function seset_data($cn,$sesetcol){
	
	unset($sesetcol['seset_id']);
	unset($sesetcol['case_id']);
	unset($sesetcol['submitter']);
	unset($sesetcol['submit_timestamp']);
	//echo count($sesetcol);
	$fields = array_keys($sesetcol);
	$data = array_values($sesetcol) ;
	//echo "<pre>"; print_r($data); echo"</pre>";
	//echo "<pre>"; print_r($fields); echo"</pre>";
	//echo $srv_count = count($fields);
	
	$srvs = array_chunk($data,10);
	//echo "<pre>"; print_r($srvs); echo"</pre>";
	$key=0;
	//echo  $srvs[$key][0]."<br>";
		

	$query="SELECT `srv_cd` FROM `services` ORDER BY `srv_ordr` ASC";
	$run=mysqli_query($cn,$query);
	while($srv=mysqli_fetch_assoc($run)){
		$srv_cd=$srv['srv_cd'];	
		
		/*echo "
				<tr>
					<td><input type='hidden' id='service' name='".$srv_cd."' value='".$srvs[$key][2]."'>".$srv_cd.":</td>
					<td><input type='time' id='tm_Sun'  class='".$srv_cd."_tm_Sat'  name='".$srv_cd."_tm_Sat' value='".date("H:i",strtotime($srvs[$key][3]))."'> </td>
					<td><input type='time' id='tm_Sun'  class='".$srv_cd."_tm_Sun'  name='".$srv_cd."_tm_Sun' value='".date("H:i",strtotime($srvs[$key][4]))."'> </td>
					<td><input type='time' id='tm_Mon'  class='".$srv_cd."_tm_Mon'  name='".$srv_cd."_tm_Mon' value='".date("H:i",strtotime($srvs[$key][5]))."'> </td>
					<td><input type='time' id='tm_Tue'  class='".$srv_cd."_tm_Tue'  name='".$srv_cd."_tm_Tue' value='".date("H:i",strtotime($srvs[$key][6]))."'> </td>
					<td><input type='time' id='tm_Wed'  class='".$srv_cd."_tm_Wed'  name='".$srv_cd."_tm_Wed' value='".date("H:i",strtotime($srvs[$key][7]))."'> </td>
					<td><input type='time' id='tm_Thu'  class='".$srv_cd."_tm_Thu'  name='".$srv_cd."_tm_Thu' value='".date("H:i",strtotime($srvs[$key][8]))."'> </td>
					<td><input type='time' id='tm_Fri'  class='".$srv_cd."_tm_Fri'  name='".$srv_cd."_tm_Fri' value='".date("H:i",strtotime($srvs[$key][9]))."'> </td>
				</tr>
			";
            */
        echo "
				<tr>
					<td><input type='hidden' id='service' name='".$srv_cd."' value='".$srvs[$key][2]."'>".$srv_cd.":</td>
					<td><input type='time' id='tm_Sun'  class='".$srv_cd."_tm_Sat'  name='".$srv_cd."_tm_Sat' value=''> </td>
					<td><input type='time' id='tm_Sun'  class='".$srv_cd."_tm_Sun'  name='".$srv_cd."_tm_Sun' value=''> </td>
					<td><input type='time' id='tm_Mon'  class='".$srv_cd."_tm_Mon'  name='".$srv_cd."_tm_Mon' value=''> </td>
					<td><input type='time' id='tm_Tue'  class='".$srv_cd."_tm_Tue'  name='".$srv_cd."_tm_Tue' value=''> </td>
					<td><input type='time' id='tm_Wed'  class='".$srv_cd."_tm_Wed'  name='".$srv_cd."_tm_Wed' value=''> </td>
					<td><input type='time' id='tm_Thu'  class='".$srv_cd."_tm_Thu'  name='".$srv_cd."_tm_Thu' value=''> </td>
					<td><input type='time' id='tm_Fri'  class='".$srv_cd."_tm_Fri'  name='".$srv_cd."_tm_Fri' value=''> </td>
				</tr>
			";
		$key++;
	}
}


function seset_form($cn){
	$query="SELECT `srv_cd` FROM `services` ORDER BY `srv_ordr` ASC";
	$run=mysqli_query($cn,$query);
	while($srv=mysqli_fetch_assoc($run)){
		$srv_cd=$srv['srv_cd']; 
		echo "
				<tr>
					<td><input type='hidden' name='".$srv_cd."'>".$srv_cd.":</td>
					<td><input type='time' id='".$srv_cd."_tm_Sat'  class='".$srv_cd."_tm_Sat'  name='".$srv_cd."_tm_Sat'></td>
					<td><input type='time' id='".$srv_cd."_tm_Sun'  class='".$srv_cd."_tm_Sun'  name='".$srv_cd."_tm_Sun'></td>
					<td><input type='time' id='".$srv_cd."_tm_Mon'  class='".$srv_cd."_tm_Mon'  name='".$srv_cd."_tm_Mon'></td>
					<td><input type='time' id='".$srv_cd."_tm_Tue'  class='".$srv_cd."_tm_Tue'  name='".$srv_cd."_tm_Tue'></td>
					<td><input type='time' id='".$srv_cd."_tm_Wed'  class='".$srv_cd."_tm_Wed'  name='".$srv_cd."_tm_Wed'></td>
					<td><input type='time' id='".$srv_cd."_tm_Thu'  class='".$srv_cd."_tm_Thu'  name='".$srv_cd."_tm_Thu'></td>
					<td><input type='time' id='".$srv_cd."_tm_Fri'  class='".$srv_cd."_tm_Fri'  name='".$srv_cd."_tm_Fri'></td>
				</tr>
			";
	}
}

function seprice_form($cn,$casid){
	$query="SELECT `srv_nm`,`srv_cd` FROM `services` ORDER BY `srv_ordr` ASC";
	$run=mysqli_query($cn,$query);
	while($srv=mysqli_fetch_assoc($run)){
        $srv_cd=$srv['srv_cd']; 
        $srv_nm=$srv['srv_nm'];
        
        
        
        $query2="SELECT `".$srv_cd."_rglr_price`, `".$srv_cd."_sngl_price` FROM `seset` WHERE `case_id`=$casid";
        $run2=mysqli_query($cn, $query2);
        while($pr=mysqli_fetch_assoc($run2)) {
               $rg_p_val=$pr[$srv_cd.'_rglr_price'];
               $sng_p_val=$pr[$srv_cd.'_sngl_price'];
                echo "
                        <tr>
                            <td><input type='hidden'>".$srv_nm." (".$srv_cd."):</td>
                            <td><input type='number' id='".$srv_cd."_rglr_price'  class='txtboxnum'  name='".$srv_cd."_rglr_price' value='".$rg_p_val."'></td>
                            <td><input type='number' id='".$srv_cd."_sngl_price'  class='txtboxnum'  name='".$srv_cd."_sngl_price' value='".$sng_p_val."'></td>
                        </tr>
                    ";
        }       
	}
}



function get_srv_cd_from_col($col){
	substr($col,5);
}


function case_ses_is_set($cn, $case_id){
	 
	$query="SELECT `ses_day` FROM `ses` WHERE `cas_id`= $case_id ";
	$run=mysqli_query($cn,$query);
    
	while($sessions = mysqli_fetch_assoc($run)){
        $sessions['ses_day'];
        $ses_mnth=date("Y-m", strtotime($sessions['ses_day']));
        $nxtmon=date("Y-m",strtotime("first day of +1 month"));
		
		
		if($nxtmon===$ses_mnth){
            //echo "Ok";
			return true;
			break;
		}else{

		}
        
	}
    
}

function delete_fake_ses($cn,$cas_id){
    $query="SELECT `ses_rf_tm` FROM `ses` WHERE `cas_id`=$cas_id";
    $run=mysqli_query($cn,$query);
    while($d=mysqli_fetch_assoc($run)){
        
       $sestm=date("h A",strtotime($d['ses_rf_tm']));
        
        if($sestm==="02 AM"){ 
          $deltm = "02:00";
            
            $query2="DELETE FROM `ses` WHERE `cas_id`=$cas_id AND `ses_rf_tm`='$deltm' ";
           mysqli_query($cn,$query2);
        }
        
    }
}

function cas_service_price($cn,$srv_cd,$case_id){
    $query="select ".$srv_cd."_rglr_price, ".$srv_cd."_sngl_price from seset where case_id=$case_id";
    $run= mysqli_query($cn, $query);
    $d=mysqli_fetch_assoc($run);
    return $d;
}

function service_fine($cn,$srv_cd){
    $query= "select excuse_fn, absence_fn from services where srv_cd='$srv_cd'";
    $run= mysqli_query($cn, $query);
    $d=mysqli_fetch_assoc($run);
    return $d;
}

function update_seset($cn,$update_data,$case_id){
	
if(case_ses_is_set($cn,$case_id)===true){// Check whether there is any sessions for the case in the next month.
	header("location:seset.php?caseedit&seset&caset=".$case_id."&mesgalrset");
    //echo $case_id;
}else{
		$fields=array_keys($update_data);
		$data = $update_data;
	$clumndata= join(', ', array_map(
		function ($fields, $data) { return "$fields = '$data'"; },
		$fields,
		$data
    ));
		$query1="UPDATE `seset` SET ".$clumndata." WHERE `case_id`=$case_id";
		mysqli_query($cn, $query1);	
	
	// Submit reference sessions:
	// get ses srv day from srv_cd:
	$fields=array_keys($update_data);
	$fields=array_chunk($fields,8);
	$data=array_chunk($data,8);
	
	$x=0;
	while($x <= count($fields)){
	unset($fields[$x][0]);
	unset($data[$x][0]);
	$x++;
	}
	
	$x=count($fields)-1;
	unset($fields[$x]);
	unset($data[$x]);
	$srv_Sat_tm=array_column($data,1); // contain all services times grouped by day
	$srv_Sun_tm=array_column($data,2);
	$srv_Mon_tm=array_column($data,3);
	$srv_Tue_tm=array_column($data,4);
	$srv_Wed_tm=array_column($data,5);
	$srv_Thu_tm=array_column($data,6);
	$srv_Fri_tm=array_column($data,7);
	
	//$sesrv_day=get_sesrv_days_from_col_fields($cn,$fields);
		//echo "<pre>"; print_r($srv_Sat_tm); echo"</pre>";



//Set Sat sessions:
$frstday = frst_day_of_next_month();
$lastday = lst_day_of_next_month();
$begin  = new DateTime($frstday);
$end    = new DateTime($lastday);
$days = array();
while ($begin <= $end) // Loop will work begin to the end date 
{
	if($begin->format("D") == "Sat") //Check that the day is Saturday here
	{
		$Sat_day= $begin->format("Y-m-d");
		//Insert every service time of saturday date into ses table:
		$query="SELECT `srv_cd` FROM `services` ORDER BY `srv_ordr` ASC";
		$gun=mysqli_query($cn,$query);
		$tm=0;
		while($srv=mysqli_fetch_assoc($gun)){
			$srv_cd=$srv['srv_cd'];
			$price= cas_service_price($cn,$srv_cd,$case_id);
            $rglr_price=$price[$srv_cd.'_rglr_price'];
            $sngl_price=$price[$srv_cd.'_sngl_price'];
            $fine=service_fine($cn,$srv_cd);
            $excuse_fn= $fine['excuse_fn'];
            $absence_fn= $fine['absence_fn'];
			$timestamp=strtotime($Sat_day." ".$srv_Sat_tm[$tm]);
			$session_day=date("Y-m-d", $timestamp);
				if($srv_Sat_tm[$tm]!==''){
					$query2="INSERT INTO `ses` (`cas_id`, `srv_cd`,`ses_day`,`ses_rc_day`,
                                                `ses_rf_tm`, `rglr_price`, `sngl_price`,`exc_fine`,`abs_fine`) 
                            VALUES ($case_id,'$srv_cd','$session_day','$session_day',
                                    '$srv_Sat_tm[$tm]',$rglr_price,$sngl_price,$excuse_fn,$absence_fn)";
					//echo $query2; echo"<br>";
					mysqli_query($cn,$query2);
				}
		$tm++;	
		}
	}

	$begin->modify('+1 day');
} // end of day
	
//Set Sun sessions:
$frstday = frst_day_of_next_month();
$lastday = lst_day_of_next_month();
$begin  = new DateTime($frstday);
$end    = new DateTime($lastday);
$days = array();
while ($begin <= $end) // Loop will work begin to the end date 
{
	if($begin->format("D") == "Sun") //Check that the day is Sunday here
	{
		$sun_day= $begin->format("Y-m-d");
		//Insert every service time of saturday date into ses table:
		$query="SELECT `srv_cd` FROM `services` ORDER BY `srv_ordr` ASC";
		$gun=mysqli_query($cn,$query);
		$tm=0;
		while($srv=mysqli_fetch_assoc($gun)){
			$srv_cd=$srv['srv_cd'];
            $price= cas_service_price($cn,$srv_cd,$case_id);
            $rglr_price=$price[$srv_cd.'_rglr_price'];
            $sngl_price=$price[$srv_cd.'_sngl_price'];
            $fine=service_fine($cn,$srv_cd);
            $excuse_fn= $fine['excuse_fn'];
            $absence_fn= $fine['absence_fn'];
			$timestamp=strtotime($sun_day." ".$srv_Sun_tm[$tm]);
			$session_day=date("Y-m-d", $timestamp);
				if($srv_Sun_tm[$tm]!==''){
                    $query2="INSERT INTO `ses` (`cas_id`, `srv_cd`,`ses_day`,`ses_rc_day`,
                                                `ses_rf_tm`, `rglr_price`, `sngl_price`,`exc_fine`,`abs_fine`) 
                            VALUES ($case_id,'$srv_cd','$session_day','$session_day',
                                    '$srv_Sun_tm[$tm]',$rglr_price,$sngl_price,$excuse_fn,$absence_fn)";
					//echo $query2; echo"<br>";
					$run=mysqli_query($cn,$query2);
				}
		$tm++;	
		}
	}
	$begin->modify('+1 day');
} // end of day

//Set Mon sessions:
$frstday = frst_day_of_next_month();
$lastday = lst_day_of_next_month();
$begin  = new DateTime($frstday);
$end    = new DateTime($lastday);
$days = array();
while ($begin <= $end) // Loop will work begin to the end date 
{
	if($begin->format("D") == "Mon") //Check that the day is Monday here
	{
		$mon_day= $begin->format("Y-m-d");
		//Insert every service time of saturday date into ses table:
		$query="SELECT `srv_cd` FROM `services` ORDER BY `srv_ordr` ASC";
		$gun=mysqli_query($cn,$query);
		$tm=0;
		while($srv=mysqli_fetch_assoc($gun)){
			$srv_cd=$srv['srv_cd'];
            $price= cas_service_price($cn,$srv_cd,$case_id);
            $rglr_price=$price[$srv_cd.'_rglr_price'];
            $sngl_price=$price[$srv_cd.'_sngl_price'];
            $fine=service_fine($cn,$srv_cd);
            $excuse_fn= $fine['excuse_fn'];
            $absence_fn= $fine['absence_fn'];
			$timestamp=strtotime($mon_day." ".$srv_Mon_tm[$tm]);
			$session_day=date("Y-m-d", $timestamp);
				if($srv_Mon_tm[$tm]!==''){
                    $query2="INSERT INTO `ses` (`cas_id`, `srv_cd`,`ses_day`,`ses_rc_day`,
                                                `ses_rf_tm`, `rglr_price`, `sngl_price`,`exc_fine`,`abs_fine`) 
                            VALUES ($case_id,'$srv_cd','$session_day','$session_day',
                                    '$srv_Mon_tm[$tm]',$rglr_price,$sngl_price,$excuse_fn,$absence_fn)";
					//echo $query2; echo"<br>";
					$run=mysqli_query($cn,$query2);
				}
		$tm++;	
		}
	}
	$begin->modify('+1 day');
} // end of day

//Set Tue sessions:
$frstday = frst_day_of_next_month();
$lastday = lst_day_of_next_month();
$begin  = new DateTime($frstday);
$end    = new DateTime($lastday);
$days = array();
while ($begin <= $end) // Loop will work begin to the end date 
{
	if($begin->format("D") == "Tue") //Check that the day is Tuesday here
	{
		$tue_day= $begin->format("Y-m-d");
		//Insert every service time of saturday date into ses table:
		$query="SELECT `srv_cd` FROM `services` ORDER BY `srv_ordr` ASC";
		$gun=mysqli_query($cn,$query);
		$tm=0;
		while($srv=mysqli_fetch_assoc($gun)){
			$srv_cd=$srv['srv_cd'];
            $price= cas_service_price($cn,$srv_cd,$case_id);
            $rglr_price=$price[$srv_cd.'_rglr_price'];
            $sngl_price=$price[$srv_cd.'_sngl_price'];
            $fine=service_fine($cn,$srv_cd);
            $excuse_fn= $fine['excuse_fn'];
            $absence_fn= $fine['absence_fn'];
			$timestamp=strtotime($tue_day." ".$srv_Tue_tm[$tm]);
			$session_day=date("Y-m-d", $timestamp);
				if($srv_Tue_tm[$tm]!==''){
                    $query2="INSERT INTO `ses` (`cas_id`, `srv_cd`,`ses_day`,`ses_rc_day`,
                                                `ses_rf_tm`, `rglr_price`, `sngl_price`,`exc_fine`,`abs_fine`) 
                            VALUES ($case_id,'$srv_cd','$session_day','$session_day',
                                    '$srv_Tue_tm[$tm]',$rglr_price,$sngl_price,$excuse_fn,$absence_fn)";
					//echo $query2; echo"<br>";
					$run=mysqli_query($cn,$query2);
				}
		$tm++;	
		}
	}
	$begin->modify('+1 day');
} // end of day
	
//Set Wed sessions:
$frstday = frst_day_of_next_month();
$lastday = lst_day_of_next_month();
$begin  = new DateTime($frstday);
$end    = new DateTime($lastday);
$days = array();
while ($begin <= $end) // Loop will work begin to the end date 
{
	if($begin->format("D") == "Wed") //Check that the day is Wednesday here
	{
		$wed_day= $begin->format("Y-m-d");
		//Insert every service time of saturday date into ses table:
		$query="SELECT `srv_cd` FROM `services` ORDER BY `srv_ordr` ASC";
		$gun=mysqli_query($cn,$query);
		$tm=0;
		while($srv=mysqli_fetch_assoc($gun)){
			$srv_cd=$srv['srv_cd'];
            $price= cas_service_price($cn,$srv_cd,$case_id);
            $rglr_price=$price[$srv_cd.'_rglr_price'];
            $sngl_price=$price[$srv_cd.'_sngl_price'];
            $fine=service_fine($cn,$srv_cd);
            $excuse_fn= $fine['excuse_fn'];
            $absence_fn= $fine['absence_fn'];
			$timestamp=strtotime($wed_day." ".$srv_Wed_tm[$tm]);
			$session_day=date("Y-m-d", $timestamp);
				if($srv_Wed_tm[$tm]!==''){
                    $query2="INSERT INTO `ses` (`cas_id`, `srv_cd`,`ses_day`,`ses_rc_day`,
                                                `ses_rf_tm`, `rglr_price`, `sngl_price`,`exc_fine`,`abs_fine`) 
                            VALUES ($case_id,'$srv_cd','$session_day','$session_day',
                                    '$srv_Wed_tm[$tm]',$rglr_price,$sngl_price,$excuse_fn,$absence_fn)";
					//echo $query2; echo"<br>";
					$run=mysqli_query($cn,$query2);
				}
		$tm++;	
		}
	}
	$begin->modify('+1 day');
} // end of day
	
//Set Thu sessions:
$frstday = frst_day_of_next_month();
$lastday = lst_day_of_next_month();
$begin  = new DateTime($frstday);
$end    = new DateTime($lastday);
$days = array();
while ($begin <= $end) // Loop will work begin to the end date 
{
	if($begin->format("D") == "Thu") //Check that the day is Thursday here
	{
		$thu_day= $begin->format("Y-m-d");
		//Insert every service time of saturday date into ses table:
		$query="SELECT `srv_cd` FROM `services` ORDER BY `srv_ordr` ASC";
		$gun=mysqli_query($cn,$query);
		$tm=0;
		while($srv=mysqli_fetch_assoc($gun)){
			$srv_cd=$srv['srv_cd'];
            $price= cas_service_price($cn,$srv_cd,$case_id);
            $rglr_price=$price[$srv_cd.'_rglr_price'];
            $sngl_price=$price[$srv_cd.'_sngl_price'];
            $fine=service_fine($cn,$srv_cd);
            $excuse_fn= $fine['excuse_fn'];
            $absence_fn= $fine['absence_fn'];
			$timestamp=strtotime($thu_day." ".$srv_Thu_tm[$tm]);
			$session_day=date("Y-m-d", $timestamp);
				if($srv_Thu_tm[$tm]!==''){
                    $query2="INSERT INTO `ses` (`cas_id`, `srv_cd`,`ses_day`,`ses_rc_day`,
                                                `ses_rf_tm`, `rglr_price`, `sngl_price`,`exc_fine`,`abs_fine`) 
                            VALUES ($case_id,'$srv_cd','$session_day','$session_day',
                                    '$srv_Thu_tm[$tm]',$rglr_price,$sngl_price,$excuse_fn,$absence_fn)";
					//echo $query2; echo"<br>";
					$run=mysqli_query($cn,$query2);
				}
		$tm++;	
		}
	}
	$begin->modify('+1 day');
} // end of day
	
//Set Fri sessions:
$frstday = frst_day_of_next_month();
$lastday = lst_day_of_next_month();
$begin  = new DateTime($frstday);
$end    = new DateTime($lastday);
$days = array();
while ($begin <= $end) // Loop will work begin to the end date 
{
	if($begin->format("D") == "Fri") //Check that the day is Saturday here
	{
		$fri_day= $begin->format("Y-m-d");
		//Insert every service time of saturday date into ses table:
		$query="SELECT `srv_cd` FROM `services` ORDER BY `srv_ordr` ASC";
		$gun=mysqli_query($cn,$query);
		$tm=0;
		while($srv=mysqli_fetch_assoc($gun)){
			$srv_cd=$srv['srv_cd'];
            $price= cas_service_price($cn,$srv_cd,$case_id);
            $rglr_price=$price[$srv_cd.'_rglr_price'];
            $sngl_price=$price[$srv_cd.'_sngl_price'];
            $fine=service_fine($cn,$srv_cd);
            $excuse_fn= $fine['excuse_fn'];
            $absence_fn= $fine['absence_fn'];
			$timestamp=strtotime($fri_day." ".$srv_Fri_tm[$tm]);
			$session_day=date("Y-m-d", $timestamp);
				if($srv_Fri_tm[$tm]!==''){
                    $query2="INSERT INTO `ses` (`cas_id`, `srv_cd`,`ses_day`,`ses_rc_day`,
                                                `ses_rf_tm`, `rglr_price`, `sngl_price`,`exc_fine`,`abs_fine`) 
                            VALUES ($case_id,'$srv_cd','$session_day','$session_day',
                                    '$srv_Fri_tm[$tm]',$rglr_price,$sngl_price,$excuse_fn,$absence_fn)";
					//echo $query2; echo"<br>";
					$run=mysqli_query($cn,$query2);
				}
		$tm++;	
		}
	}
	$begin->modify('+1 day');
} // end of day

delete_fake_ses($cn,$case_id);	

    

    $_SESSION["caset_is_set"]=$case_id;	


	
} // end of the if statement
	
}

function cas_ses_for_nxt_month_isnull($cn,$cas_id){
    $query11="SELECT `ses_day` FROM `ses` WHERE `cas_id`=$cas_id";
    $runn=mysqli_query($cn, $query11);
    while($rr=mysqli_fetch_assoc($runn)){
        $nxt_mnth=date("Y-m",strtotime("+1 month",time()));
        $mnth=date("Y-m",strtotime($rr['ses_day']));
        if($nxt_mnth===$mnth){
            return true;
            break;
        }else{return false;}
    }
}

function get_case_setting($cn,$case_id){
	$query="SELECT * FROM `seset` WHERE `case_id`=$case_id";
	$run= mysqli_query($cn,$query);
	$seset=mysqli_fetch_assoc($run);
	
	return $seset;
	echo "<pre>"; print_r($seset); echo "<pre>";
}

function get_seset_columns_names($cn){
	$query="SELECT * FROM `seset`";
	$run=mysqli_query($cn,$query);
	
	$sesetcolumns=array_keys(mysqli_fetch_assoc($run));
}


function update_ses_price($cn,$update_data,$case_id){
	
		$fields=array_keys($update_data);
		$data = $update_data;
	$clumndata= join(', ', array_map(
		function ($fields, $data) { return "$fields = '$data'"; },
		$fields,
		$data
    ));
		echo $query1="UPDATE `seset` SET ".$clumndata." WHERE `case_id`=$case_id";
		mysqli_query($cn, $query1);	
    
}

function get_rat_categories_opt($cn){
    $query="SELECT * FROM `rat_categ`";
    $data=mysqli_query($cn, $query);

    echo"<option disabled selected value value=''> -- -- -- </option>";
    while($rat_categories= mysqli_fetch_assoc($data)){
        echo "<option value='".$rat_categories['rat_catg_id']."'>".$rat_categories['rat_catg_nm']."</option>";
    }


}

function checkbx_servs($cn,$array33){
    $query="select srv_cd , srv_nm from services";
    $run=mysqli_query($cn, $query);
    while ($d=mysqli_fetch_assoc($run)){
        echo"<div class='chkbx'><input type='checkbox' value='".$d['srv_cd']."' title='".$d['srv_nm']."' name='data[".$d['srv_cd']."_services]'";
        foreach($array33 as $key=>$value){
            if($value===$d['srv_cd']){
                echo " checked";
            }
        }

        echo" >
        ".$d['srv_cd']."
             </div>";
    }
}

function rate_servs($cn,$srv_percent_array){

        $query="select srv_cd , srv_nm from services";
        $run=mysqli_query($cn, $query);
        while ($d=mysqli_fetch_assoc($run)){
            echo"<div class='flexbox'>";
            echo"<span title='".$d['srv_nm']."'>".$d['srv_cd'].":</span> ";
            echo"</div>";
            echo"<div class='flexbox'>";
            echo" <select class='tinytxt' name='data[".$d['srv_cd']."_percent]'>";
            $query="SELECT * FROM `rat_categ`";
            $data=mysqli_query($cn, $query);

            echo"<option  selected value='0'";
            echo"> -- -- -- </option>";
            while($rat_categories= mysqli_fetch_assoc($data)){
               echo "<option value='".$rat_categories['rat_id']."'";

                   foreach ($srv_percent_array as $key => $value){
                       if( $key===$d['srv_cd'] && $value==$rat_categories['rat_id']){
                           echo" selected";
                       }

               }
               echo"";
               echo">".$rat_categories['rat_nm']."</option>";
            }
            echo"</select>";
            echo"</div>";
        }

}




























?>