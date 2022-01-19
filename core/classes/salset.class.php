<?php
require_once("dbobject.class.php");


class Salset extends DBobject {
    static protected $tablename='sal_set';
    static protected $tableid="usr_id";
    static  protected $db_columns=['sal', 'reg_bonus', 'bonus', 'deduction', 'perc_revnue', 'taken_cost', 'taken_perc',
                                   'taken_bonus', 'submit_timestamp', 'submitter', 'rat_by', 'srv_percent', 'taken_services'];

    public $usr_id;
    public $sal;
    public $reg_bonus;
    public $deduction;
    public $perc_revnue;
    public $taken_cost;
    public $taken_perc;
    public $taken_bonus;
    public $submit_timestamp;
    public $submitter;
    public $srv_percent;
    public $rat_by;
    public $taken_services;

    public function __construct($args=[]){
        $this->sal             =$args['sal'] ?? '';
        $this->reg_bonus       =$args['reg_bonus'] ?? '';
        $this->bonus           =$args['bonus'] ?? '';
        $this->deduction       =$args['deduction'] ?? '';
        $this->perc_revnue     =$args['perc_revnue'] ?? '';
        $this->taken_cost      =$args['taken_cost'] ?? '';
        $this->taken_perc      =$args['taken_perc'] ?? '';
        $this->taken_bonus     =$args['taken_bonus'] ?? '';
        $this->submit_timestamp=$args['submit_timestamp'] ?? '';
        $this->submitter       =$args['submitter'] ?? '';
        $this->rat_by          =$args['rat_by'] ?? '';
        $this->srv_percent     =$args['srv_percent'] ?? '';
        $this->taken_services  =$args['taken_services'] ?? '';
    }





}


























?>
