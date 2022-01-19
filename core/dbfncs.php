<?php



function db_connect(){
    $db_connction=new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
    confrim_db_connection($db_connction);
    return $db_connction;
}

function  confrim_db_connection($db_connction){
    if($db_connction->connect_errno){
        $msg="Database connection error:";
        $msg.=$db_connction->connection_error;
        $msg.=" (".$db_connction->connection_errono.")";
        exit($msg);
    }
}


















?>