<?php
require_once("dbobject.class.php");


class Outlay extends DBobject {
    static protected $tablename='outlay';
    static protected $tableid="outlay_id";
    static  protected $db_columns=['amount', 'month', 'details', 'expndd_by', 'submitter', 'submit_timestamp'];

    public $outlay_id;
    public $amount;
    public $details;
    public $expndd_by;
    public $submitter;
    public $submit_timestamp;

    public function __construct($args=[]){
        $this->amount          =$args['amount'] ?? '';
        $this->month           =$args['month'] ?? '';
        $this->details         =$args['details'] ?? '';
        $this->expndd_by       =$args['expndd_by'] ?? '';
        $this->submitter       =$args['submitter'] ?? '';
        $this->submit_timestamp=$args['submit_timestamp'] ?? '';
    }


}


























?>
