<?php

date_default_timezone_set('Africa/Cairo');
session_start();
//ini_set('session.cookie_lifetime', '1200');
//ini_set('display_errors','off');
//error_reporting(E_ALL);
//error_reporting(0);
// data base connction function:




// Required functions files:

require_once('cn.php');
require_once('dbfncs.php');
require_once('fncts.php');
require_once('funcdate.php');
require_once('funcsrv.php');
require_once('funcses.php');
require_once('funcpay.php');

// Required classes files in classes directory:
require_once("classes/dbobject.class.php"); //parent 2
require_once("classes/user.class.php"); // parent 1
require_once("classes/therapist.class.php");// child
require_once("classes/outlay.class.php");// child
require_once("classes/income.class.php");// child
require_once("classes/note.class.php");// child
require_once("classes/trigger.class.php");// child
require_once("classes/behavior.class.php");// child
require_once("classes/ratecatg.class.php");// child
require_once("classes/salset.class.php");// child


//connect db to calsses:
$cn_ob=db_connect();
DBobject::set_database($cn_ob);

//User data:
if(is_logged_in()===true){
	$session_user_id=$_SESSION['user_id'];
	$user_data = user_data($session_user_id,$cn,'usr_id', 'eml', 'pswrd', 'frst_nm', 'lst_nm', 'actv', 'prv');
	
	if(user_is_active($cn,$user_data['eml'])===false){
		session_destroy();
		header('location:lgn.php');
	}
}


if( $_SERVER[ 'SERVER_NAME' ] != 'localhost' ){
   @ mail();
}


//Messages:
$message= array();

//echo substr($_SERVER['REQUEST_URI'],1);

//echo $user_data['usr_id'];
if (isset($user_data)===true){
if($user_data['usr_id']==325){ // run functions for developer user (Ibrahim salem)
    //$admins_emls=get_emails_inarray($cn, 9);
   // $cases_emls=get_emails_inarray($cn, 7);
   // $ses_day=date("Y-m-d",time());



//   $cas_id= 230;
//    $srv_cd="PT";
//   $month="2021-08";
//    $somthing= is_case_active_in_months($cn,$cas_id,2);
//    print_r($somthing);
    

}}

//echo "<pre>";
//print_r($arr);
//echo "<pre>";







?>