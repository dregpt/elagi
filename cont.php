<?php
include("core/init.php");
include("head.php");


//Delete:   -------------------------------------------------------------------------------

if(isset($_GET['ratcatgdelete'])){
	$rat_catg = RateCatg::find_by_id($_GET['ratcatgdelete']);
	$rat_catg->delete();
	header("location: ratcatgadd.php?admin&ratcatgadd&ratdeleted");
}

if(isset($_GET['trigdelete'])){
	$trigger = Trigger::find_by_id($_GET['trigdelete']);
	$trigger->delete();
	header("location: triggeradd.php?admin&triggeradd&trigdeleted");
}


if(isset($_GET['behavdelete'])){
	$behavior = Behavior::find_by_id($_GET['behavdelete']);
	$behavior->delete();
	header("location: behavioradd.php?admin&behavioradd&behavdeleted");
}


if(isset($_GET['delusrid'])==true){ //delete user
	$usrid = $_GET['delusrid'];
	$user = User::find_by_id($usrid);
	$user->delete();
	header("location: useradd.php?userdeleted");
}

if(isset($_GET['delete_outlay'])==true){ //delete user
	$delete_outlay = $_GET['delete_outlay'];
	$outlay = Outlay::find_by_id($delete_outlay);
	$outlay->delete();
	$user = User::find_by_id($outlay->expndd_by);
	$full_nm=$user->full_name();
	$msg="{$full_nm} has deleted the outlay of ($outlay->amount) L.E. for($outlay->details)";
	mail("dregpt@gmail.com, Dr.Ramykasem88@hotmail.com","An expenditure has been deleted!","{$msg}");

	header("location: outlayform.php?outlaydeleted");
}

if(isset($_GET['delete_income'])==true){ //delete user
	$delete_income = $_GET['delete_income'];
	$income = Income::find_by_id($delete_income);
	$income->delete();
	$user = User::find_by_id($income->rcvd_by);
	$full_nm=$user->full_name();
	$msg="{$full_nm} has deleted an income of ($income->amount) L.E. for($income->details)";
	mail("dregpt@gmail.com, Dr.Ramykasem88@hotmail.com","An income has been deleted!","{$msg}");

	header("location: incomeform.php?incomedeleted");
}


if(isset($_GET['delcaseid'])===true){ //delete case
	$usrid = $_GET['delcaseid'];
	delete_case($cn,$usrid);

	header("location: caseadd.php?caseedit&casedeleted");
}





if(isset($_GET['delthrpid'])===true){ //delete therpist
	$usrid = $_GET['delthrpid'];
	delete_user($cn,$usrid,$user_data);

	header("location:thrpadd.php?thrpedit&thrpdeleted");
}


if(isset($_GET['delusercatgid'])===true){ //delete user category
	$usr_catg_id = $_GET['delusercatgid'];
	delete_user_catg($cn,$usr_catg_id);

	header("location: usercatgadd.php?usercatgdeleted");
}

if(isset($_GET['delsrvid'])===true){ //delete service
	$srv_id = $_GET['delsrvid'];
	delete_srv($cn,$srv_id);

	header("location: srvadd.php?srvdeleted");
}


if(isset($_GET['delete_ses'])===true){ //delete service
	$ses_id = $_GET['delete_ses'];
    $casid =$_GET['casid'];
	delete_session($cn,$ses_id,$user_data['usr_id']);

	header("location:sescase.php?caseedit&caseedit&caseedit&sesdeleted&casid=$casid");
}

if(isset($_GET['delete_pay'])===true){ //delete service
	$pay_id = $_GET['delete_pay'];
	delete_payment($cn,$pay_id,$user_data);

	header("location:payform.php?regular_rec&payform&paydeleted");
}


// Edit:   --------------------------------------------------------------------------------


if(isset($_GET['edcasid'])===true){ //delete case
	$usrid = $_GET['edcasid'];
	$val= get_case_data($cn,$usrid);
	
	$frst_nm =$val['frst_nm'];
	$scnd_nm =$val['scnd_nm'];
	$thrd_nm =$val['thrd_nm'];
	$lst_nm  =$val['lst_nm'];
	$fthr_wrk=$val['fthr_wrk'];
	$mthr_wrk=$val['mthr_wrk'];
	$mthr_nm =$val['mthr_nm'];
	$address =$val['address'];
	$dob     =$val['dob'];
	$eml     =$val['eml'];
	$ph1     =$val['ph1'];
	$ph2     =$val['ph2'];
	$file_id =$val['file_id'];
	$referral=$val['referral'];
	$dof     =$val['dof'];


	
		header("location: caseedit.php?caseedit&casedit&frst_nm=".$frst_nm."&scnd_nm=".$scnd_nm."&thrd_nm=".$thrd_nm."&lst_nm=".$lst_nm."&fthr_wrk=".$fthr_wrk."&mthr_wrk=".$mthr_wrk."&mthr_nm=".$mthr_nm."&address=".$address."&dob=".$dob."&eml=".$eml."&ph1=".$ph1."&ph2=".$ph2."&file_id=".$file_id."&referral=".$referral."&dof=".$dof."&cd=".$usrid);
}

if(isset($_GET['edthrpid'])===true){ //delete case
	$usrid = $_GET['edthrpid'];
	$val= get_thrp_data($cn,$usrid);
	
	$frst_nm =$val['frst_nm'];
	$scnd_nm =$val['scnd_nm'];
	$thrd_nm =$val['thrd_nm'];
	$lst_nm  =$val['lst_nm'];
	$address =$val['address'];
	$dob     =$val['dob'];
	$eml     =$val['eml'];
	$ph1     =$val['ph1'];
	$ph2     =$val['ph2'];
	$usr_catg =$val['usr_catg'];
	$referral=$val['referral'];
	$dof     =$val['dof'];

     //echo "<pre>"; print_r($val); echo"</pre>";
	
		header("location: thrpedit.php?thrpedit&casedit&frst_nm=".$frst_nm."&scnd_nm=".$scnd_nm."&thrd_nm=".$thrd_nm."&lst_nm=".$lst_nm."&fthr_wrk=".$fthr_wrk."&mthr_wrk=".$mthr_wrk."&mthr_nm=".$mthr_nm."&address=".$address."&dob=".$dob."&eml=".$eml."&ph1=".$ph1."&ph2=".$ph2."&file_id=".$file_id."&referral=".$referral."&dof=".$dof."&cd=".$usrid."&usr_catg=".$usr_catg);
}


// Case setting:   --------------------------------------------------------------------------------

if(isset($_GET['caset'])===true){
	$usr_id=$_GET['caset'];
	$case_id=$_SESSION['caset'.$usr_id];
	$sesetcol = get_case_setting($cn,$case_id);
	//echo count($sesetcol)."<br>";
	$_SESSION['sesetcol'.$usr_id]=$sesetcol;
	$_SESSION['case_id']=$case_id;
	//echo count($sesetcol);
	//echo "<pre>"; print_r($_SESSION['sesetcol'.$usr_id]); echo "<pre>";
	
	header('location:seset.php?caseedit&seset&sesetcol='.$usr_id);
	
}


if(isset($_GET['deleteallseset'])===true){ // to delete or case sessions of the next month

    $case_id=$_GET['deleteallseset'];
    $nxt_month=date("Y-m", strtotime("first day of +1 month", time()));
    
    $query= "SELECT * FROM `ses` WHERE `cas_id`=$case_id"; 
    $runnnn=mysqli_query($cn,$query);
    while($ses_data=mysqli_fetch_assoc($runnnn)){
        $ses_id=$ses_data['ses_id'];
        $month=date('Y-m',strtotime($ses_data['ses_day']));
        if($month===$nxt_month){
            $query2="DELETE FROM `ses` WHERE `ses_id`=$ses_id";
            mysqli_query($cn, $query2);
        }else{
        //break;
        }
    }
    
    
    $_SESSION["nxt_mnth_sess_deleted"]=$case_id;
    header("location:seset.php?caseedit&seset");

}



if(isset($_POST['acc'])===true){
    $month=date("Y-m",time());
    
    // loop all case;
    $q="select usr_id from users where usr_catg=7";
    $d=mysqli_query($cn,$q);
    $x=0;
    while ($r=mysqli_fetch_assoc($d)){
        
        if(is_case_has_sessions_for_cur_month($cn,$r['usr_id'])===true){
                $cas_id=$r['usr_id'];
                sw_cst_cur_mnth($cn,$cas_id,$month);
                sw_rtrn_prv_mnth($cn,$cas_id);
                sw_cur_mnth_balance($cn,$cas_id,$month);
                sw_rtrn_cur_mnth($cn,$cas_id, $month);
                sw_rq_pay_cur_mnth($cn,$cas_id,$month);
                sw_rq_pay_nxt_mnth ($cn,$cas_id);
        }
    }
    
    header('location:admin.php?accounted');
}



if(isset($_GET['rebooklimit'])===true){
    $_SESSION['limitadded']=1;

    header('location:admin.php');
}



if(isset($_GET['delete_exclimit'])===true){
    
    delete_rebooking_limit($cn,$_GET['delete_exclimit']);

    header('location:admin.php');
}

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
















?>

