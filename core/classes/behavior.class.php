<?php
require_once("dbobject.class.php");


class Behavior extends DBobject {
    static protected $tablename='behaviors';
    static protected $tableid="behav_id";
    static  protected $db_columns=['behav_nm', 'detail', 'trigs',  'submitter', 'submit_timestamp'];

    public $behav_id;
    public $behav_nm;
    public $detail;
    public $trigs;
    public $submitter;
    public $submit_timestamp;

    public function __construct($args=[]){
        $this->behav_nm        =$args['behav_nm'] ?? '';
        $this->detail          =$args['detail'] ?? '';
        $this->trigs           =$args['trigs'] ?? '';
        $this->submitter       =$args['submitter'] ?? '';
        $this->submit_timestamp=$args['submit_timestamp'] ?? '';
    }


}


























?>
