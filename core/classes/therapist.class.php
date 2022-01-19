<?php
require_once("user.class.php");


class Therapist extends User {
    static  protected $db_columns=['frst_nm', 'scnd_nm', 'thrd_nm', 'lst_nm', 'dob','dow', 'eml', 'ph1', 'ph2', 'address', 'usr_catg',
        'submitter', 'submit_timestamp','prv'];

    public $prv;
    public $dow;
    public $usr_catg;

    public function __construct($args=[]){
        $this->frst_nm         =$args['frst_nm'] ?? '';
        $this->scnd_nm         =$args['scnd_nm'] ?? '';
        $this->thrd_nm         =$args['thrd_nm'] ?? '';
        $this->lst_nm          =$args['lst_nm'] ?? '';
        $this->dob             =$args['dob'] ?? '';
        $this->dow             =$args['dow'] ?? '';
        $this->eml             =$args['eml'] ?? '';
        $this->ph1             =$args['ph1'] ?? '';
        $this->ph2             =$args['ph2'] ?? '';
        $this->address         =$args['address'] ?? '';
        $this->usr_catg        =$args['usr_catg'] ?? '';
        $this->submitter       =$args['submitter'] ?? '';
        $this->submit_timestamp=$args['submit_timestamp'] ?? '';
        $this->prv=4 ?? '';
    }

    public function save(){
        $id=static::$tableid;
        if(isset($this->$id)){
            $sql="insert into sal (usr_id) values (".$this->$id.")";
            self::$cn_ob->query($sql);
            return  $this->update();
        }else{
            // Add user salary record to sal_set table:
            $sql="insert into sal (usr_id) values (".$this->predicted_id().")";
            self::$cn_ob->query($sql);

            // Send notification to admins:
            mail("dregpt@gmail.com, Dr.Ramykasem88@hotmail.com","New therapist!", "A new therapist (".$this->frst_nm." ".$this->scnd_nm.") has been successfully added.");

            // Create new user:
            return  $this->create();
        }
    }


    protected function validate(){
        $this->errors=[];
        if($this->email_is_found()===true){
            $this->errors[]= "This email is already registered: (".$this->eml.")";
        }

        if(($this->phon1_is_found()===true)){
            $this->errors[]= "This phone number is already registered for another user: (".$this->ph1.")";
        }
        if(preg_match("/\\s/",$this->frst_nm)==true){
            $frst_nam=ucfirst($this->frst_nm);
            $this->errors[]= "First name is only one name and mustn't contain any spaces: (".$frst_nam.")";
        }
        if(preg_match("/\\s/",$this->scnd_nm)==true){
            $scnd_nam=ucfirst($this->scnd_nm);
            $this->errors[]= "Second name is only one name and mustn't contain any spaces: (".$scnd_nam.")";
        }
        if(preg_match("/\\s/",$this->thrd_nm)==true){
            $thrd_nam=ucfirst($this->thrd_nm);
            $this->errors[]= "Third name is only one name and mustn't contain any spaces: (".$thrd_nam.")";
        }

        if(preg_match("/\\s/",$this->lst_nm)==true){
            $lst_nam=ucfirst($this->lst_nm);
            $this->errors[]= "Last name is only one name and mustn't contain any spaces: (".$lst_nam.")";
        }

        return $this->errors;
    }

    public function attributes(){
        $attributes=[];
        foreach (static::$db_columns as $column){
            if($column===static::$tableid){continue;}

            if($column==='frst_nm' || $column==='scnd_nm' || $column==='thrd_nm' || $column==='lst_nm'){
                $attributes[$column]=ucwords(strtolower($this->$column));
            }else{
                $attributes[$column]= $this->$column;
            }
        }
        return $attributes;
    }



}


























?>
