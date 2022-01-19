<?php
require_once("dbobject.class.php");


class User extends DBobject {
    static protected $tablename='users';
    static protected $tableid="usr_id";
    static  protected $db_columns=['frst_nm', 'lst_nm',  'dob', 'pswrd', 'eml', 'ph1', 'ph2', 'address', 'prv',
        'actv', 'prtct', 'submitter', 'submit_timestamp'];

    public $usr_id;
    public $frst_nm;
    public $scnd_nm;
    public $thrd_nm;
    public $lst_nm;
    public $dob;
    public $pswrd;
    public $pswrd2;
    public $eml;
    public $ph1;
    public $ph2;
    public $address;
    public $prv;

    public function __construct($args=[]){
        $this->frst_nm         =$args['frst_nm'] ?? '';
        $this->lst_nm          =$args['lst_nm'] ?? '';
        $this->dob             =$args['dob'] ?? '';
        $this->eml             =$args['eml'] ?? '';
        $this->ph1             =$args['ph1'] ?? '';
        $this->ph2             =$args['ph2'] ?? '';
        $this->address         =$args['address'] ?? '';
        $this->pswrd           =$args['pswrd'] ?? '';
        $this->pswrd2          =$args['pswrd2'] ?? '';
        $this->prv             =$args['prv'] ?? '';
        $this->actv            =$args['actv'] ?? '';
        $this->prtct           =$args['prtct'] ?? '';
        $this->submitter       =$args['submitter'] ?? '';
        $this->submit_timestamp=$args['submit_timestamp'] ?? '';
    }

    public function full_name(){
        return "{$this->frst_nm} {$this->lst_nm}";
    }
     public function save(){
        $id=static::$tableid;
        if(isset($this->$id)){
            $sql="insert into sal_set (usr_id) values (".$this->$id.")";
            self::$cn_ob->query($sql);
            return  $this->update();
        }else{
            // Add user salary record to sal_set table:
            $sql="insert into sal_set (usr_id) values (".$this->predicted_id().")";
            self::$cn_ob->query($sql);

            // Send notification to admins:
            mail("dregpt@gmail.com, Dr.Ramykasem88@hotmail.com","New user!", "A new user (".$this->full_name().") has been successfully added.");

            // Create new user:
            return  $this->create();
        }
    }



    public function email_is_found(){
        $userid= $this->predicted_id();
        if(!empty($this->get_user_id_from_eml())){
            $thisid= $this->get_user_id_from_eml();
        }else{
            $thisid=$userid;
        }
        $sql = "SELECT count(usr_id) FROM users WHERE eml='".$this->eml."' and usr_id not in (";
        $sql .= "select usr_id from users where usr_id=$userid or usr_id= $thisid)";
        $result=self::$cn_ob->query($sql) /*or die(self::$cn_ob->error)*/;
        $d=$result->fetch_array();
        if($d[0]>0){
            return true;
        }else{
            return false;
        }
    }
    public function phon1_is_found(){
        $userid= $this->predicted_id();
        if(!empty($this->get_user_id_from_eml())){
            $thisid= $this->get_user_id_from_eml();
        }else{
            $thisid=$userid;
        }
        $sql = "SELECT count(usr_id) FROM users WHERE `ph1`='".$this->ph1."' and usr_id not in (";
        $sql.= "select usr_id from users where usr_id=$userid or usr_id= $thisid)";
        $result=self::$cn_ob->query($sql)/* or die(self::$cn_ob->error)*/;
        $d=$result->fetch_array();
        if($d[0]>0){
            return true;
        }else{
            return false;
        }
    }



    protected function validate(){
        $this->errors=[];
        if($this->email_is_found()===true){
            $this->errors[]= "This email is already registered: (".$this->eml.")";
        }
        if($this->pswrd !==  $this->pswrd2){
            $this->errors[]= "Passwords not match!";
        }

        if(($this->phon1_is_found()===true)){
            $this->errors[]= "This phone number is already registered for another user: (".$this->ph1.")";
        }
        if(preg_match("/\\s/",$this->frst_nm)==true){
            $frst_nam=ucfirst($this->frst_nm);
            $this->errors[]= "First name is only one name and mustn't contain any spaces: (".$frst_nam.")";
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

            if($column==='frst_nm' || $column==='lst_nm'){
                $attributes[$column]=ucwords(strtolower($this->$column));
            }else{
                $attributes[$column]= $this->$column;
            }
        }
        return $attributes;
    }

    public function get_user_id_from_eml(){
        $eml=$this->eml;
        $sql="select usr_id from users where eml='$eml'";
        $result= self::$cn_ob->query($sql);
        $d=$result->fetch_assoc();
        return $d['usr_id'];
    }


}


























?>
