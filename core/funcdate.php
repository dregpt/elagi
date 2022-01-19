<?php


function frst_day_of_current_month(){
			$epoch=time();
			$a_date = date('Y-m', $epoch);
			return date("Y-m-01", strtotime($a_date));				
}
function lst_day_of_current_month(){
			$epoch=time();
			$a_date = date('Y-m', $epoch);
			return date("Y-m-t", strtotime($a_date)) ; echo"<br>";				
}
function frst_day_of_next_month(){
   // return date("Y-m-d",strtotime(date("Y",strtotime("+1 month"))."-".date("m",strtotime("first day of +1 month"))."-01"));
			//return date("Y-m-d ", strtotime(date('m', strtotime('1 month')).'/01/'.date('Y').' 00:00:00'));
    return date("Y-m-d ", strtotime("first day of +1 month"));
}
function lst_day_of_next_month(){
			return date("Y-m-t ", strtotime("first day of +1 month"));
}				
function frst_day_of_previous_month(){
			return date("Y-m-d  H:i:s", strtotime(date('m', strtotime('-1 month')).'/01/'.date('Y').' 00:00:00'));
}
function lst_day_of_previous_month(){
			return date("Y-m-t  H:i:s", strtotime("-1 month"));					
}				



// to get all Sunday days between 2 certain dates:

function get_nxt_mnth_days_ary($day){
				$frstday = frst_day_of_next_month();
				$lastday = lst_day_of_next_month();
				$begin  = new DateTime($frstday);
				$end    = new DateTime($lastday);
				$days = array();
				while ($begin <= $end) // Loop will work begin to the end date 
				{
					if($begin->format("D") == $day) //Check that the day is Sunday here
					{
						$days[]= $begin->format("Y-m-d");
					}

					$begin->modify('+1 day');
				}
			
				return $days;
}


function next_month(){
	return date('m',strtotime('first day of +1 month'));
}


function months_6list_options($month){
        
    $current_month_val= date("Y-m",strtotime("-4 month"));    $current_month_opt= date("F Y",strtotime("-4 month"));
    $current_month_val1= date("Y-m",strtotime("first day of -3 month"));    $current_month_opt1= date("F Y",strtotime("first day of -3 month"));
    $current_month_val2= date("Y-m",strtotime("first day of -2 month"));    $current_month_opt2= date("F Y",strtotime("first day of -2 month"));
    $current_month_val3= date("Y-m",strtotime("first day of -1 month"));    $current_month_opt3= date("F Y",strtotime("first day of -1 month"));
    $current_month_val4= date("Y-m",strtotime("0  month"));    $current_month_opt4= date("F Y",strtotime("0  month"));
    $current_month_val5= date("Y-m",strtotime("first day of +1 month"));    $current_month_opt5= date("F Y",strtotime("first day of +1 month"));
//    $current_month_val6= date("Y-m",strtotime("+2 month"));    $current_month_opt6= date("F Y",strtotime("+2 month"));


    
    
//    echo"<option value='".$current_month_val."' ";if($month===$current_month_val){echo"selected";}; echo">".$current_month_opt."</option>";
    echo"<option value='".$current_month_val1."' ";if($month===$current_month_val1){echo"selected";}; echo">".$current_month_opt1."</option>";
    echo"<option value='".$current_month_val2."' ";if($month===$current_month_val2){echo"selected";}; echo">".$current_month_opt2."</option>";
    echo"<option value='".$current_month_val3."' ";if($month===$current_month_val3){echo"selected";}; echo">".$current_month_opt3."</option>";
    echo"<option value='".$current_month_val4."' ";if($month===$current_month_val4){echo"selected";}; echo">".$current_month_opt4."</option>";
    echo"<option value='".$current_month_val5."' ";if($month===$current_month_val5){echo"selected";}; echo">".$current_month_opt5."</option>";
//    echo"<option value='".$current_month_val6."' ";if($month===$current_month_val6){echo"selected";}; echo">".$current_month_opt6."</option>";

}


function cur_month(){
    return date("Y-m", time());
}

function case_months_opt($cn,$cas_id,$month){
    $run=mysqli_query($cn, "select distinct (substr(ses_day,1,7)) from ses where cas_id= $cas_id");
    while($d=mysqli_fetch_row($run)){
        echo"<option value='".$d[0]."' ";
        if($month===$d[0]){
            echo" selected ";
        }
        echo " >";

        echo  date("F-Y",strtotime(" . $d[0] . "));

        echo" </option>";
    }
}




















			

?>