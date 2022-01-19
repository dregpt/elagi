<?php

function ses_case_list($cn,$month){
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
		
		echo "<a href='cont.php?edcasid=".$usr_id."'>
				  <div class='userrow'>
					<div class='username' ><a href='sescase.php?&caseedit&sescase&ses_mnth={$month}&casid=".$usr_id."'>".$frst_nm." ".$scnd_nm." ".$thrd_nm." ".$lst_nm."</a></div>
					<div class='fileid'>".$file_id."</div>
				  </div>
			  </a>
			  ";
			//get_user_id_from_email($cn,$email);
	}
}

function rec_case_list($cn,$month){
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
        if(is_case_has_sessions_for_month($cn,$recent_added_users['usr_id'],$month)===true){
            echo "<a href='cont.php?edcasid=".$usr_id."'>
                      <div class='userrow'>
                        <div class='username' ><a href='case_records.php?reports&case_records&month={$month}&casid=".$usr_id."'>".$frst_nm." ".$scnd_nm." ".$thrd_nm." ".$lst_nm."</a></div>
                        <div class='fileid'>".$file_id."</div>
                      </div>
                  </a>
                  ";
        }
			//get_user_id_from_email($cn,$email);
	}
}

function rep_case_pay_list($cn,$month){
	$query="SELECT * FROM `users`  WHERE `usr_catg`=7 ORDER BY `users`.`frst_nm` ASC";
	$data=mysqli_query($cn, $query);
	while($recent_added_users= mysqli_fetch_assoc($data)){
		$email=$recent_added_users['eml'];
		$usr_id=get_user_id_from_email($cn,$email);
		$frst_nm=$recent_added_users['frst_nm'];
		$scnd_nm=$recent_added_users['scnd_nm']; 
		$thrd_nm=$recent_added_users['thrd_nm']; 
		$lst_nm =$recent_added_users['lst_nm'];
		$file_id= get_case_file_id_from_user_id($cn,$usr_id);
		$current_month=date("Y-m",time());
        if(is_case_has_sessions_for_month($cn,$recent_added_users['usr_id'],$month)===true){
		echo "<a href='cont.php?edcasid=".$usr_id."'>
				  <div class='userrow'>
					<div class='username' ><a href='case_pystat.php?reports&case_pystat&casid=".$usr_id."&month=".$month."'>".$frst_nm." ".$scnd_nm." ".$thrd_nm." ".$lst_nm."</a></div>
					<div class='fileid'>".$file_id."</div>
				  </div>
			  </a>
			  ";
        }
			//get_user_id_from_email($cn,$email);
	}
}




function get_servname_from_servcod($cn, $srv_cod){
	$query="SELECT `srv_nm` FROM `services` WHERE `srv_cd`='$srv_cod'";
	$runfunc=mysqli_query($cn,$query);
	$data= mysqli_fetch_assoc($runfunc);
	
	$serv_name= $data['srv_nm'];
	return $serv_name;
}
function serv_duration($cn,$srv_cod){
	$query="SELECT `srv_hr` FROM `services` WHERE `srv_cd`='$srv_cod'";
	$run= mysqli_query($cn,$query);
	$data = mysqli_fetch_assoc($run);
	
	return $data['srv_hr'];
}
function session_end_time($cn,$start_time,$srv_cod){
	$session_durtion= serv_duration($cn,$srv_cod)*60;
	$starttime = strtotime($start_time);
	$endTime = date("H:i", $starttime + $session_durtion);
	return $endTime ;
}

function get_name_from_user_id($cn,$usr_id){
	$usr_id=(int)$usr_id;
	$query="SELECT `frst_nm`, `lst_nm` FROM `users` WHERE `usr_id`=$usr_id";
	$runn= mysqli_query($cn,$query);
	$data= mysqli_fetch_assoc($runn);
	return $data;
}

function case_sessions($cn, $case_id,$user_data,$month){
	$query ="SELECT * FROM `ses` WHERE `cas_id`=$case_id and substring(ses_day,1,7)='$month' ORDER BY `ses_day` ASC, `ses_rf_tm`";
	//echo $query;
	$runses = mysqli_query($cn,$query);
	$sesnum= 1;
	while($data=mysqli_fetch_assoc($runses)){
		
		$ses_day=$data['ses_day']; 
		$ses_mon=date("m", strtotime($ses_day));
        $next_month=date("m",strtotime("+1 month",time()));
		$current_month= date("m",time());
        //echo $current_month; echo"<br>";
        //echo $ses_mon; echo"<br>";
        //echo $next_month; echo"<br>";
		
		//if(($ses_mon===$current_month)||($ses_mon===$next_month)){ // To show sessions of the current month only (If you would like to show all sessions change '===' to '!==').
			$srv_cd =$data['srv_cd'];
			$start_time=date('h:i A',strtotime($data['ses_rf_tm'])); 
			$serv_name=get_servname_from_servcod($cn, $srv_cd);
			$end_time = date("h:i A",strtotime(session_end_time($cn,$start_time,$srv_cd)));
			$session_date=date("D d/m/Y", strtotime($data['ses_day']));
			$thrp_id=$data['thrp_id'];
			$submitter = $data['submitter'];
			$thrp_nm=get_name_from_user_id($cn,$thrp_id);
			$mod_nm=get_name_from_user_id($cn,$submitter);
			$ses_id=$data['ses_id'];
			$attend_tm=date("h:i A",strtotime($data['attend_tm']));
			$ses_rc_strt=date("h:i A",strtotime($data['ses_rc_strt']));
			$ses_rc_end=date("h:i A",strtotime($data['ses_rc_end']));
			$session_duration= (strtotime($ses_rc_end) - strtotime($ses_rc_strt))/60;
			$session_rc_date=date("D d/m/Y", strtotime($data['ses_rc_day']));
            $srv_duration=serv_duration($cn,$srv_cd);
			$stat=$data['stat'];
            $price_type=$data['price_stat'];
            $casid= $data['cas_id'];
            $save_time=date("d/m/Y h:i A",$data['submit_timestamp']);

			if($stat==0){ // to show waiting sessions ..
				echo"
					
					<div class='session' >
                    
                        <div class='topsesrow'>";
                if(allowed_prv($cn,$user_data,$args=[1,2])===true){// delete buttom of sessions is available for admins only
                echo"       <div class='deleteicon'>
                                <a  class='deleteicon' onClick=\"return confirm('Are you sure you want to delete this session?')\" href='cont.php?delete_ses=".$ses_id."&casid=".$casid."' >
                                    <img src='img/icons/bin-2.png' class='icon' title='Delete session'>
                                </a>
                            </div>";
                }
                echo"   </div>
                        
                        <a href='sescase.php?caseedit&sescase&casid=".$case_id."&sesid=".$ses_id."& ses_mnth=".$month."'>
						<div class='sesrow1'>
							<div class='sesno'>".$sesnum."</div>
                            <div class='sestype'>".$serv_name." (".$srv_cd;
                            if($price_type==0){echo" - single";}
                            echo ")
                            </div>
							<div class='sestime'>".$session_date." &nbsp;&nbsp; ".$start_time." - ".$end_time."</div>
						</div>
                        </a>
						<div class='sesrow'><div class='sessct'>Waiting ...</div> </div>
					</div>
					
					";
			}// to show waiting sessions ..
			if($stat==1){ // to show taken sessions ..
                if(allowed_prv($cn,$user_data,$args=[1,2])===true){ // taken sessions is available for admins only
				echo"
					<a href='sescase.php?caseedit&sescase&casid=".$case_id."&sesid=".$ses_id."& ses_mnth=".$month."'>
					<div class='sessiontaken'>
						<div class='sesrow'>
							<div class='sesno'>".$sesnum."</div>
                            <div class='sestype'>".$serv_name." (".$srv_cd;
                            if($price_type==0){echo" - single";}
                            echo ")
                            </div>
							<div class='sestimetkn'>".$session_date." &nbsp; 	&nbsp; ".$start_time." - ".$end_time."</div>
						</div>
						<div class='sesrow1'><div class='sestherp'>Therapist: ".$thrp_nm['frst_nm']."  ".$thrp_nm['lst_nm']."</div><div class='sesmodr' title='".$save_time."'>Modifier: ".$mod_nm['frst_nm']."  ".$mod_nm['lst_nm']."</div></div>
						<div class='sesrow'><div class='sessct'>Taken on: </div> <div class='sesactm'>".$session_date." ".$ses_rc_strt." - ".$ses_rc_end." (".$session_duration." of ".$srv_duration." m)</div> </div>
					</div>
					</a>
					";
                }
			}// to show taken sessions ..
			if($stat==2){ // to show excuse sessions ..
                if(allowed_prv($cn,$user_data,$args=[1,2])===true){ // excused sessions is available for admins only
				echo"
					<a href='sescase.php?caseedit&sescase&casid=".$case_id."&sesid=".$ses_id."& ses_mnth=".$month."'>
					<div class='sessionexcuse'>
						<div class='sesrow'>
							<div class='sesno'>".$sesnum."</div>
                            <div class='sestype'>".$serv_name." (".$srv_cd;
                            if($price_type==0){echo" - single";}
                            echo ")
                            </div>
							<div class='sestimeexc'>".$session_date." &nbsp; 	&nbsp; ".$start_time." - ".$end_time."</div>
						</div>
						<div class='sesrow1'><div class='sestherp'>Therapist: ".$thrp_nm['frst_nm']."  ".$thrp_nm['lst_nm']."</div><div class='sesmodr' title='".$save_time."'>Modifier: ".$mod_nm['frst_nm']."  ".$mod_nm['lst_nm']."</div></div>
						<div class='sesrow'><div class='sessct'>Excused on: </div> <div class='sesactm'>".$session_rc_date." &nbsp; &nbsp;".$attend_tm." </div> </div>
					</div>
					</a>
					";
                }
			}// to show excuse sessions ..
			if($stat==3){ // to show absence sessions ..
                if(allowed_prv($cn,$user_data,$args=[1,2])===true){ // absence sessions is available for admins only
				echo"
					<a href='sescase.php?caseedit&sescase&casid=".$case_id."&sesid=".$ses_id."& ses_mnth=".$month."'>
					<div class='sessionabsence'>
						<div class='sesrow'>
							<div class='sesno'>".$sesnum."</div>
                            <div class='sestype'>".$serv_name." (".$srv_cd;
                    if($price_type==0){echo" - single";}
                    echo ")
                            </div>
							<div class='sestimeabc'>".$session_date." &nbsp; 	&nbsp; ".$start_time." - ".$end_time."</div>
						</div>
						<div class='sesrow1'><div class='sestherp'>Therapist: ".$thrp_nm['frst_nm']."  ".$thrp_nm['lst_nm']."</div><div class='sesmodr' title='".$save_time."'>Modifier: ".$mod_nm['frst_nm']."  ".$mod_nm['lst_nm']."</div></div>
						<div class='sesrow'><div class='sessct'>Absence </div> </div>
					</div>
					</a>
					";
                }
			}// to show absence sessions ..
			if($stat==4){ // to show cancelled sessions ..
                if(allowed_prv($cn,$user_data,$args=[1,2])===true){ // cancelled sessions is available for admins only
				echo"
					<a href='sescase.php?caseedit&sescase&casid=".$case_id."&sesid=".$ses_id."& ses_mnth=".$month."'>
					<div class='sessioncancell'>
						<div class='sesrow'>
							<div class='sesno'>".$sesnum."</div>
                            <div class='sestype'>".$serv_name." (".$srv_cd;
                    if($price_type==0){echo" - single";}
                    echo ")
                            </div>
							<div class='sestimecanc'>".$session_date." &nbsp; 	&nbsp; ".$start_time." - ".$end_time."</div>
						</div>
						<div class='sesrow1'><div class='sestherp'>Therapist: ".$thrp_nm['frst_nm']."  ".$thrp_nm['lst_nm']."</div><div class='sesmodr' title='".$save_time."'>Modifier: ".$mod_nm['frst_nm']."  ".$mod_nm['lst_nm']."</div></div>
						<div class='sesrow'><div class='sessct'>Cancelled</div></div>
					</div>
					</a>
					";
                }
			}// to show cancelled sessions ..
			if($stat==5){ // to show waiting re-booked sessions ..
                if(allowed_prv($cn,$user_data,$args=[1,2])===true){ // waiting re-booked sessions is available for admins only
				echo"
					<a href='sescase.php?caseedit&sescase&casid=".$case_id."&sesid=".$ses_id."& ses_mnth=".$month."'>
					<div class='session'>
						<div class='sesrow'>
							<div class='sesno'>".$sesnum."</div>
                            <div class='sestype'>".$serv_name." (".$srv_cd;
                    if($price_type==0){echo" - single";}
                    echo ")
                            </div>
							<div class='sestime'>".$session_date." &nbsp; 	&nbsp; ".$start_time." - ".$end_time."</div>
						</div>
						<div class='sesrow1'><div class='sestherp'>Therapist: ".$thrp_nm['frst_nm']."  ".$thrp_nm['lst_nm']."</div><div class='sesmodr' title='".$save_time."'>Modifier: ".$mod_nm['frst_nm']."  ".$mod_nm['lst_nm']."</div></div>
						<div class='sesrow'><div class='sessct'>Re-booked session waiting on </div><div class='sesactm'>".$session_rc_date." &nbsp; &nbsp;".$ses_rc_strt." </div> </div>
					</div>
					</a>
					";
                }
			}// to show waiting re-booked sessions ..
			if($stat==6){ // to show taken re-booked sessions ..
                if(allowed_prv($cn,$user_data,$args=[1,2])===true){ // taken re-booked sessions is available for admins only
				echo"
					<a href='sescase.php?caseedit&sescase&casid=".$case_id."&sesid=".$ses_id."& ses_mnth=".$month."'>
                    <div class='sessiontaken'>
                        <div class='sesrow'>
                            <div class='sesno'>".$sesnum."</div>
                            <div class='sestype'>".$serv_name." (".$srv_cd;
                    if($price_type==0){echo" - single";}
                    echo ")
                            </div>
                            <div class='sestimetkn'>".$session_date." &nbsp; 	&nbsp; ".$start_time." - ".$end_time."</div>
                        </div>
                        <div class='sesrow1'><div class='sestherp'>Therapist: ".$thrp_nm['frst_nm']."  ".$thrp_nm['lst_nm']."</div><div class='sesmodr' title='".$save_time."'>Modifier: ".$mod_nm['frst_nm']."  ".$mod_nm['lst_nm']."</div></div>
                        <div class='sesrow'><div class='sessct'>Re-booked session taken on: </div> <div class='sesactm'>".$session_date."".$ses_rc_strt." - ".$ses_rc_end."(".$session_duration." of ".$srv_duration." min)</div> </div>
                    </div>
					</a>
					";
                }
			}// to show taken re-booked sessions ..
			if($stat==7){ // to show excused re-booked sessions ..
                if(allowed_prv($cn,$user_data,$args=[1,2])===true){ // excused re-booked re-booked sessions is available for admins only
				echo"
					<a href='sescase.php?caseedit&sescase&casid=".$case_id."&sesid=".$ses_id."& ses_mnth=".$month."'>
					<div class='sessionexcuse'>
						<div class='sesrow'>
							<div class='sesno'>".$sesnum."</div>
                            <div class='sestype'>".$serv_name." (".$srv_cd;
                    if($price_type==0){echo" - single";}
                    echo ")
                            </div>
							<div class='sestimeexc'>".$session_date." &nbsp; 	&nbsp; ".$start_time." - ".$end_time."</div>
						</div>
						<div class='sesrow1'><div class='sestherp'>Therapist: ".$thrp_nm['frst_nm']."  ".$thrp_nm['lst_nm']."</div><div class='sesmodr' title='".$save_time."'>Modifier: ".$mod_nm['frst_nm']."  ".$mod_nm['lst_nm']."</div></div>
						<div class='sesrow'><div class='sessct'>Excused re-booked session on: </div> <div class='sesactm'>".$session_rc_date." &nbsp; &nbsp;".$attend_tm." </div> </div>
					</div>
					</a>
					";
                }
			}// to show excused re-booked sessions ..
			if($stat==8){ // to show absence rebooked sessions ..
                if(allowed_prv($cn,$user_data,$args=[1,2])===true){ // absence re-booked re-booked sessions is available for admins only
				echo"
					<a href='sescase.php?caseedit&sescase&casid=".$case_id."&sesid=".$ses_id."& ses_mnth=".$month."'>
					<div class='sessionabsence'>
						<div class='sesrow'>
							<div class='sesno'>".$sesnum."</div>
                            <div class='sestype'>".$serv_name." (".$srv_cd;
                    if($price_type==0){echo" - single";}
                    echo ")
                            </div>
							<div class='sestime'>".$session_date." &nbsp; 	&nbsp; ".$start_time." - ".$end_time."</div>
						</div>
						<div class='sesrow1'><div class='sestherp'>Therapist: ".$thrp_nm['frst_nm']."  ".$thrp_nm['lst_nm']."</div><div class='sesmodr' title='".$save_time."'>Modifier: ".$mod_nm['frst_nm']."  ".$mod_nm['lst_nm']."</div></div>
						<div class='sesrow'><div class='sessct'>Absence of re-booked session</div> </div>
					</div>
					</a>
					";
                }
			}// to show absence rebooked sessions ..
			if($stat==9){ // to show cancelled re-book sessions ..
                if(allowed_prv($cn,$user_data,$args=[1,2])===true){ // cancelled re-booked re-booked sessions is available for admins only
				echo"
					<a href='sescase.php?caseedit&sescase&casid=".$case_id."&sesid=".$ses_id."& ses_mnth=".$month."'>
					<div class='sessioncancell'>
						<div class='sesrow'>
							<div class='sesno'>".$sesnum."</div>
                            <div class='sestype'>".$serv_name." (".$srv_cd;
                    if($price_type==0){echo" - single";}
                    echo ")
                            </div>
							<div class='sestimecanc'>".$session_date." &nbsp; 	&nbsp; ".$start_time." - ".$end_time."</div>
						</div>
						<div class='sesrow1'><div class='sestherp'>Therapist: ".$thrp_nm['frst_nm']."  ".$thrp_nm['lst_nm']."</div><div class='sesmodr' title='".$save_time."'>Modifier: ".$mod_nm['frst_nm']."  ".$mod_nm['lst_nm']."</div></div>
						<div class='sesrow'><div class='sessct'>Cancelled re-booked session</div></div>
					</div>
					</a>
					";
                }
			}// to show cancelled re-book sessions ..
			$sesnum++;
	}
}


function day_sessions($cn,$day){
	$query ="SELECT * FROM `ses` WHERE `ses_day`='".$day."' ORDER BY `ses_rf_tm` ASC, `cas_id`";
	//echo $query;

	$runses = mysqli_query($cn,$query);
	$sesnum= 1;
	while($data=mysqli_fetch_assoc($runses)){
		
		$ses_day=$day;
		$ses_mon=date("m", strtotime($day));
        $next_month=date("m",strtotime("first day of +1 month"));
		//$current_month= date("m",time());
        //echo $current_month; echo"<br>";
        //echo $ses_mon; echo"<br>";
        //echo $next_month; echo"<br>";

		    $cur_time=time();
			$srv_cd =$data['srv_cd'];
			$start_time=date('h:i A',strtotime($data['ses_rf_tm'])); 
            $ses_start_hour=strtotime($data['ses_rf_tm']);
			$serv_name=get_servname_from_servcod($cn, $srv_cd);
            $end_time = date("h:i A",strtotime(session_end_time($cn,$start_time,$srv_cd)));
           $ses_end_hour= strtotime(session_end_time($cn,$start_time,$srv_cd));
			$session_date=date("D d/m/Y", strtotime($data['ses_day']));
			$thrp_id=$data['thrp_id'];
			$submitter = $data['submitter'];
			$thrp_nm=get_name_from_user_id($cn,$thrp_id);
			$mod_nm=get_name_from_user_id($cn,$submitter);
			$ses_id=$data['ses_id'];
			$attend_tm=date("h:i A",strtotime($data['attend_tm']));
			$ses_rc_strt=date("h:i A",strtotime($data['ses_rc_strt']));
			$ses_rc_end=date("h:i A",strtotime($data['ses_rc_end']));
			$session_duration= (strtotime($ses_rc_end) - strtotime($ses_rc_strt))/60;
			$session_rc_date=date("D d/m/Y", strtotime($data['ses_rc_day']));
            $srv_duration=serv_duration($cn,$srv_cd);
			$stat=$data['stat'];
			$price_type=$data['price_stat'];
            $case_id= $data['cas_id'];
            $nm=get_fullname_from_user_id($cn,$case_id);
            $save_time=date("d/m/Y h:i A",$data['submit_timestamp']);
            global $regular_record_notes;

            $submit_timestamp=$data['submit_timestamp'];
            //$regular_record_notes=array();
            
            $pre_start_time_by_one_hour=time()-(60*60*12);
            $post_start_time_by_3_hours=time()+(60*60*12);
            
           // if($start_timestamp>=$pre_start_time_by_one_hour && $start_timestamp <= $post_start_time_by_3_hours){ // to view sessions only one hour pre and two hours post its reference time
			if($stat==0){ // to show waiting sessions ..

				echo"
					<a id='ses{$ses_id}' data-sesid='{$ses_id}' class='sesanch' href='regular_rec.php?regular_rec&regular&ses_day=".$day."&casid=".$case_id."&sesid=".$ses_id."' data-rctm='{$submit_timestamp}'>
					<div class='session' >";
				if($cur_time >= $ses_start_hour && $cur_time<=$ses_end_hour && $ses_day===date("Y-m-d",time())){
				    echo"<div class='rec_btm' title='Active session'></div>";
                    $pay_dues_array=pay_dues_array($cn);
                    if(empty($pay_dues_array)===false){
                        foreach ($pay_dues_array as $keys=>$values){
                            if($keys==$case_id){
                                if(notify_payment($cn,$case_id)===true) {
                                    echo "<dive class='pulsed_note'>Low paymet balance! (" . $values . " L.E).</dive>";
                                }
                            }
                        }
                    }
				}elseif($cur_time>$ses_end_hour  && $ses_day===date("Y-m-d",time())){
				    echo"<spam class='redfont'>Should be ended!</spam>";
				}elseif($cur_time>($ses_start_hour-(60*30)) && $ses_day===date("Y-m-d",time())){
				    echo "<div class='standby_btm' title='Will start soon!'></div>";
				}
                    echo" <div class='sesrow'>".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm']."</div>
                            <div class='sesrow1'>
                                <div class='sesno'>".$sesnum."</div>
                                <div class='sestype'>".$serv_name." (".$srv_cd;
                                if($price_type==0){echo" - single";}
                                echo ")
                                </div>
                                <div class='sestime'>".$session_date." &nbsp; 	&nbsp; ".$start_time." - ".$end_time."</div>
                            </div>
                            <div class='sesrow1'>";
				    if(empty( $thrp_nm['frst_nm'])===false) {
                        echo "<div class='sestherp'>Therapist: " . $thrp_nm['frst_nm'] . "  " . $thrp_nm['lst_nm'] . "</div>";
                    }
                    if(empty($mod_nm['frst_nm'])===false) {
                        echo "<div class='sesmodr' title='" . $save_time . "'>Modifier: " . $mod_nm['frst_nm'] . "  " . $mod_nm['lst_nm'] . "</div>";
                    }
                    echo"</div>
                            <div class='sesrow'>
                                ";
                if($attend_tm!=="02:00 AM") {
                    echo "<div class='sesactm'>Attended on " . $attend_tm . "  </div>";
                    if ($ses_rc_strt !== "02:00 AM") {
                        echo "<div class='sesactm'>- Started on " . $ses_rc_strt . " </div>";
                    }elseif($cur_time >= $ses_start_hour && $cur_time<=$ses_end_hour && $ses_day===date("Y-m-d",time())){
                        echo "<div class='pulsed_note'>Session not started yet!</div>";
                        $regular_record_notes[]="A (".$srv_cd.") session for (".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm'].") not started yet!";
                    }
                }elseif($attend_tm==="02:00 AM" && $cur_time>($ses_start_hour) && $ses_day===date("Y-m-d",time())){
                    echo "<div class='pulsed_note'>Case not attended yet!</div>";
                    $regular_record_notes[]=$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm']." has not attended for the (".$srv_cd.") session yet!";
                }elseif($attend_tm==="02:00 AM" && $cur_time>($ses_start_hour-(60*30)) && $ses_day===date("Y-m-d",time())){
                    echo "<div class='sessct'>Should start soon!</div>";
                }else{
                    echo"<div class='sessct'>Waiting ...</div>";
                }
	                echo"</div>
					</div>
					</a>
					";
			}// to show waiting sessions ..
			if($stat==1){ // to show taken sessions ..
				echo"
					<a id='ses{$ses_id}' data-sesid='{$ses_id}' class='sesanch' href='regular_rec.php?regular_rec&regular&ses_day=".$day."&casid=".$case_id."&sesid=".$ses_id."' data-rctm='{$submit_timestamp}'>
					<div class='sessiontaken'>
                        <div class='sesrow'>".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm']."</div>
						<div class='sesrow1'>
							<div class='sesno'>".$sesnum."</div>
                            <div class='sestype'>".$serv_name." (".$srv_cd;
                            if($price_type==0){echo" - single";}
                            echo ")
                            </div>
							<div class='sestimetkn'>".$session_date." &nbsp; 	 ".$start_time." - ".$end_time."</div>
						</div>
						<div class='sesrow1'><div class='sestherp'>Therapist: ".$thrp_nm['frst_nm']."  ".$thrp_nm['lst_nm']."</div><div class='sesmodr' title='".$save_time."'>Modifier: ".$mod_nm['frst_nm']."  ".$mod_nm['lst_nm']."</div></div>
						<div class='sesrow'><div class='sessct'>Taken on: </div> <div class='sesactm'>".$session_date." ".$ses_rc_strt." - ".$ses_rc_end."  (".$session_duration." of ".$srv_duration." m)</div> </div>
					</div>
					</a>
					";
			}// to show taken sessions ..
			if($stat==2){ // to show excused sessions ..
				echo"
					<a id='ses{$ses_id}' data-sesid='{$ses_id}' class='sesanch'  href='regular_rec.php?regular_rec&regular&ses_day=".$day."&casid=".$case_id."&sesid=".$ses_id."' data-rctm='{$submit_timestamp}'>
					<div class='sessionexcuse'>
                        <div class='sesrow'>".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm']."</div>
						<div class='sesrow1'>
							<div class='sesno'>".$sesnum."</div>
                            <div class='sestype'>".$serv_name." (".$srv_cd;
                if($price_type==0){echo" - single";}
                echo ")
                            </div>
							<div class='sestime'>".$session_date." &nbsp; 	&nbsp; ".$start_time." - ".$end_time."</div>
						</div>
						<div class='sesrow1'><div class='sestherp'>Therapist: ".$thrp_nm['frst_nm']."  ".$thrp_nm['lst_nm']."</div><div class='sesmodr'  title='".$save_time."'>Modifier: ".$mod_nm['frst_nm']."  ".$mod_nm['lst_nm']."</div></div>
						<div class='sesrow'><div class='sessct'>Excused on: </div> <div class='sesactm'>".$session_rc_date." &nbsp; &nbsp;".$attend_tm." </div> </div>
					</div>
					</a>
					";
                $regular_record_notes[]=$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm']." had excused from attending a (".$srv_cd.") session.";
			}// to show excused sessions ..
			if($stat==3){ // to show absence sessions ..
				echo"
					<a id='ses{$ses_id}' data-sesid='{$ses_id}' class='sesanch' href='regular_rec.php?regular_rec&regular&ses_day=".$day."&casid=".$case_id."&sesid=".$ses_id."' data-rctm='{$submit_timestamp}'>
					<div class='sessionabsence'>
                        <div class='sesrow'>".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm']."</div>
						<div class='sesrow1'>
							<div class='sesno'>".$sesnum."</div>
                            <div class='sestype'>".$serv_name." (".$srv_cd;
                if($price_type==0){echo" - single";}
                echo ")
                            </div>
							<div class='sestime'>".$session_date." &nbsp; 	&nbsp; ".$start_time." - ".$end_time."</div>
						</div>
						<div class='sesrow1'><div class='sestherp'>Therapist: ".$thrp_nm['frst_nm']."  ".$thrp_nm['lst_nm']."</div><div class='sesmodr' title='".$save_time."'>Modifier: ".$mod_nm['frst_nm']."  ".$mod_nm['lst_nm']."</div></div>
						<div class='sesrow'><div class='sessct'>Absence </div> </div>
					</div>
					</a>
					";
                $regular_record_notes[]=$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm']." is absent from attending a (".$srv_cd.") session.";
			}// to show absence sessions ..
			if($stat==4){ // to show cancelled sessions ..
				echo"
					<a id='ses{$ses_id}' data-sesid='{$ses_id}' class='sesanch' href='regular_rec.php?regular_rec&regular&ses_day=".$day."&casid=".$case_id."&sesid=".$ses_id."' data-rctm='{$submit_timestamp}'>
					<div class='sessioncancell'>
                        <div class='sesrow'>".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm']."</div>
						<div class='sesrow1'>
							<div class='sesno'>".$sesnum."</div>
                            <div class='sestype'>".$serv_name." (".$srv_cd;
                if($price_type==0){echo" - single";}
                echo ")
                            </div>
							<div class='sestime'>".$session_date." &nbsp; 	&nbsp; ".$start_time." - ".$end_time."</div>
						</div>
						<div class='sesrow1'><div class='sestherp'>Therapist: ".$thrp_nm['frst_nm']."  ".$thrp_nm['lst_nm']."</div><div class='sesmodr' title='".$save_time."'>Modifier: ".$mod_nm['frst_nm']."  ".$mod_nm['lst_nm']."</div></div>
						<div class='sesrow'><div class='sessct'>Cancelled</div></div>
					</div>
					</a>
					";
                $regular_record_notes[]="We had cancelled a (".$srv_cd.") session for ".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm'].".";
			}// to show cancelled sessions ..
			if($stat==5){ // to show waiting re-book sessions ..
                echo"
					<a id='ses{$ses_id}' data-sesid='{$ses_id}' class='sesanch' href='regular_rec.php?regular_rec&regular&ses_day=".$day."&casid=".$case_id."&sesid=".$ses_id."' data-rctm='{$submit_timestamp}'>
					<div class='session' >";
                if($cur_time >= $ses_start_hour && $cur_time<=$ses_end_hour && $ses_day===date("Y-m-d",time())){
                    echo"<div class='rec_btm' title='Active session'></div>";
                    $pay_dues_array=pay_dues_array($cn);
                    if(empty($pay_dues_array)===false){
                        foreach ($pay_dues_array as $keys=>$values){
                            if($keys==$case_id){
                                if(notify_payment($cn,$case_id)===true) {
                                    echo "<dive class='pulsed_note'>Low paymet balance! (" . $values . " L.E).</dive>";
                                }
                            }
                        }
                    }
                }elseif($cur_time>$ses_end_hour  && $ses_day===date("Y-m-d",time())){
                    echo"<spam class='redfont'>Should be ended!</spam>";
                }elseif($cur_time>($ses_start_hour-(60*30)) && $ses_day===date("Y-m-d",time())){
                    echo "<div class='standby_btm' title='Will start soon!'></div>";
                }
                echo" <div class='sesrow'>".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm']."</div>
                            <div class='sesrow1'>
                                <div class='sesno'>".$sesnum."</div>
                                <div class='sestype'>".$serv_name." (".$srv_cd;
                    if($price_type==0){echo" - single";}
                    echo ")
                                </div>
                                <div class='sestime'>".$session_date." &nbsp; 	&nbsp; ".$start_time." - ".$end_time."</div>
                            </div>
                            <div class='sesrow1'>";
                if(empty( $thrp_nm['frst_nm'])===false) {
                    echo "<div class='sestherp'>Therapist: " . $thrp_nm['frst_nm'] . "  " . $thrp_nm['lst_nm'] . "</div>";
                }
                if(empty($mod_nm['frst_nm'])===false) {
                    echo "<div class='sesmodr' title='" . $save_time . "'>Modifier: " . $mod_nm['frst_nm'] . "  " . $mod_nm['lst_nm'] . "</div>";
                }
                echo"</div>
                            <div class='sesrow'>
                                ";
                if($attend_tm!=="02:00 AM") {
                    echo "<div class='sesactm'>Attended on " . $attend_tm . "  </div>";
                    if ($ses_rc_strt !== "02:00 AM") {
                        echo "<div class='sesactm'>- Started on " . $ses_rc_strt . " </div>";
                    }elseif($cur_time >= $ses_start_hour && $cur_time<=$ses_end_hour && $ses_day===date("Y-m-d",time())){
                        echo "<div class='pulsed_note'>Session not started yet!</div>";
                        $regular_record_notes[]="A (".$srv_cd.") session for (".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm'].") not started yet!";
                    }
                }elseif($attend_tm==="02:00 AM" && $cur_time>($ses_start_hour) && $ses_day===date("Y-m-d",time())){
                    echo "<div class='pulsed_note'>Case not attended yet!</div>";
                    $regular_record_notes[]=$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm']." has not attended for the (".$srv_cd.") session yet!";
                }elseif($attend_tm==="02:00 AM" && $cur_time>($ses_start_hour-(60*30)) && $ses_day===date("Y-m-d",time())){
                    echo "<div class='sessct'>Should start soon!</div>";
                }else{
                    echo"<div class='sessct'>Re-booked session waiting ...</div>";
                }
                echo"</div>
					</div>
					</a>
					";
			}// to show waiting re-book sessions ..
			if($stat==6){ // to show taken re-book sessions ..
				echo"
					<a id='ses{$ses_id}' data-sesid='{$ses_id}' class='sesanch' href='regular_rec.php?regular_rec&regular&ses_day=".$day."&casid=".$case_id."&sesid=".$ses_id."' data-rctm='{$submit_timestamp}'>
                    <div class='sessiontaken'>
                       <div class='sesrow'>".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm']."</div>
                       <div class='sesrow1'>
                            <div class='sesno'>".$sesnum."</div>
                            <div class='sestype'>".$serv_name." (".$srv_cd;
                if($price_type==0){echo" - single";}
                echo ")
                            </div>
                            <div class='sestime'>".$session_date." &nbsp; 	&nbsp; ".$start_time." - ".$end_time."</div>
                        </div>
                        <div class='sesrow1'><div class='sestherp'>Therapist: ".$thrp_nm['frst_nm']."  ".$thrp_nm['lst_nm']."</div><div class='sesmodr' title='".$save_time."'>Modifier: ".$mod_nm['frst_nm']."  ".$mod_nm['lst_nm']."</div></div>
                        <div class='sesrow'><div class='sessct'>Re-booked session taken on: </div> <div class='sesactm'>".$session_date." ".$ses_rc_strt." - ".$ses_rc_end." (".$session_duration." of ".$srv_duration." m)</div> </div>
                    </div>
					</a>
					";
			}// to show taken re-book sessions ..
			if($stat==7){ // to show excused re-book sessions ..
				echo"
					<a id='ses{$ses_id}' data-sesid='{$ses_id}' class='sesanch' href='regular_rec.php?regular_rec&regular&ses_day=".$day."&casid=".$case_id."&sesid=".$ses_id."' data-rctm='{$submit_timestamp}'>
					<div class='sessionexcuse'>
                        <div class='sesrow'>".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm']."</div>
						<div class='sesrow1'>
							<div class='sesno'>".$sesnum."</div>
                            <div class='sestype'>".$serv_name." (".$srv_cd;
                if($price_type==0){echo" - single";}
                echo ")
                            </div>
							<div class='sestime'>".$session_date." &nbsp; 	&nbsp; ".$start_time." - ".$end_time."</div>
						</div>
						<div class='sesrow1'><div class='sestherp'>Therapist: ".$thrp_nm['frst_nm']."  ".$thrp_nm['lst_nm']."</div><div class='sesmodr' title='".$save_time."'>Modifier: ".$mod_nm['frst_nm']."  ".$mod_nm['lst_nm']."</div></div>
						<div class='sesrow'><div class='sessct'>Excused re-booked session on: </div> <div class='sesactm'>".$session_date." &nbsp; &nbsp;".$attend_tm." </div> </div>
					</div>
					</a>
					";
                $regular_record_notes[]=$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm']." had excused from attending the (".$srv_cd.") session.";
			}// to show excused re-book sessions ..
			if($stat==8){ // to show absence re-book sessions ..
				echo"
					<a id='ses{$ses_id}' data-sesid='{$ses_id}' class='sesanch' href='regular_rec.php?regular_rec&regular&ses_day=".$day."&casid=".$case_id."&sesid=".$ses_id."' data-rctm='{$submit_timestamp}'>
					<div class='sessionabsence'>
                        <div class='sesrow'>".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm']."</div>
						<div class='sesrow1'>
							<div class='sesno'>".$sesnum."</div>
                            <div class='sestype'>".$serv_name." (".$srv_cd;
                if($price_type==0){echo" - single";}
                echo ")
                            </div>
							<div class='sestime'>".$session_date." &nbsp; 	&nbsp; ".$start_time." - ".$end_time."</div>
						</div>
						<div class='sesrow1'><div class='sestherp'>Therapist: ".$thrp_nm['frst_nm']."  ".$thrp_nm['lst_nm']."</div><div class='sesmodr' title='".$save_time."'>Modifier: ".$mod_nm['frst_nm']."  ".$mod_nm['lst_nm']."</div></div>
						<div class='sesrow'><div class='sessct'>Absence of re-booked session</div> </div>
					</div>
					</a>
					";
                $regular_record_notes[]=$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm']." is absent from attending the (".$srv_cd.") session.";
			}// to show absence re-book sessions ..
			if($stat==9){ // to show Cancelled re-booked session sessions ..
				echo"
					<a id='ses{$ses_id}' data-sesid='{$ses_id}' class='sesanch' href='regular_rec.php?regular_rec&regular&ses_day=".$day."&casid=".$case_id."&sesid=".$ses_id."' data-rctm='{$submit_timestamp}'>
					<div class='session'>
                        <div class='sesrow'>".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm']."</div>
						<div class='sesrow1'>
							<div class='sesno'>".$sesnum."</div>
                            <div class='sestype'>".$serv_name." (".$srv_cd;
                if($price_type==0){echo" - single";}
                echo ")
                            </div>
							<div class='sestime'>".$session_date." &nbsp; 	&nbsp; ".$start_time." - ".$end_time."</div>
						</div>
						<div class='sesrow1'><div class='sestherp'>Therapist: ".$thrp_nm['frst_nm']."  ".$thrp_nm['lst_nm']."</div><div class='sesmodr' title='".$save_time."'>Modifier: ".$mod_nm['frst_nm']."  ".$mod_nm['lst_nm']."</div></div>
						<div class='sesrow'><div class='sessct'>Cancelled re-booked session</div></div>
					</div>
					</a>
					";
                $regular_record_notes[]="We had cancelled a (".$srv_cd.") session for ".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm'].".";
			}// to show Cancelled re-booked session sessions ..
                
			$sesnum++;
           // }
	}

}

function num_sessions_month_for_case($cn,$cas_id,$month){ // numer of all sesssions for a case in a moth
    $run=mysqli_query($cn,"select count(ses_id) from ses where cas_id=$cas_id and substr(ses_day,1,7)='".$month."'");
    while($d=mysqli_fetch_array($run)){
        return $d[0];
    }
}

function num_rebooked_sessions_for_case($cn,$cas_id,$month){
    $run=mysqli_query($cn,"select count(ses_id) from ses where cas_id=$cas_id and substr(ses_day,1,7)='".$month."' and stat =6");
    while($d=mysqli_fetch_array($run)){
        return $d[0];
    }
}

function allowed_excused_limit_for_rebooking($cn,$cas_id,$month){
    $num_sessions_month_for_case=num_sessions_month_for_case($cn,$cas_id,$month);
    
    $query="select rebook_limit from exc_limit where frm <= $num_sessions_month_for_case and t >= $num_sessions_month_for_case";
    $run=mysqli_query($cn,$query);
    while ($d=mysqli_fetch_assoc($run)){
        return $d['rebook_limit'];
    }
}



function allwed_excuses_for_rebooking($cn,$month){

	$query ="SELECT * FROM `ses` WHERE SUBSTR(ses_day,1,7)='".$month."' and (stat =2 or stat =4 or stat=9) and rebook_stat=1 ORDER BY `ses_day` ASC, `ses_rf_tm` ASC, `cas_id`";
	//echo $query;

	$runses = mysqli_query($cn,$query);
	$sesnum= 1;
	while($data=mysqli_fetch_assoc($runses)){
        
        if(setting_status($cn,1,"cont")==1){
		  $num_rebooked_sessions_for_case=num_rebooked_sessions_for_case($cn,$data['cas_id'],$month);  //2
          $allowed_excused_limit_for_rebooking=allowed_excused_limit_for_rebooking($cn,$data['cas_id'],$month); //5
          if($num_rebooked_sessions_for_case <= $allowed_excused_limit_for_rebooking){
                $srv_cd =$data['srv_cd'];
                $start_time=date('h:i A',strtotime($data['ses_rf_tm'])); 
                $serv_name=get_servname_from_servcod($cn, $srv_cd);
                $end_time = date("h:i A",strtotime(session_end_time($cn,$start_time,$srv_cd)));
                $session_date=date("D d/m/Y", strtotime($data['ses_day']));
                $thrp_id=$data['thrp_id'];
                $submitter = $data['submitter'];
                $thrp_nm=get_name_from_user_id($cn,$thrp_id);
                $mod_nm=get_name_from_user_id($cn,$submitter);
                $ses_id=$data['ses_id'];
                $attend_tm=date("h:i A",strtotime($data['attend_tm']));
                $ses_rc_strt=date("h:i A",strtotime($data['ses_rc_strt']));
                $ses_rc_end=date("h:i A",strtotime($data['ses_rc_end']));
                $session_duration= (strtotime($ses_rc_end) - strtotime($ses_rc_strt))/60;
                $session_rc_date=date("D d/m/Y", strtotime($data['ses_rc_day']));
                $srv_duration=serv_duration($cn,$srv_cd);
                $stat=$data['stat'];
                $case_id= $data['cas_id'];
                $nm=get_fullname_from_user_id($cn,$case_id);
                $save_time=date("d/m/Y h:i A",$data['submit_timestamp']);


                if($stat==2){ // to show excused sessions ..
                    echo"
                        <a href='rebooking.php?regular_rec&rebooking&casid=".$case_id."&sesid=".$ses_id."'>
                        <div class='sessionexcuse'>
                            <div class='sesrow'>".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm']."</div>
                            <div class='sesrow1'>
                                <div class='sesno'>".$sesnum."</div><div class='sestype'>".$serv_name." (".$srv_cd.")</div><div class='sestime'>".$session_date." &nbsp; 	&nbsp; ".$start_time." - ".$end_time."</div>
                            </div>
                            <div class='sesrow1'><div class='sestherp'>Therapist: ".$thrp_nm['frst_nm']."  ".$thrp_nm['lst_nm']."</div><div class='sesmodr'  title='".$save_time."'>Modifier: ".$mod_nm['frst_nm']."  ".$mod_nm['lst_nm']."</div></div>
                            <div class='sesrow'><div class='sessct'>Excused on: </div> <div class='sesactm'>".$session_rc_date." &nbsp; &nbsp;".$attend_tm." </div> </div>
                        </div>
                        </a>
                        ";
                }
                if($stat==4){ // to show cancelled sessions ..
                    echo"
                        <a href='rebooking.php?regular_rec&rebooking&casid=".$case_id."&sesid=".$ses_id."'>
                        <div class='sessioncancell'>
                            <div class='sesrow'>".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm']."</div>
                            <div class='sesrow1'>
                                <div class='sesno'>".$sesnum."</div><div class='sestype'>".$serv_name." (".$srv_cd.")</div><div class='sestime'>".$session_date." &nbsp; 	&nbsp; ".$start_time." - ".$end_time."</div>
                            </div>
                            <div class='sesrow1'><div class='sestherp'>Therapist: ".$thrp_nm['frst_nm']."  ".$thrp_nm['lst_nm']."</div><div class='sesmodr' title='".$save_time."'>Modifier: ".$mod_nm['frst_nm']."  ".$mod_nm['lst_nm']."</div></div>
                            <div class='sesrow'><div class='sessct'>Cancelled</div></div>
                        </div>
                        </a>
                        ";
                }
                if($stat==9){ // to show Cancelled re-booked session sessions ..
                    echo"
                        <a href='rebooking.php?regular_rec&rebooking&casid=".$case_id."&sesid=".$ses_id."'>
                        <div class='session'>
                            <div class='sesrow'>".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm']."</div>
                            <div class='sesrow1'>
                                <div class='sesno'>".$sesnum."</div><div class='sestype'>".$serv_name." (".$srv_cd.")</div><div class='sestime'>".$session_date." &nbsp; 	&nbsp; ".$start_time." - ".$end_time."</div>
                            </div>
                            <div class='sesrow1'><div class='sestherp'>Therapist: ".$thrp_nm['frst_nm']."  ".$thrp_nm['lst_nm']."</div><div class='sesmodr' title='".$save_time."'>Modifier: ".$mod_nm['frst_nm']."  ".$mod_nm['lst_nm']."</div></div>
                            <div class='sesrow'><div class='sessct'>Cancelled re-booked session</div></div>
                        </div>
                        </a>
                        ";
                }
                $sesnum++;
          }//if(num_rebooked_sessions_for_case <= $allowed_excused_limit_for_rebooking)
        }else{
                $srv_cd =$data['srv_cd'];
                $start_time=date('h:i A',strtotime($data['ses_rf_tm'])); 
                $serv_name=get_servname_from_servcod($cn, $srv_cd);
                $end_time = date("h:i A",strtotime(session_end_time($cn,$start_time,$srv_cd)));
                $session_date=date("D d/m/Y", strtotime($data['ses_day']));
                $thrp_id=$data['thrp_id'];
                $submitter = $data['submitter'];
                $thrp_nm=get_name_from_user_id($cn,$thrp_id);
                $mod_nm=get_name_from_user_id($cn,$submitter);
                $ses_id=$data['ses_id'];
                $attend_tm=date("h:i A",strtotime($data['attend_tm']));
                $ses_rc_strt=date("h:i A",strtotime($data['ses_rc_strt']));
                $ses_rc_end=date("h:i A",strtotime($data['ses_rc_end']));
                $session_duration= (strtotime($ses_rc_end) - strtotime($ses_rc_strt))/60;
                $session_rc_date=date("D d/m/Y", strtotime($data['ses_rc_day']));
                $srv_duration=serv_duration($cn,$srv_cd);
                $stat=$data['stat'];
                $case_id= $data['cas_id'];
                $nm=get_fullname_from_user_id($cn,$case_id);
                $save_time=date("d/m/Y h:i A",$data['submit_timestamp']);


                if($stat==2){ // to show excused sessions ..
                    echo"
                        <a href='rebooking.php?regular_rec&rebooking&casid=".$case_id."&sesid=".$ses_id."'>
                        <div class='sessionexcuse'>
                            <div class='sesrow'>".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm']."</div>
                            <div class='sesrow1'>
                                <div class='sesno'>".$sesnum."</div><div class='sestype'>".$serv_name." (".$srv_cd.")</div><div class='sestime'>".$session_date." &nbsp; 	&nbsp; ".$start_time." - ".$end_time."</div>
                            </div>
                            <div class='sesrow1'><div class='sestherp'>Therapist: ".$thrp_nm['frst_nm']."  ".$thrp_nm['lst_nm']."</div><div class='sesmodr'  title='".$save_time."'>Modifier: ".$mod_nm['frst_nm']."  ".$mod_nm['lst_nm']."</div></div>
                            <div class='sesrow'><div class='sessct'>Excused on: </div> <div class='sesactm'>".$session_rc_date." &nbsp; &nbsp;".$attend_tm." </div> </div>
                        </div>
                        </a>
                        ";
                }
                if($stat==4){ // to show cancelled sessions ..
                    echo"
                        <a href='rebooking.php?regular_rec&rebooking&casid=".$case_id."&sesid=".$ses_id."'>
                        <div class='sessioncancell'>
                            <div class='sesrow'>".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm']."</div>
                            <div class='sesrow1'>
                                <div class='sesno'>".$sesnum."</div><div class='sestype'>".$serv_name." (".$srv_cd.")</div><div class='sestime'>".$session_date." &nbsp; 	&nbsp; ".$start_time." - ".$end_time."</div>
                            </div>
                            <div class='sesrow1'><div class='sestherp'>Therapist: ".$thrp_nm['frst_nm']."  ".$thrp_nm['lst_nm']."</div><div class='sesmodr' title='".$save_time."'>Modifier: ".$mod_nm['frst_nm']."  ".$mod_nm['lst_nm']."</div></div>
                            <div class='sesrow'><div class='sessct'>Cancelled</div></div>
                        </div>
                        </a>
                        ";
                }
                if($stat==9){ // to show Cancelled re-booked session sessions ..
                    echo"
                        <a href='rebooking.php?regular_rec&rebooking&casid=".$case_id."&sesid=".$ses_id."'>
                        <div class='session'>
                            <div class='sesrow'>".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm']."</div>
                            <div class='sesrow1'>
                                <div class='sesno'>".$sesnum."</div><div class='sestype'>".$serv_name." (".$srv_cd.")</div><div class='sestime'>".$session_date." &nbsp; 	&nbsp; ".$start_time." - ".$end_time."</div>
                            </div>
                            <div class='sesrow1'><div class='sestherp'>Therapist: ".$thrp_nm['frst_nm']."  ".$thrp_nm['lst_nm']."</div><div class='sesmodr' title='".$save_time."'>Modifier: ".$mod_nm['frst_nm']."  ".$mod_nm['lst_nm']."</div></div>
                            <div class='sesrow'><div class='sessct'>Cancelled re-booked session</div></div>
                        </div>
                        </a>
                        ";
                }
                $sesnum++;
        }
	}// while
    

}// function




function ses_data($cn,$ses_id){
	$ses_id=(int)$ses_id;
	$query="SELECT * FROM `ses` WHERE `ses_id`=$ses_id";
	$run=mysqli_query($cn,$query);
	return mysqli_fetch_assoc($run);
}


function therapist_list_op($cn,$thrp_id){
	$query="SELECT * FROM `users` WHERE `prv`=1 OR `prv`=2 or `prv`=4 ORDER BY `frst_nm`";
	$run=mysqli_query($cn,$query);
	echo"<option value='0'> </option>";
	while($thrp_op=mysqli_fetch_assoc($run)){
		echo "<option value='".$thrp_op['usr_id']."'";
		if($thrp_id==$thrp_op['usr_id']){
			echo"selected";
		}
		echo ">".$thrp_op['frst_nm']." ".$thrp_op['scnd_nm']." ".$thrp_op['lst_nm']."</option>";		
	}
}


function ses_stat_op($cn, $stat_id){
	$query="SELECT * FROM `ses_stat`";
	$run=mysqli_query($cn,$query);
	echo"<option disabled selected value value=''> </option>";
	while($stat_op=mysqli_fetch_assoc($run)){
		echo "<option value='".$stat_op['stat_id']."'";
		if($stat_id==$stat_op['stat_id']){
			echo"selected";
		}
		echo ">".$stat_op['stat_nm']." </option>";		
	}

}

function nonadmin_ses_stat_op($cn, $stat_id){
	$query="SELECT * FROM `ses_stat` where stat_id=0 /*waiting*/ or stat_id=2 /*excused*/ or stat_id=4 /*Cancelled*/ or stat_id=7 /*Excused re-book*/ or stat_id=9 /*Cancelled re-book*/";
	$run=mysqli_query($cn,$query);
	echo"<option disabled selected value value=''> </option>";
	while($stat_op=mysqli_fetch_assoc($run)){
		echo "<option value='".$stat_op['stat_id']."'";
		if($stat_id==$stat_op['stat_id']){
			echo"selected";
		}
		echo ">".$stat_op['stat_nm']." </option>";		
	}

}


function reg_rec_ses_stat_op($cn, $stat_id){

    if($stat_id==0 || $stat_id==1 || $stat_id==2 || $stat_id==3 || $stat_id==4){ /* waiting */
        $ses_stat_array= array(0,1,2,3,4);
    }elseif($stat_id==5 || $stat_id==6 || $stat_id==7 || $stat_id==8 || $stat_id==9 ){
        $ses_stat_array= array(5,6,7,8,9);
    }

	$query_part1="SELECT stat_id, stat_nm FROM `ses_stat` 
              where ";
    $query_part2="stat_id=".implode(" or stat_id=",$ses_stat_array);
    $query=$query_part1." ".$query_part2;
	$run=mysqli_query($cn,$query);
	echo"<option disabled selected value value=''> </option>";
	while($stat_op=mysqli_fetch_assoc($run)){
		echo "<option value='".$stat_op['stat_id']."'";
		if($stat_id==$stat_op['stat_id']){
			echo"selected";
		}
		echo ">".$stat_op['stat_nm']." </option>";		
	}

}

function rebooking_rec_ses_stat_op($cn, $stat_id){
	$query="SELECT stat_id, stat_nm FROM `ses_stat` where stat_id=2 or  stat_id=5 ";
	$run=mysqli_query($cn,$query);
	echo"<option disabled selected value value=''> </option>";
	while($stat_op=mysqli_fetch_assoc($run)){
		echo "<option value='".$stat_op['stat_id']."'";
		if($stat_id==$stat_op['stat_id']){
			echo"selected";
		}
		echo ">".$stat_op['stat_nm']." </option>";		
	}

}




function session_type($cn,$srv_cd){
	$query="SELECT * FROM `services`";
	$run=mysqli_query($cn,$query);
	echo"<option disabled selected value value=''> </option>";
	while($ses_type=mysqli_fetch_assoc($run)){
		echo "<option value='".$ses_type['srv_cd']."'";
		if($srv_cd===$ses_type['srv_cd']){
			echo"selected";
		}
		echo ">".$ses_type['srv_nm']." (".$ses_type['srv_cd'].") </option>";		
	}
}


function update_session($cn,$register_data, $ses_id){
	$fields=array_keys($register_data);
	$data=$register_data;
	
	$clumndata= join(', ', array_map(
		function ($fields, $data) { return "$fields = '$data'"; },
		$fields,
		$data
    ));
		$query1="UPDATE `ses` SET ".$clumndata." WHERE `ses_id`=$ses_id";
		mysqli_query($cn, $query1);
    
        $fields1 =' `'.implode('` , `', array_keys($register_data)).'`';
        $data1 = ' \''.implode('\' , \'',$register_data).'\'';    
        $query2= "INSERT INTO `ses_hist` ($fields1) VALUES ($data1)";
		mysqli_query($cn, $query2);
}


function all_cas_names_op($cn){
    $query = "SELECT * FROM `users` WHERE `usr_catg`=7  ORDER BY `frst_nm`, `scnd_nm`, `thrd_nm`, `lst_nm` ASC";
    $run = mysqli_query($cn, $query);
    echo"
        <option></option>
    ";
    while ($data= mysqli_fetch_assoc($run)){
        
        echo "
            <option value='".$data['usr_id']."'>".$data['frst_nm']." ".$data['scnd_nm']." ".$data['thrd_nm']." ".$data['lst_nm']."</option>
        ";
    }
}

function add_session($cn,$register_data,$user_id){
	$fields=array_keys($register_data);
	$data=$register_data;
        $fields1 =' `'.implode('` , `', array_keys($register_data)).'`';
        $data1 = ' \''.implode('\' , \'',$register_data).'\'';
        $query2= "INSERT INTO `ses` ($fields1) VALUES ($data1)";
        mysqli_query($cn, $query2);
        $query3= "INSERT INTO `ses_hist` ($fields1) VALUES ($data1)";
		mysqli_query($cn, $query3);
    
        $cas_id = $register_data['cas_id'];
        $srv_cd = $register_data['srv_cd'];
        $ses_day = $register_data['ses_day'];
            
        $nm=get_fullname_from_user_id($cn,$cas_id);
        $sb=get_fullname_from_user_id($cn,$user_id);
    
        mail("dregpt@gmail.com, Dr.Ramykasem88@hotmail.com","A new session is added", "A ".$srv_cd." session of (".$ses_day.") for the case (".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm'].") is added by ".$sb['frst_nm']." ".$sb['lst_nm'].".");
}

function delete_session($cn,$ses_id,$user_id){
    
    $q="SELECT `cas_id`, `srv_cd`, `ses_day`, `submitter` FROM `ses` WHERE `ses_id`=$ses_id";
    $r=mysqli_query($cn, $q);
    while($d=mysqli_fetch_assoc($r)){
        $srv_cd=$d['srv_cd'];
        $ses_day=$d['ses_day'];
        $cas_id=$d['cas_id'];
    }
    
    $query="DELETE FROM `ses` WHERE `ses_id`= $ses_id";
    mysqli_query($cn,$query);
    
        $nm=get_fullname_from_user_id($cn,$cas_id);
        $sb=get_fullname_from_user_id($cn,$user_id);
    
        mail("dregpt@gmail.com, Dr.Ramykasem88@hotmail.com","A session is deleted!", "A ".$srv_cd." session of (".$ses_day.") for the case (".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm'].") is deleted by ".$sb['frst_nm']." ".$sb['lst_nm'].".");
    
}


function number_of_all_day_ses($cn,$ses_day){

	$query = "SELECT * FROM `ses`	 WHERE `ses_day`='$ses_day'";
	$data =mysqli_query($cn,$query);
	echo mysqli_num_rows($data);
}

function number_of_day_taken_ses($cn,$ses_day){

	$query = "SELECT * FROM `ses`	 WHERE `ses_day`='$ses_day' AND (`stat`=1 OR `stat`=6)";
	$data =mysqli_query($cn,$query);
	echo mysqli_num_rows($data); //number_of_all_ses($cn);
}

function number_of_day_excused_ses($cn,$ses_day){

	$query = "SELECT * FROM `ses`	 WHERE `ses_day`='$ses_day' AND (`stat`=2 OR `stat`=7)";
	$data =mysqli_query($cn,$query);
    
    $x=0;
    while($d=mysqli_fetch_assoc($data)){
            $x++;
    }
	echo $x;
}

function number_of_today_absence_ses($cn,$ses_day){
	$query = "SELECT * FROM `ses`	 WHERE `ses_day`='$ses_day' AND (`stat`=3 OR `stat`=8)";
	$data =mysqli_query($cn,$query);
	echo mysqli_num_rows($data);
}

function number_of_day_cancelled_ses($cn,$ses_day){

	$query = "SELECT * FROM `ses`	 WHERE `ses_day`='$ses_day' AND (`stat`=4 OR `stat`=9)";
	$data =mysqli_query($cn,$query);
	echo mysqli_num_rows($data);
}

function number_of_day_waiting_ses($cn,$ses_day){

	$query = "SELECT * FROM `ses`	 WHERE `ses_day`='$ses_day' AND (`stat`=0 OR `stat`=5)";
	$data =mysqli_query($cn,$query);
	echo mysqli_num_rows($data);
}





function session_stat($stat){
    
    if($stat==0){
        return "Waiting";
    }elseif($stat==1){
        return "Taken";
    }elseif($stat==2){
        return "Excused";
    }elseif($stat==3){
        return "Abcence";
    }elseif($stat==4){
        return"Cancelled";
    }elseif($stat==5){
        return"Re-booked waiting";
    }elseif($stat==6){
        return "Taken re-booked";
    }elseif($stat==7){
        return"Excused re-booked";
    }elseif($stat==8){
        return"Absence re-booked";
    }elseif($stat==9){
        return"Cancelled re-booked";
    }
    
}


function is_case_has_sessions_for_cur_month($cn,$cas_id)
{
    $query = "select ses_day from ses where cas_id=$cas_id";
    $run = mysqli_query($cn, $query);
    $x = 0;
    while ($d = mysqli_fetch_assoc($run)) {

        $ses_month = substr($d['ses_day'], 0, 7);;
        $cur_month = date("Y-m", time());
        if ($cur_month === $ses_month) {
            $x++;
        }
    }
    if ($x > 0) {
        return true;
    } else {
        return false;
    }
}

function is_case_has_sessions_for_month($cn,$cas_id,$month){
    $query = "select ses_id from ses where cas_id=$cas_id and substring(ses_day,1,7)='$month'";
    $run = mysqli_query($cn, $query);
    while($d=mysqli_fetch_array($run)){
        if(!empty($d[0])){
            return true;
        }else{
            return false;
        }
    }
}

function is_case_active_in_months($cn,$cas_id,$range=3){
    $x=0;
    while($x<$range){
       $month=date("Y-m", strtotime("first day of -".$x." month"));

        $query = "select distinct(substring(ses_day,1,7)) from ses where substring(ses_day,1,7)='$month' and cas_id=$cas_id";
        $run=mysqli_query($cn,$query);
        while($d=mysqli_fetch_array($run)){
                $result[]= $d[0]."<br>";
        }
        $x++;

    }
    if(isset($result) || is_case_has_sessions_for_cur_month($cn,$cas_id)===true){
        return true;
    }else{
        return false;
    }
}





function get_ses_price($cn,$cas_id,$srv_cd, $price_stat){
        $query2="select ".$srv_cd."_rglr_price , ".$srv_cd."_sngl_price from seset where case_id=$cas_id";
        $run2=mysqli_query($cn,$query2);
        while($d2=mysqli_fetch_assoc($run2)){
            
            if($price_stat==1){
                return $rglr_price=$d2[$srv_cd."_rglr_price"];
            }elseif($price_stat==0){
                return $sngl_price=$d2[$srv_cd."_sngl_price"];  
            }
        }
}

function get_ses_fine($cn,$srv_cd,$fine_stat){
       $query2="select excuse_fn , absence_fn from services where srv_cd='$srv_cd'";
        $run2=mysqli_query($cn,$query2);
        while($d2=mysqli_fetch_assoc($run2)){
            
            if($fine_stat==1){
                return $exc_fine=$d2["excuse_fn"];
            }elseif($fine_stat==0){
                return $abs_fine=$d2["absence_fn"];  
            }
        }
}


function num_month_ses($cn,$stat,$month){
    $run=mysqli_query($cn,"select count(distinct(ses_id)) from ses where stat=$stat and substr(ses_day,1,7)='$month'");
    while($d=mysqli_fetch_array($run)){
        return $d[0];
    }
}


function number_of_month_sessions($cn, $month){
     $run=mysqli_query($cn, "select count(ses_id) from ses where substring(ses_day,1,7)='$month'");
    while($d=mysqli_fetch_array($run)){
        return $d[0];
    }
}


function num_day_services($cn,$ses_day){ // return array of all services numbers in certain day
    $services=array();
    $run=mysqli_query($cn,"select distinct(srv_cd) from ses where ses_day='$ses_day'");
    while($d=mysqli_fetch_assoc($run)){
       $run1=mysqli_query($cn,"select count(srv_cd) from ses where ses_day='$ses_day' and srv_cd='".$d['srv_cd']."'");
       while($d1=mysqli_fetch_array($run1)){
           $services[$d['srv_cd']]=$d1[0];
       }
    }
    return $services;
}


function num_month_services($cn,$month){ // return array of all services numbers in certain day
    $services=array();
    $run=mysqli_query($cn,"select distinct(srv_cd) from ses where substring(ses_day,1,7)='$month' ");
    while($d=mysqli_fetch_assoc($run)){
        $run1=mysqli_query($cn,"select count(srv_cd) from ses where substring(ses_day,1,7)='$month' and srv_cd='".$d['srv_cd']."'");
        while($d1=mysqli_fetch_array($run1)){
            $services[$d['srv_cd']]=$d1[0];
        }
    }
    return $services;
}





function month_thrp_worked_ses_data($cn,$usr_id,$month){
    $query="select ses_day , cas_id,  srv_cd, ses_rc_strt, ses_rc_end, stat from ses where thrp_id=$usr_id and substring(ses_day,1,7)='$month' and (stat=1 or stat=6)
               order by UNIX_TIMESTAMP(concat(ses_day,' ',ses_rc_strt))";
    $rn= mysqli_query($cn,$query);
    $s=1;
    while($d=mysqli_fetch_assoc($rn)){
        $ses_date=date("D - d/m/Y",strtotime($d['ses_day']));
        $nm=get_fullname_from_user_id($cn,$d['cas_id']);
        $s++;
        $session_duration= (strtotime($d['ses_rc_end']) - strtotime($d['ses_rc_strt']))/60;
        $srv_duration=serv_duration($cn,$d['srv_cd']);
        echo"                      <tr>
                                        <td class='datalt'>{$s}</td>
                                        <td class='datalt'>{$ses_date}</td>
                                        <td class='datalt'>{$nm['frst_nm']} {$nm['scnd_nm']} {$nm['lst_nm']} </td>
                                        <td class='data'>{$d['srv_cd']}</td>
                                        <td class='datalt'>{$session_duration}/{$srv_duration}</td>
                                   </tr>
        ";
    }
}

function has_worked_ses_after($cn,$usr_id, $ses_day, $ses_rf_tm){
    $ses_rf_tm=strtotime($ses_rf_tm);
    $q="select ses_rf_tm from ses where ses_day='$ses_day' and thrp_id=$usr_id and (stat=1 or stat=6)";
    $rn=mysqli_query($cn, $q);
    while($d=mysqli_fetch_assoc($rn)){
        $this_ses_rf_tm=strtotime($d['ses_rf_tm']);
        if($this_ses_rf_tm>$ses_rf_tm){
            return true;
        }else{
            return false;
        }
    }
}



function month_thrp_inbtwn_excs_data($cn,$usr_id,$month){
    $query="select ses_day , cas_id,  srv_cd, ses_rf_tm, ses_rc_strt, ses_rc_end, stat from ses where thrp_id=$usr_id and substring(ses_day,1,7)='$month' 
                and (stat=2 or stat=3 or stat=7 or stat=8)
               order by UNIX_TIMESTAMP(concat(ses_day,' ',ses_rc_strt))";
    $rn= mysqli_query($cn,$query);
    $s=1;
    while($d=mysqli_fetch_assoc($rn)){
        $ses_date=date("d/m/Y",strtotime($d['ses_day']));
        $nm=get_fullname_from_user_id($cn,$d['cas_id']);
        $s++;
        $ses_day=$d['ses_day'];
        $ses_rf_tm= $d['ses_rf_tm'];
        $session_stat=session_stat($d['stat']);
        if(has_worked_ses_after($cn,$usr_id, $ses_day, $ses_rf_tm)===true){
            echo"                      <tr>
                                        <td class='datalt'>{$s}</td>
                                        <td class='datalt'>{$ses_date}</td>
                                        <td class='datalt'>{$nm['frst_nm']} {$nm['scnd_nm']} {$nm['lst_nm']} </td>
                                        <td class='data'>{$d['srv_cd']}</td>
                                        <td class='datalt'>{$session_stat}</td>
                                   </tr>
        ";
        }
    }
}


function thrp_worked_ses_number($cn, $usr_id, $month){
    $q="select count(ses_id) from ses where thrp_id=$usr_id and substring(ses_day,1,7)='$month' and (stat=1 or stat=6)";
    $rn=mysqli_query($cn,$q);
    $d=mysqli_fetch_array($rn);
    $d1=$d[0];
    $q2="select ses_day, ses_rf_tm from ses where thrp_id=$usr_id and substring(ses_day,1,7)='$month' and (stat=2 or stat=3 or stat=7 or stat=8)";
    $rn2=mysqli_query($cn,$q2);
    $d2=0;
    while($data=mysqli_fetch_assoc($rn2)){
        $ses_day=$data['ses_day'];
        $ses_rf_tm= $data['ses_rf_tm'];
        if(has_worked_ses_after($cn,$usr_id, $ses_day, $ses_rf_tm)===true) {
            $d2++;
        }
    }
    $number= $d1+($d2/2);
    return $number;
}


function thrp_hours($cn, $usr_id, $month){
    $q="select srv_cd from ses where thrp_id=$usr_id and substring(ses_day,1,7)='$month' and (stat=1 or stat=6)";
    $rn=mysqli_query($cn,$q);
    $worked_hours=0;
    while($d=mysqli_fetch_assoc($rn)){
        $worked_hours+=serv_duration($cn,$d['srv_cd']);
    }

    $q2="select srv_cd, ses_day, ses_rf_tm from ses where thrp_id=$usr_id and substring(ses_day,1,7)='$month' and (stat=2 or stat=3 or stat=7 or stat=8)";
    $rn2=mysqli_query($cn,$q2);
    $waiting_hours=0;
    while($data=mysqli_fetch_assoc($rn2)){
        $ses_day=$data['ses_day'];
        $ses_rf_tm= $data['ses_rf_tm'];
        if(has_worked_ses_after($cn,$usr_id, $ses_day, $ses_rf_tm)===true) {
            $waiting_hours+=serv_duration($cn,$data['srv_cd']);
        }
    }
    $hours= ($worked_hours/60)+(($waiting_hours/60)/2);
    return $hours;
}

function thrp_worked_hours($cn, $usr_id, $month){
    $q="select srv_cd from ses where thrp_id=$usr_id and substring(ses_day,1,7)='$month' and (stat=1 or stat=6)";
    $rn=mysqli_query($cn,$q);
    $worked_hours=0;
    while($d=mysqli_fetch_assoc($rn)){
        $worked_hours+=serv_duration($cn,$d['srv_cd']);
    }
    return $worked_hours/60;
}

function thrp_inbtwn_hours($cn, $usr_id, $month){
    $q2="select srv_cd, ses_day, ses_rf_tm from ses where thrp_id=$usr_id and substring(ses_day,1,7)='$month' and (stat=2 or stat=3 or stat=7 or stat=8)";
    $rn2=mysqli_query($cn,$q2);
    $waiting_hours=0;
    while($data=mysqli_fetch_assoc($rn2)){
        $ses_day=$data['ses_day'];
        $ses_rf_tm= $data['ses_rf_tm'];
        if(has_worked_ses_after($cn,$usr_id, $ses_day, $ses_rf_tm)===true) {
            $waiting_hours+=serv_duration($cn,$data['srv_cd']);
        }
    }
    $hours= ($waiting_hours/60)/2;
    return $hours;
}


function thrp_ses_type_data_number($cn,$usr_id,$month){
    $query1="select srv_cd from services";
    $run1=mysqli_query($cn, $query1);
    while($data=mysqli_fetch_assoc($run1)){
        $srv_cd=$data['srv_cd'];
        $q="select count(ses_id) from ses where thrp_id=$usr_id and substring(ses_day,1,7)='$month' and (stat=1 or stat=6) and srv_cd='$srv_cd'";
        $rn=mysqli_query($cn,$q);
        $d=mysqli_fetch_array($rn);
        $d1=$d[0];
        if($d1>0){
            echo"
                                <tr>
                                    <th class='sideh'>{$srv_cd} sessions</td>
                                    <td class='data'>{$d1}</td>
                                </tr>
            ";
        }
    }
}























?>