<?php
require_once("dbobject.class.php");


class Income extends DBobject {
    static protected $tablename='income';
    static protected $tableid="inc_id";
    static  protected $db_columns=['amount', 'month', 'details', 'rcvd_by', 'submitter', 'submit_timestamp'];

    public $inc_id;
    public $amount;
    public $details;
    public $rcvd_by;
    public $submitter;
    public $submit_timestamp;

    public function __construct($args=[]){
        $this->amount          =$args['amount'] ?? '';
        $this->month           =$args['month'] ?? '';
        $this->details         =$args['details'] ?? '';
        $this->rcvd_by       =$args['rcvd_by'] ?? '';
        $this->submitter       =$args['submitter'] ?? '';
        $this->submit_timestamp=$args['submit_timestamp'] ?? '';
    }


}


























?>
