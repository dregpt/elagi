<?php
require_once("dbobject.class.php");


class Note extends DBobject {
    static protected $tablename='notes';
    static protected $tableid="note_id";
    static  protected $db_columns=['note',  'submitter', 'submit_timestamp'];

    public $note_id;
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
