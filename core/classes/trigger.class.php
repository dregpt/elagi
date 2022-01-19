<?php
require_once("dbobject.class.php");


class Trigger extends DBobject {
    static protected $tablename='trig';
    static protected $tableid="trig_id";
    static  protected $db_columns=['trig_nm', 'detail', 'bonus','penalty',
                                  'thr_min','thr_max', 'trig_reset','trig_act',  'submitter', 'submit_timestamp'];

    public $trig_id;
    public $trig_nm;
    public $detail;
    public $bonus;
    public $penalty;
    public $thr_min;
    public $thr_max;
    public $trig_reset;
    public $trig_act;
    public $submitter;
    public $submit_timestamp;

    public function __construct($args=[]){
        $this->trig_nm         =$args['trig_nm'] ?? '';
        $this->detail          =$args['detail'] ?? '';
        $this->bonus           =$args['bonus'] ?? '';
        $this->penalty         =$args['penalty'] ?? '';
        $this->thr_min         =$args['thr_min'] ?? '';
        $this->thr_max         =$args['thr_max'] ?? '';
        $this->trig_reset      =$args['trig_reset'] ?? '';
        $this->trig_act        =$args['trig_act'] ?? '';
        $this->submitter       =$args['submitter'] ?? '';
        $this->submit_timestamp=$args['submit_timestamp'] ?? '';
    }


    public function validate_thr_min(){
            if(is_numeric($this->thr_min) || $this->thr_min==="unlimited"){
                return false;
            }else{
                return true;
            }
    }
    public function validate_thr_max(){
        if(is_numeric($this->thr_max) || $this->thr_max==="unlimited"){
            return false;
        }else{
            return true;
        }
    }

    protected function validate(){
        $this->errors=[];
        if($this->validate_thr_min()===true){
            $this->errors[]= "Minimum threshold value must be numeric or 'unlimited'";
        }
        if($this->validate_thr_max()===true){
            $this->errors[]= "Maximum threshold value must be numeric or 'unlimited'";
        }


        return $this->errors;
    }


}


























?>
