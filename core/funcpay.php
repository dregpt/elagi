<?php




function add_payment($cn,$register_data,$user_data){
	$fields=array_keys($register_data);
	$data=$register_data;
        $fields1 =' `'.implode('` , `', array_keys($register_data)).'`';
        $data1 = ' \''.implode('\' , \'',$register_data).'\'';
        $query2= "INSERT INTO `pay` ($fields1) VALUES ($data1)";
      
    mysqli_query($cn, $query2);
        
        $nm=get_fullname_from_user_id($cn,$register_data['cas_id']);
        $snm=get_fullname_from_user_id($cn,$user_data['usr_id']);
        $rnm=get_fullname_from_user_id($cn,$register_data['rcvd_by']);
   $month=$register_data['month'];
    
    $notif="A payment of (".$month.") of (".$register_data['amount']." LE) for 
    the case (".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm'].") 
    has been successfuly added by ".$snm['frst_nm']." ".$snm['lst_nm']." and received by 
    Dr.".$rnm['frst_nm']." ".$rnm['lst_nm'].".";
    
        mail("dregpt@gmail.com, Dr.Ramykasem88@hotmail.com","New payment!",$notif );
}


function today_payments($cn){
    $today=date("Y-m-d",time());
    $query="SELECT * FROM `pay`";
    $data= mysqli_query($cn,$query);
    while($row=mysqli_fetch_assoc($data)){
        $cas_id= $row['cas_id'];
        $nm=get_fullname_from_user_id($cn,$cas_id);
        $details= $row['details'];
        $amount= $row['amount'];
        $pay_id=$row['pay_id'];
        $rcvd_id= $row['rcvd_by'];
        $submitter_id= $row['submitter'];
        $rnm=get_name_from_user_id($cn,$rcvd_id);
        $mnm=get_name_from_user_id($cn,$submitter_id);
        $row['submit_timestamp'];
        $pay_day=date("Y-m-d", $row['submit_timestamp']);
        
        if($pay_day===$today){
				echo"
					<div class='session' >
                        <div class='topsesrow'>
                            <a class='deleteicon' onClick=\"return confirm('Are you sure you want to delete this payment?')\" href='cont.php?delete_pay=".$pay_id."' ><img src='img/icons/bin-2.png' class='icon' style='' title='Delete payment'></a>                        </div>
                        <div class='sesrow'>
                            <div>".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm']." </div>
                        </div>
						<div class='sesrow1'>
							<spam style='display:inline-block;'>Amount:</spam> <div class='amount'>".$amount."</div> L.E.
						</div>
						<div class='sesrow1'> <div class='note'>".$details."</div> </div>
                        <div class='sesrow1'>Modifier: ".$mnm['frst_nm']." ".$mnm['lst_nm']."</div>
						<div class='sesrow'>Recieved by: Dr.".$rnm['frst_nm']." ".$rnm['lst_nm']."</div>
					</div>
					";
       }
    }
}

function today_expenses($cn,$args){

    foreach ($args as $keys => $values) {
        $outlay_id = $args[$keys]->outlay_id;
        $amount = $args[$keys]->amount;
        $details = $args[$keys]->details;
        $outlay_id = $args[$keys]->outlay_id;
        $expndd_id = $args[$keys]->expndd_by;
        $submitter_id = $args[$keys]->submitter;
        $rnm = get_name_from_user_id($cn, $expndd_id);
        $mnm = get_name_from_user_id($cn, $submitter_id);
        $expday= date("Y-m-d",$args[$keys]->submit_timestamp);
        $today=date("Y-m-d");
        if($expday===$today) {
            echo "
                            <div class='session' >
                                <div class='topsesrow'>
                                    <a class='deleteicon' onClick=\"return confirm('Are you sure you want to delete this outlay?')\" href='cont.php?delete_outlay=" . $outlay_id . "' ><img src='img/icons/bin-2.png' class='icon' style='' title='Delete outlay'></a>                        </div>
                                <div class='sesrow'>
                                    <spam style='display:inline-block;'>Amount:</spam> <div class='amount'>" . $amount . "</div> L.E.
                                </div>
                                <div class='sesrow1'> <div class='note'>" . $details . "</div> </div>
                                <div class='sesrow1'>Modifier: " . $mnm['frst_nm'] . " " . $mnm['lst_nm'] . "</div>
                                <div class='sesrow'>Expended by: Dr." . $rnm['frst_nm'] . " " . $rnm['lst_nm'] . "</div>
                            </div>
                            ";
        }
    }

}

function today_income($cn,$args){

    foreach ($args as $keys => $values) {
        $amount = $args[$keys]->amount;
        $details = $args[$keys]->details;
        $inc_id = $args[$keys]->inc_id;
        $rcvd_id = $args[$keys]->rcvd_by;
        $submitter_id = $args[$keys]->submitter;
        $rnm = get_name_from_user_id($cn, $rcvd_id);
        $mnm = get_name_from_user_id($cn, $submitter_id);
        $incday= date("Y-m-d",$args[$keys]->submit_timestamp);
        $today=date("Y-m-d");
        if($incday===$today) {
            echo "
                            <div class='session' >
                                <div class='topsesrow'>
                                    <a class='deleteicon' onClick=\"return confirm('Are you sure you want to delete this outlay?')\" href='cont.php?delete_income=" . $inc_id . "' ><img src='img/icons/bin-2.png' class='icon' style='' title='Delete income'></a>                        </div>
                                <div class='sesrow'>
                                    <spam style='display:inline-block;'>Amount:</spam> <div class='amount'>" . $amount . "</div> L.E.
                                </div>
                                <div class='sesrow1'> <div class='note'>" . $details . "</div> </div>
                                <div class='sesrow1'>Modifier: " . $mnm['frst_nm'] . " " . $mnm['lst_nm'] . "</div>
                                <div class='sesrow'>Expended by: Dr." . $rnm['frst_nm'] . " " . $rnm['lst_nm'] . "</div>
                            </div>
                            ";
        }
    }
}

function month_income($cn,$args,$month){

    foreach ($args as $keys => $values) {
        $amount = $args[$keys]->amount;
        $details = $args[$keys]->details;
        $inc_id = $args[$keys]->inc_id;
        $rcvd_id = $args[$keys]->rcvd_by;
        $submitter_id = $args[$keys]->submitter;
        $rnm = get_name_from_user_id($cn, $rcvd_id);
        $mnm = get_name_from_user_id($cn, $submitter_id);
        $incmonth= date("Y-m",$args[$keys]->submit_timestamp);
        if($incmonth===$month) {
            echo "
                            <div class='session' >
                                <div class='topsesrow'>
                                    <a class='deleteicon' onClick=\"return confirm('Are you sure you want to delete this outlay?')\" href='cont.php?delete_income=" . $inc_id . "' ><img src='img/icons/bin-2.png' class='icon' style='' title='Delete income'></a>                        </div>
                                <div class='sesrow'>
                                    <spam style='display:inline-block;'>Amount:</spam> <div class='amount'>" . $amount . "</div> L.E.
                                </div>
                                <div class='sesrow1'> <div class='note'>" . $details . "</div> </div>
                                <div class='sesrow1'>Modifier: " . $mnm['frst_nm'] . " " . $mnm['lst_nm'] . "</div>
                                <div class='sesrow'>Recieved by: Dr." . $rnm['frst_nm'] . " " . $rnm['lst_nm'] . "</div>
                            </div>
                            ";
        }
    }
}




function delete_payment($cn,$pay_id,$user_data){
    $q="SELECT `cas_id`,`amount`, `month` FROM `pay` WHERE `pay_id`= $pay_id";
    $r= mysqli_query($cn, $q);
    while($d=mysqli_fetch_assoc($r)){
        $usr_id=$d['cas_id'];
        $amount= $d['amount'];
        $mnth= $d['month'];
        
    }
    
    
    $query="DELETE FROM `pay` WHERE `pay_id`=$pay_id";
    mysqli_query($cn,$query);
        $snm=get_fullname_from_user_id($cn,$user_data['usr_id']);
        $rnm=get_fullname_from_user_id($cn,$d['rcvd_by']);
        $nm=get_fullname_from_user_id($cn,$usr_id);
    
        $notif="A payment of (".$mnth.") of (".$amount.") LE for the case (".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm'].") is deleted by ".$snm['frst_nm']." ".$snm['lst_nm'].".";
    
        mail("dregpt@gmail.com, Dr.Ramykasem88@hotmail.com","A payment is deleted!", $notif);
}


function  cas_month_pay($cn,$cas_id,$month){
    
    $query="SELECT * FROM `pay` WHERE `cas_id`=$cas_id  AND `month`='$month'";
    $data= mysqli_query($cn, $query);
    $s=0;
    while($row=mysqli_fetch_assoc($data)){
        
        $s++;
        $pay_date= date("Y-m-d", $row['submit_timestamp']);
        $amount= $row['amount'];
        
        echo"
                            <tr>
                                <th >".$s."</th>
                                <th>".$pay_date."</th>
                                <td class='data'>".$amount."</td>
                            </tr>
            ";
    }
}

function sum_cas_month_pay($cn,$cas_id,$month){
   $query="SELECT sum(`amount`) FROM `pay` WHERE `cas_id`=$cas_id  AND `month`='$month'";
    $data= mysqli_query($cn, $query);
    $row= mysqli_fetch_row($data);
    return $result=$row[0];
}

function cas_month_sessions($cn,$cas_id,$month){
   $query="SELECT * FROM `ses` WHERE `cas_id`=$cas_id ORDER BY `ses_day`";
    $data= mysqli_query($cn, $query);
   $s=0;    
    
    while($row=mysqli_fetch_assoc($data)){

        
        $ses_date= date("D - d/m/Y",strtotime($row['ses_day']));
        $srv_cd = $row['srv_cd'];
        $price_stat=$row['price_stat'];
        $session_stat=session_stat($row['stat']);
        $ses_month=substr($row['ses_day'],0,7);
        if($ses_month===$month){
            $s++;
            echo"
                                <div class='datatr'>
                                    <div class='datatd'>".$s."</div>
                                    <div class='datatd'>".$ses_date."</div>
                                    <div class='datatd'>".$srv_cd."</div>";
            if($price_stat==1){
                echo" <div class='datatd bluefont'>Regular</div>";
                echo"<div class='datatd greenfont'>{$row['rglr_price']}</div>";
            }elseif($price_stat==0){
                echo"<div class='datatd greenfont'>Single</div>";
                echo"<div class='datatd greenfont'>{$row['sngl_price']}</div>";
            }


            if($row['stat']==0){
                echo" <div class='datatd'>".$session_stat."</div>";
                //echo" <div class='datatd'></div>";
            }elseif($row['stat']==1){
                echo" <div class='datatd bluefont'>".$session_stat."</div>";
                //echo" <div class='datatd bluefont'></div>";
            }elseif($row['stat']==2){
                echo" <div class='datatd darkredfont'>".$session_stat."</div>";
                echo"<div class='datatd darkredfont'>{$row['exc_fine']}</div>";
            }elseif($row['stat']==3){
                echo" <div class='datatd darkorangefont'>".$session_stat."</div>";
                echo"<div class='datatd darkorangefont'>{$row['abs_fine']}</div>";
            }elseif($row['stat']==4){
                echo" <div class='datatd greenfont'>".$session_stat."</div>";
                //echo" <div class='datatd greenfont'></div>";
            }elseif($row['stat']==5){
                echo" <div class='datatd'>".$session_stat."</div>";
            }elseif($row['stat']==6){
                echo" <div class='datatd bluefont'>".$session_stat."</div>";
                //echo" <div class='datatd bluefont'></div>";
            }elseif($row['stat']==7){
                echo" <div class='datatd darkredfont'>".$session_stat."</div>";
                echo"<div class='datatd darkredfont'>{$row['exc_fine']}</div>";
            }elseif($row['stat']==8){
                echo" <div class='datatd darkorangefont'>".$session_stat."</div>";
                echo"<div class='datatd darkorangefont'>{$row['abs_fine']}</div>";
            }elseif($row['stat']==9){
                echo" <div class='datatd greenfont'>".$session_stat."</div>";
                //echo" <div class='datatd greenfont'></div>";
            }

            
            echo"                    </div> ";
        }

    }
    
}

function cas_month_excuses($cn,$month){
   $query="SELECT * FROM `ses` WHERE stat= 2 /*excused */ OR stat=4 /*cancelled */or  stat=7 /*excused rebook */or  stat=9 /*cancelled rebook */ ORDER BY `ses_day`, `cas_id` ";
    $data= mysqli_query($cn, $query);
   $s=0;    
    
    while($row=mysqli_fetch_assoc($data)){

        
        $ses_date= date("D - d/m/Y",strtotime($row['ses_day']));
        $srv_cd = $row['srv_cd'];
        $ses_month=substr($row['ses_day'],0,7);
        $cas_id=$row['cas_id'];
        $nm=get_fullname_from_user_id($cn,$cas_id);
        if($ses_month===$month){
            $s++;
            echo"
                                <div class='exabstr'>
                                    <div class='datatd'>".$s."</div>
                                    <div class='datatd'>".$ses_date."</div>
                                    <div class='datatd'>".$srv_cd."</div>
                                    <div class='datatd'>".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['lst_nm']."</div>            
                                </div> 
                ";
        }

    }
    
}

function cas_month_absences($cn,$month){
   $query="SELECT * FROM `ses` WHERE stat= 3 ORDER BY `ses_day`, `cas_id`";
    $data= mysqli_query($cn, $query);
   $s=0;    
    
    while($row=mysqli_fetch_assoc($data)){

        
        $ses_date= date("D - d/m/Y",strtotime($row['ses_day']));
        $srv_cd = $row['srv_cd'];
        $ses_month=substr($row['ses_day'],0,7);
        $cas_id=$row['cas_id'];
        $nm=get_fullname_from_user_id($cn,$cas_id);
        if($ses_month===$month){
            $s++;
            echo"
                                <div class='exabstr'>
                                    <div class='datatd'>".$s."</div>
                                    <div class='datatd'>".$ses_date."</div>
                                    <div class='datatd'>".$srv_cd."</div>
                                    <div class='datatd'>".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['lst_nm']."</div>            
                                </div> 
                ";
        }

    }
    
}



function total_sessions($cn,$cas_id,$month,$srv_cd,$stat){ // Returns total month number of sessions according to its type and status
    $query="SELECT `ses_id`,`ses_day` FROM `ses` WHERE `cas_id`=$cas_id AND `srv_cd`='$srv_cd' AND `stat`=$stat";  
    $rows=0;
    $data =mysqli_query($cn,$query);
    
    while($rw=mysqli_fetch_assoc($data)){
        $monthdb=date("Y-m",strtotime($rw['ses_day']));
        if($monthdb===$month){
           $rows++;
        }
    }
    return $rows;

}

function overall_total_sessions($cn,$cas_id,$month,$srv_cd){
    $query="SELECT `ses_id`,`ses_day` FROM `ses` WHERE `cas_id`=$cas_id AND `srv_cd`='$srv_cd'";  
    $rows=0;
    $data =mysqli_query($cn,$query);
    
    while($rw=mysqli_fetch_assoc($data)){
        $monthdb=date("Y-m",strtotime($rw['ses_day']));
        if($monthdb===$month){
           $rows++;
        }
    }
    return $rows;
}


function case_ses_total_stat($cn,$cas_id,$month){
    
        $query="SELECT `srv_cd`,`srv_nm` FROM `services`";
        $run=mysqli_query($cn, $query);
        $nxt_month=date("Y-m",strtotime("+1 month",strtotime($month)));
        echo"<tbody >";
        while($srv=mysqli_fetch_assoc($run)){
            $srv_nm=$srv['srv_nm'];
            $srv_cd=$srv['srv_cd'];

            $all_sessions= total_sessions($cn,$cas_id,$month,$srv_cd,1)
                        +total_sessions($cn,$cas_id,$month,$srv_cd,2)
                        +total_sessions($cn,$cas_id,$month,$srv_cd,3)
                        +total_sessions($cn,$cas_id,$month,$srv_cd,4)
                        +total_sessions($cn,$cas_id,$month,$srv_cd,5)
                        +total_sessions($cn,$cas_id,$month,$srv_cd,6)
                        +total_sessions($cn,$cas_id,$month,$srv_cd,7)
                        +total_sessions($cn,$cas_id,$month,$srv_cd,8)
                        +total_sessions($cn,$cas_id,$month,$srv_cd,9)
                        +total_sessions($cn,$cas_id,$month,$srv_cd,0);
            $taken= total_sessions($cn,$cas_id,$month,$srv_cd,1);
            $rebooked= total_sessions($cn,$cas_id,$month,$srv_cd,6);
            $excuses= total_sessions($cn,$cas_id,$month,$srv_cd,2)+total_sessions($cn,$cas_id,$month,$srv_cd,7);
            $absence= total_sessions($cn,$cas_id,$month,$srv_cd,3)+total_sessions($cn,$cas_id,$month,$srv_cd,8);
            $cancelled= total_sessions($cn,$cas_id,$month,$srv_cd,4)+total_sessions($cn,$cas_id,$month,$srv_cd,9);

            $all_nxt_month_sessions=overall_total_sessions($cn,$cas_id,$nxt_month,$srv_cd);

            if($all_sessions==0){$all_sessions="-";}
            if($taken==0){$taken="-";}
            if($rebooked==0){$rebooked="-";}
            if($excuses==0){$excuses="-";}
            if($absence==0){$absence="-";}
            if($cancelled==0){$cancelled="-";}
            if($all_nxt_month_sessions==0){$all_nxt_month_sessions="-";}
            if($all_sessions>0 || $taken>0 || $rebooked>0 || $excuses>0 || $absence>0 || $cancelled>0 || $all_nxt_month_sessions>0) {
                echo "                           
                            <tr >
                                <th class='sideh'  title='" . $srv_nm . "'>" . $srv_nm . " (" . $srv_cd . ")</th>
                                <td class='data'  title='Number of " . $srv_nm . " booked sessions'>" . $all_sessions . "</td>
                                <td  class='data'  title='Number of " . $srv_nm . " taken sessions'>" . $taken . "</td>
                                <td  class='data'  title='Number of " . $srv_nm . " re-booked taken sessions'>" . $rebooked . "</td>
                                <td  class='data'  title='Number of " . $srv_nm . " excused sessions'>" . $excuses . "</td>
                                <td  class='data'  title='Number of " . $srv_nm . " absence sessions'>" . $absence . "</td>
                                <td  class='data'  title='Number of " . $srv_nm . " cancelled sessions'>" . $cancelled . "</td>
                                <td  class='data'  title='Number of " . $srv_nm . " next month booked sessions'>" . $all_nxt_month_sessions . "</td>
                            </tr>
                            ";
            }
        }

    echo"</tbody>";

}

//function total_ses_cost($cn,$cas_id,$stat,$month){
// // sum  services * case regular price
//       $query="SELECT `srv_cd` FROM `services`";
//        $run=mysqli_query($cn, $query);
//        $total=0;
//        while($srv=mysqli_fetch_assoc($run)){
//            $srv_cd=$srv['srv_cd'];
//
//            $query2="SELECT `".$srv_cd."_rglr_price` FROM `seset` WHERE `case_id`=$cas_id";
//            $run2=mysqli_query($cn,$query2);
//
//            while($pr=mysqli_fetch_assoc($run2)){
//                $srv_rglr_pr= $pr[$srv_cd."_rglr_price"];
//                $ses_cost=total_sessions($cn,$cas_id,$month,$srv_cd,$stat);
//                $add=$srv_rglr_pr*$ses_cost;
//                $total= $total+$add;
//            }
//        }
//        return $total;
//}

function total_ses_cost($cn,$cas_id,$stat,$month){
    // sum  services * case regular price
    $query="SELECT `srv_cd` FROM `services`";
    $run=mysqli_query($cn, $query);
    while($srv=mysqli_fetch_assoc($run)){
        $srv_cd=$srv['srv_cd'];
        $query1= "select stat, price_stat, rglr_price, sngl_price ,exc_fine, abs_fine from ses 
                where cas_id=$cas_id and srv_cd='$srv_cd' and substring(ses_day,1,7)='$month' and stat= $stat";
        $run1=mysqli_query($cn,$query1);
        while($d=mysqli_fetch_assoc($run1)){
            if($d['price_stat']==1 ){
                if($d['stat']==1 || $d['stat']==6 || $d['stat']==0 || $d['stat']==5) {
                    $costs[] = $d['rglr_price'];
                }
                if($d['stat']==2 || $d['stat']==7 ) {
                    $costs[] = $d['exc_fine'];
                }
                if($d['stat']==3 || $d['stat']==8){
                    $costs[] = $d['abs_fine'];
                }
            }elseif($d['price_stat']==0){
                if($d['stat']==1 || $d['stat']==6 || $d['stat']==0 || $d['stat']==5) {
                    $costs[] = $d['sngl_price'];
                }
            }
        }
    }
        if(empty($costs)===true){
            $costs[]=0;
        }
    return array_sum($costs);
}

function total_bookedses_cost($cn,$cas_id,$month){
    $query = "SELECT `srv_cd` FROM `services`";
    $run = mysqli_query($cn, $query);
    while ($srv = mysqli_fetch_assoc($run)) {
        $srv_cd = $srv['srv_cd'];
        $query1 = "select stat, price_stat, rglr_price, sngl_price from ses 
                where cas_id=$cas_id and srv_cd='$srv_cd' and substring(ses_day,1,7)='$month'";
        $run1=mysqli_query($cn,$query1);
        while($d=mysqli_fetch_assoc($run1)) {
            if($d['price_stat']==1 ){
                $costs[] = $d['rglr_price'];
            }elseif($d['price_stat']==0){
                $costs[] = $d['sngl_price'];
            }
        }
    }
    if(empty($costs)===true){
        $costs[]=0;
    }
    return array_sum($costs);
}

function total_nxtmonth_ses_cost($cn,$cas_id,$month){
 // sum  services * case regular price
       $query="SELECT `srv_cd` FROM `services`";
        $run=mysqli_query($cn, $query);
        $total=0;
        $nxt_month=date("Y-m",strtotime("+1 month",strtotime($month)));
        while($srv=mysqli_fetch_assoc($run)){
            $srv_cd=$srv['srv_cd'];
            
            $query2="SELECT `".$srv_cd."_rglr_price` FROM `seset` WHERE `case_id`=$cas_id";
            $run2=mysqli_query($cn,$query2);
            
            while($pr=mysqli_fetch_assoc($run2)){
                $srv_rglr_pr= $pr[$srv_cd."_rglr_price"];
                $ses_cost=overall_total_sessions($cn,$cas_id,$nxt_month,$srv_cd);
                $add=$srv_rglr_pr*$ses_cost;
                $total= $total+$add;               
            }    
        }
        return $total;
}

function total_excuses_fines($cn,$cas_id,$month){
    //(excused sessions - taken rebooked)*fine
       $query="SELECT `srv_cd` FROM `services`";
        $run=mysqli_query($cn, $query);
        $total=0;
        while($srv=mysqli_fetch_assoc($run)){
            $srv_cd=$srv['srv_cd'];
            
            $query2="SELECT `excuse_fn` FROM `services` WHERE `srv_cd`='$srv_cd'";
            $run2=mysqli_query($cn,$query2);
            
            while($pr=mysqli_fetch_assoc($run2)){
                $excuse_fn= $pr["excuse_fn"];
                $rebooked_sessions=total_sessions($cn,$cas_id,$month,$srv_cd,6);
                $excused_sessions=total_sessions($cn,$cas_id,$month,$srv_cd,2);
                $excused_rebook=total_sessions($cn,$cas_id,$month,$srv_cd,7);
                
               $fine_sessions=abs($excused_sessions+$rebooked_sessions-$rebooked_sessions);
                
               $add=$fine_sessions*$excuse_fn;
               $total= $total+$add;               
            }    
        }
        return $total;
}

function total_absence_fines($cn,$cas_id,$month){
    //(excused sessions - taken rebooked)*fine
       $query="SELECT `srv_cd` FROM `services`";
        $run=mysqli_query($cn, $query);
        $total=0;
        while($srv=mysqli_fetch_assoc($run)){
            $srv_cd=$srv['srv_cd'];
            
            $query2="SELECT `absence_fn` FROM `services` WHERE `srv_cd`='$srv_cd'";
            $run2=mysqli_query($cn,$query2);
            
            while($pr=mysqli_fetch_assoc($run2)){
                $absence_fn= $pr["absence_fn"];
                $absence_sessions=total_sessions($cn,$cas_id,$month,$srv_cd,3);
                
               $add=$absence_sessions*$absence_fn;
               $total= $total+$add;               
            }    
        }
        return $total;
}





function total_ses_costs($cn,$cas_id,$month){
    $nxt_month= date("Y-m", strtotime("first day of  $month +1 month"));
    $total_taken_ses_cost=total_ses_cost($cn,$cas_id,1,$month);
    $total_rebooked_ses_cost=total_ses_cost($cn,$cas_id,6,$month);
    $total_excuses_fines= total_ses_cost($cn,$cas_id,2,$month) + total_ses_cost($cn,$cas_id,7,$month);
    $total_absence_fines= total_ses_cost($cn,$cas_id,3,$month) + total_ses_cost($cn,$cas_id,8,$month);
    $total_next_month_sessions_cost=total_bookedses_cost($cn,$cas_id,$nxt_month);

    $total_all_ses_cost=  total_bookedses_cost($cn,$cas_id,$month);
//if(time()<(time()+(60*60*60*12*10))){$total_all_ses_cost=" ";}// Temporal (should be removed at 2021-08-31)
 //   $total_all_ses_cost=" "; // should be removed

    if($total_taken_ses_cost==0){$total_taken_ses_cost="-";}
    if($total_rebooked_ses_cost==0){$total_rebooked_ses_cost="-";}
    if($total_excuses_fines==0){$total_excuses_fines="-";}
    if($total_absence_fines==0){$total_absence_fines="-";}
    if($total_next_month_sessions_cost==0){$total_next_month_sessions_cost="-";}
                        echo "
                        <tfoot>
                            <tr >
                                <th >Cost:</th>
                                <th  title='Total all booked sessions cost'>".$total_all_ses_cost."</th>
                                <th  title='Total taken sessions cost'>".$total_taken_ses_cost."</th>
                                <th  title='Total taken re-booked sessions cost'>".$total_rebooked_ses_cost."</th>
                                <th  title='Total excuses fines'>".$total_excuses_fines."</th>
                                <th  title='Total absences fines'>".$total_absence_fines."</th>
                                <th  ></th>
                                <th >$total_next_month_sessions_cost</th>
                            </tr>
                        </tfoot>
                      
                        ";
}


function total_current_month_cost($cn,$cas_id,$month){
    $nxt_month= date("Y-m", strtotime(" $month +1 month"));
    $total_taken_ses_cost=total_ses_cost($cn,$cas_id,1,$month);
    $total_rebooked_ses_cost=total_ses_cost($cn,$cas_id,6,$month);
    $total_excuses_fines= total_ses_cost($cn,$cas_id,2,$month) + total_ses_cost($cn,$cas_id,7,$month);
    $total_absence_fines= total_ses_cost($cn,$cas_id,3,$month) + total_ses_cost($cn,$cas_id,8,$month);
    $total_next_month_sessions_cost=total_ses_cost($cn,$cas_id,0,$nxt_month);

    $total_current_month_cost= $total_taken_ses_cost+$total_rebooked_ses_cost+$total_excuses_fines+$total_absence_fines;
    
    return $total_current_month_cost;
}


function total_cas_current_month_payments($cn,$cas_id,$month){
    $query="SELECT `amount` FROM `pay` WHERE `cas_id`=$cas_id AND `month`='$month'";
    $data= mysqli_query($cn, $query);
    $result=0;
    while($row= mysqli_fetch_assoc($data)){
        $result= $result + $row['amount'];
    }
    //return $result;    
    return $result;    
}


function total_cas_prev_month_payments($cn,$cas_id){
    $previous_month=date("Y-m",strtotime("-1 month",time()));
    $query="SELECT sum(`amount`) FROM `pay` WHERE `cas_id`=$cas_id AND `month`='$previous_month'";
    $data= mysqli_query($cn, $query);
    $row= mysqli_fetch_row($data);
    return $result=$row[0]; 
}

function current_month_payments($cn,$month){
    $pyquery="SELECT * FROM `pay` where month='$month'";
    $runpay=mysqli_query($cn,$pyquery);
    
    while($py=mysqli_fetch_assoc($runpay)){
        
        $cas_id = $py['cas_id'];
        $amount = $py['amount'];
        $month = $py['month'];
        $details = $py['details'];
        $submitter = $py['submitter'];
        $submit_timestamp = $py['submit_timestamp'];
        $rcvd_by = $py['rcvd_by'];
        
        $nm=get_fullname_from_user_id($cn,$cas_id);
        $sbnm= get_fullname_from_user_id($cn,$submitter);
        $rvnm= get_fullname_from_user_id($cn,$rcvd_by);
        $tm=date("Y/m/d - h:m A", $submit_timestamp);
        $mnth=date("M Y", strtotime($month));
    
                    echo"
                    <div class='payrw'>
                        <div class='paytd'>".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm']."</div>
                        <div class='paytd'>".$amount." L.E.</div>
                        <div class='paytd'>".$mnth."</div>
                        <div class='paytd'>".$details."</div>
                        <div class='paytd'>".$sbnm['frst_nm']." ".$sbnm['lst_nm']."</div>
                        <div class='paytd'>".$tm."</div>
                        <div class='paytd'>Dr.".$rvnm['frst_nm']."</div>
                    </div>
                        ";
    }

}

function current_month_outlays($cn,$outlays,$month){

foreach ($outlays as $key => $value){
    $details=$outlays[$key]->details;
    $amount=$outlays[$key]->amount;
    $dbmonth=$outlays[$key]->month;
    $submitter=$outlays[$key]->submitter;
    $submit_timestamp=$outlays[$key]->submit_timestamp;
    $expndd_by=$outlays[$key]->expndd_by;
        $sbnm= get_fullname_from_user_id($cn,$submitter);
        $rvnm= get_fullname_from_user_id($cn,$expndd_by);
        $tm=date("Y/m/d - h:m A", $submit_timestamp);
        $mnth=date("M Y", strtotime($dbmonth));
        if($dbmonth===$month) {
            echo "
                            <div class='outlayrw'>
                                <div class='paytd'>" . $details . "</div>
                                <div class='paytd'>" . $amount . " L.E.</div>
                                <div class='paytd'>" . $mnth . "</div>
                                <div class='paytd'>" . $sbnm['frst_nm'] . " " . $sbnm['lst_nm'] . "</div>
                                <div class='paytd'>" . $tm . "</div>
                                <div class='paytd'>Dr." . $rvnm['frst_nm'] . "</div>
                            </div>
                                ";
        }
    }
}

function total_month_outlays($outlays,$month){
    foreach ($outlays as $key => $value) {
        $dbmonth= $outlays[$key]->month;
        if($dbmonth===$month) {
            $result[] = $outlays[$key]->amount;
        }
    }
    return array_sum($result);
}


//============================================================================
//                     Case accounting functions
//============================================================================


function cas_acc_is_found($cn,$cas_id){
	$query = "SELECT `cas_id` FROM `acc` WHERE `cas_id`=$cas_id ";
	$data =mysqli_query($cn,$query);
	if(mysqli_num_rows($data)==1){
      //  echo "Ok";
		return true;
	}else{
      //  echo"not ok";
		return false;
	}
}



function create_cas_accounts($cn){
    
    $query22="SELECT `usr_id` FROM `users` WHERE `prv`=5";  // to select all cases
    
    $runnn= mysqli_query($cn, $query22);
    $nxt_month=date("Y-m",strtotime("+1 month"));
    while($c=mysqli_fetch_assoc($runnn)){
        $cas_id=$c['usr_id'];
       // echo "<br> user";
       $cas_id=$c['usr_id'];
        $query333="INSERT INTO `acc`  (`cas_id`, `month`) VALUES ($cas_id,'$nxt_month')";
        mysqli_query($cn,$query333);
        
    }
    
}



/*
function add_all_prv_returns($cn){
    
    
    $query="select cas_id,amount from pay where details='r'";
    $rnnn=mysqli_query($cn, $query);
    while($dd=mysqli_fetch_assoc($rnnn)){
        $cas_id= $dd['cas_id'];
        $amount= $dd['amount'];
        $qq="update acc set  rtrn_prv_mnth=$amount where cas_id=$cas_id";
        mysqli_query($cn,$qq );
    }
    
}
*/

// findout whether a case has account for current month or not

function is_case_has_acc_for_cur_month($cn, $cas_id,$month){
    $query66="select acc_id from acc where cas_id=$cas_id and month='$month'";
    $runn=mysqli_query($cn,$query66);
    $x=0;
    while($n=mysqli_fetch_assoc($runn)){
        $x++;
    }
    if($x > 0){
       // echo "true";
        return true;
    }else{
      //  echo "false";
        return false;
    }
}
// findout whether a case has account for next month or not

function is_case_has_acc_for_nxt_month($cn, $cas_id,$month){
    $month=date("Y-m", strtotime("$month +1 month"));
    $query66="select acc_id from acc where cas_id=$cas_id and month='$month'";
    $runn=mysqli_query($cn,$query66);
    $x=0;
    while($n=mysqli_fetch_assoc($runn)){
        $x++;
    }
    if($x > 0){
       // echo "true";
        return true;
    }else{
      //  echo "false";
        return false;
    }
}

// findout whether a case has account for previous month or not

function is_case_has_acc_for_prv_month($cn, $cas_id,$month){
    $month=date("Y-m", strtotime("$month -1 month"));
    $query66="select acc_id from acc where cas_id=$cas_id and month='$month'";
    $runn=mysqli_query($cn,$query66);
    $x=0;
    while($n=mysqli_fetch_assoc($runn)){
        $x++;
    }
    if($x > 0){
       // echo "true";
        return true;
    }else{
      //  echo "false";
        return false;
    }
}

// Current month all costs fucntions: ========================================================

function rndr_cst_cur_mnth($cn,$cas_id,$month){
    
    $cst_cur_mnth=total_current_month_cost($cn,$cas_id,$month);
    
    if(is_case_has_acc_for_cur_month($cn, $cas_id,$month)===false){
            // Create account for current month:
            $cur_month=date("Y-m",strtotime($month));
            $query7="INSERT INTO `acc`  (`cas_id`, `month`) VALUES ($cas_id,'$cur_month')";
            mysqli_query($cn,$query7);
    }elseif(is_case_has_acc_for_nxt_month($cn, $cas_id,$month)===false){
            // Create account for next month:
            $nxt_month=date("Y-m",strtotime("$month +1 month"));
            $query8="INSERT INTO `acc`  (`cas_id`, `month`) VALUES ($cas_id,'$nxt_month')";
            mysqli_query($cn,$query8);

    }elseif(is_case_has_acc_for_prv_month($cn, $cas_id,$month)===false){
            // Create account for next month:
            $prv_month=date("Y-m",strtotime("$month -1 month"));
            $query8="INSERT INTO `acc`  (`cas_id`, `month`) VALUES ($cas_id,'$prv_month')";
            mysqli_query($cn,$query8);  
    }else{
            $q="update acc set cst_cur_mnth = $cst_cur_mnth where cas_id=$cas_id and month = '$month'";
            mysqli_query($cn,$q);
    }
    
}


function sw_cst_cur_mnth($cn,$cas_id,$month){

    //update current month costs:
    $cst_cur_mnth=  total_ses_cost($cn,$cas_id,1,$month) // taken sessions cost
    +  total_ses_cost($cn,$cas_id,6,$month) // taken rebooked session cost
    +  total_ses_cost($cn,$cas_id,2,$month) // excused fines cost
    +  total_ses_cost($cn,$cas_id,7,$month) // excused rebook fines cost
    +  total_ses_cost($cn,$cas_id,3,$month) // absence fines cost
    +  total_ses_cost($cn,$cas_id,8,$month);
   return $cst_cur_mnth;
}

//Previous month returns:=============================================================
function sw_rtrn_prv_mnth($cn,$cas_id,$month){
    $prev_month= date("Y-m",strtotime("$month -1 month"));
    $q="select rtrn_cur_mnth from acc where cas_id =$cas_id and month='$prev_month'";
    $r= mysqli_query($cn,$q);
    while($d=mysqli_fetch_assoc($r)){
        $rtrn_prv_mnth= $d['rtrn_cur_mnth'];
    }
    
    return $rtrn_prv_mnth;
}



//Total payment balance (payments + previous returns):=============================================================

function rndr_cur_mnth_balance($cn,$cas_id,$month){
    $total_cas_current_month_payments=total_cas_current_month_payments($cn,$cas_id,$month);
    $rtrn_prv_mnth= sw_rtrn_prv_mnth($cn,$cas_id,$month);
    
    $cur_mnth_balance1=$total_cas_current_month_payments+$rtrn_prv_mnth;
    
    //$month= date("Y-m", time());
    $queryyy="UPDATE `acc` SET `cur_mnth_balance`=$cur_mnth_balance1 WHERE `cas_id` = $cas_id AND `month` = '$month'";
    mysqli_query($cn,$queryyy);
}


function sw_cur_mnth_balance($cn,$cas_id,$month){
    rndr_cur_mnth_balance($cn,$cas_id,$month); 
    $q="select cur_mnth_balance from acc where cas_id = $cas_id and month ='$month'";
    $r= mysqli_query($cn,$q);
    while($d=mysqli_fetch_assoc($r)){
        $cur_mnth_balance2= $d['cur_mnth_balance'];
    }
    
   $cur_mnth_balance2;
   return $cur_mnth_balance2;
}

//Current month returns (balance - cost):=============================================================


function sw_rtrn_cur_mnth($cn,$cas_id, $month){
   $sw_cur_mnth_balance= sw_cur_mnth_balance($cn,$cas_id, $month);
   $sw_cst_cur_mnth= sw_cst_cur_mnth($cn,$cas_id, $month);
    
    $rndr_rtrn_cur_mnth= $sw_cur_mnth_balance - $sw_cst_cur_mnth;
    $query="update acc set rtrn_cur_mnth=$rndr_rtrn_cur_mnth where cas_id= $cas_id and month='$month'";
    
    mysqli_query($cn, $query);
    return  $rndr_rtrn_cur_mnth;
    

}



//Required prepaid current month booking:=============================================================

function sw_rq_pay_cur_mnth($cn,$cas_id,$month){
    $q="select rq_pay_cur_mnth from acc where cas_id = $cas_id and month='$month'";
    $r= mysqli_query($cn,$q);
    while($d=mysqli_fetch_assoc($r)){
        $rq_pay_cur_mnth= $d['rq_pay_cur_mnth'];
    }
    
    return $rq_pay_cur_mnth;
}



//Required prepaid next month booking:=============================================================

function rndr_rq_pay_nxt_mnth ($cn,$cas_id,$month){
    $cur_month=date("Y-m",strtotime($month));
    $nxt_month=date("Y-m",strtotime("+1 month",strtotime($month)));
    $total_next_month_sessions_cost=total_nxtmonth_ses_cost($cn,$cas_id,$cur_month);
    $sw_rtrn_cur_mnth=sw_rtrn_cur_mnth($cn,$cas_id, $cur_month);
    $rq_pay_cur_mnth=$total_next_month_sessions_cost-$sw_rtrn_cur_mnth;
    $month=date("Y-m",strtotime("+1 month"));
    $query="update acc set rq_pay_cur_mnth=$rq_pay_cur_mnth where cas_id=$cas_id and month='$nxt_month'" ;
    
    mysqli_query($cn, $query);

    
}


function sw_rq_pay_nxt_mnth($cn,$cas_id,$month){
    rndr_rq_pay_nxt_mnth($cn,$cas_id,$month);
    
    $month=date("Y-m",strtotime("+1 month",strtotime($month)));
    $q="select rq_pay_cur_mnth  from acc where cas_id = $cas_id and month='$month'";
    $r= mysqli_query($cn,$q);
    while($d=mysqli_fetch_assoc($r)){
        $rq_pay_cur_mnth = $d['rq_pay_cur_mnth'];
    }
    
    return $rq_pay_cur_mnth ;
}





function taafeel_equation($cn,$cas_id){
    

}







function total_month_payments($cn,$month){
    $query="select `amount` from pay where month='$month'";
    $run=mysqli_query($cn, $query);
    $result=0;
    while($d=mysqli_fetch_assoc($run)){
        $result=$result+$d['amount'];
    }
     return $result; 
}






//function case_has_pay_due($cn,$cas_id){
//    $run=mysqli_query($cn,"select count(cas_id) from pay_dues where cas_id = $cas_id");
//    while ($d=mysqli_fetch_array($run)){
//        if($d[0]>0){
//            return true;
//        }else{return false;}
//    }
//}
function case_has_pay_due($cn,$cas_id){
    $run=mysqli_query($cn,"select sum(pay_due) from pay_dues where cas_id = $cas_id");
    while ($d=mysqli_fetch_array($run)){
        if($d[0]>0){
            return true;
        }else{return false;}
    }
}

function notify_payment($cn,$cas_id){
    $run=mysqli_query($cn, "select notify from pay_dues where cas_id=$cas_id");
    while($d=mysqli_fetch_assoc($run)){
        if($d['notify']==1){
            return true;
        }
    }
}



function current_month_payment_dues($cn,$user_id){
    $pyquery="SELECT usr_id FROM `users` where usr_catg=7 order by frst_nm, scnd_nm";
    $runpay=mysqli_query($cn,$pyquery);

    while($py=mysqli_fetch_assoc($runpay)){
        
        $cas_id = $py['usr_id'];
            if(is_case_has_sessions_for_cur_month($cn,$cas_id)==true){
                $nm=get_fullname_from_user_id($cn,$cas_id);
                $mnth=date("Y-m", time());
                $sw_cur_mnth_balance=sw_cur_mnth_balance($cn,$cas_id,$mnth);
                $sw_rq_pay_cur_mnth=sw_cst_cur_mnth($cn,$cas_id,$mnth);
                $dues=$sw_cur_mnth_balance-$sw_rq_pay_cur_mnth;
                            echo"
                            <div class='payrw'>
                                <div class='paytd'>".$nm['frst_nm']." ".$nm['scnd_nm']." ".$nm['thrd_nm']." ".$nm['lst_nm']."</div>
                                <div class='paytd'>".$sw_cur_mnth_balance." L.E.</div>";
                           echo"<div class='paytd'>".$sw_rq_pay_cur_mnth." L.E.</div>";
            if($dues<150){
                $rqdues = $dues;

                           echo"<div class='paytd darkredfont'>".$rqdues." L.E.</div>";
                            if(allowed_prv($cn,$user_id,$prv_args=[1,2])===true) {

                                echo "<div class='paytd'>
                                        <input type='hidden' name='".$cas_id."' value='0'/>
                                        <input type='checkbox' name='".$cas_id."' value='1'";

                                if (notify_payment($cn, $cas_id) === true) {
                                    echo "checked";
                                }
                                echo ">Notify</div>";

                            }
                $cases[]= $cas_id;
                $dues_array[]=$rqdues;
                $cases_dues= array_combine($cases, $dues_array);


               // unset($_SESSION['cases_dues']);
            }else{
                echo "<div class='paytd greenfont'>".$dues."</div>";}
                           echo" </div>
                                ";
            }
    }
//    mysqli_query($cn,"delete from pay_dues");
    $time_stamp=time();
    foreach ($cases_dues as $cas_id=>$due) {
        if(case_has_pay_due($cn,$cas_id)===true){
         // echo"<br>".$queryy="update pay_dues set pay_due=$due, time_stamp=$time_stamp where cas_id=$cas_id";
            mysqli_query($cn,"update pay_dues set pay_due=$due, time_stamp=$time_stamp where cas_id=$cas_id");
        }else{
            mysqli_query($cn,"delete from pay_due where cas_id=$cas_id");
            mysqli_query($cn,"insert into pay_dues (cas_id,pay_due,notify,time_stamp) values ($cas_id,$due,0,$time_stamp);");
        }
    }

}

function pay_dues_array($cn){
    $run=mysqli_query($cn, "select * from pay_dues");
    while($d=mysqli_fetch_assoc($run)){
        $cas_id= $d['cas_id'];
        $due= $d['pay_due'];
        $due_array[$cas_id]=$due;
    }
    return $due_array;
}






function tot_today_pays($cn){
    
    $query="select amount , submit_timestamp from pay";
    $r=mysqli_query($cn, $query);
    $tody=date("Y-m-d",time());
    $amount=0;
    while($d=mysqli_fetch_assoc($r)){
        $pay_day= date("Y-m-d", $d['submit_timestamp']);
        if($pay_day===$tody){
          $amount=$amount+$d['amount'];
        }
    }
    
    return $amount;
}



























































?>