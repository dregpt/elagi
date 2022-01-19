<?php
require_once("dbobject.class.php");


class RateCatg extends DBobject {
    static protected $tablename='rat_categ';
    static protected $tableid="rat_id";
    static  protected $db_columns=['rat_nm',  'rat_cd', 'rat', 'detail', 'submitter', 'submit_timestamp'];

    public $rat_id;
    public $rat_nm;
    public $rat_cd;
    public $rat;
    public $detail;
    public $submitter;
    public $submit_timestamp;

    public function __construct($args=[]){
        $this->rat_nm          =$args['rat_nm'] ?? '';
        $this->rat_cd          =$args['rat_cd'] ?? '';
        $this->rat             =$args['rat'] ?? '';
        $this->detail          =$args['detail'] ?? '';
        $this->submitter       =$args['submitter'] ?? '';
        $this->submit_timestamp=$args['submit_timestamp'] ?? '';
    }


}


























?>
