<?php
require_once("dbobject.class.php");


class UserBehav extends DBobject {
    static protected $tablename='user_behav';
    static protected $tableid="usrbhv_id";
    static  protected $db_columns=['note',  'submitter', 'submit_timestamp'];

    public $usrbhv_id;
    public $note;
    public $submitter;
    public $submit_timestamp;

    public function __construct($args=[]){
        $this->note            =$args['note'] ?? '';
        $this->submitter       =$args['submitter'] ?? '';
        $this->submit_timestamp=$args['submit_timestamp'] ?? '';
    }


}


























?>
