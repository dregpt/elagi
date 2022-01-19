<?php


class  DBobject{
    static protected $cn_ob;
    static protected $tablename="";
    static protected $tableid="";
    static  protected $db_columns=[];
    public $errors=[];
    static public function set_database($cn_ob){
        self::$cn_ob=$cn_ob;
    }

    static public function find_by_sql($sql){
        $result= static::$cn_ob->query($sql);
        if(!$result){
            exit("Database query failed!");
        }
        $object_array=[];
        while($record = $result->fetch_assoc()){
            $object_array[]=static::instantiate($record);
        }
        return $object_array;
    }

    static public function find_all(){
        $sql="select * from ".static::$tablename;
        return static::find_by_sql($sql);
    }

    static public function find_by_id($id){
        $sql="select * from ".static::$tablename;
        $sql.=" where ".static::$tableid."=".self::$cn_ob->escape_string($id)." ";
        $obj_array= static::find_by_sql($sql);
        if(!empty($obj_array)){
            //    return $obj_array;
            return    array_shift($obj_array);
        }else{
            return false;
        }
    }

    static public function instantiate($record){
        $object= new static();
        foreach ($record as $property => $value){
            if(property_exists($object,$property)){
                $object->$property=$value;
            }
        }
        return $object;
    }


    protected function validate(){
        $this->errors=[];

        //validation options
        return $this->errors;
    }

    public function create(){
        $this->validate();
        if(!empty($this->errors)){return false;}
        $attributes= $this->sanitized_attributes();
        $sql="insert into ".static::$tablename." (";
        $sql.=join(", ", array_keys($attributes));
        $sql.=" ) values ( '";
        $sql.=join("', '", array_values($attributes));
        $sql.="')";
        $result= self::$cn_ob->query($sql);
        //return $sql;
        if($result){
            $id=static::$tableid;
            $this->$id= self::$cn_ob->insert_id;
        }
        return $result;
    }

    public function  update(){
        $this->validate();
        if(!empty($this->errors)){return false;}
        $attributes=$this->sanitized_attributes();
        foreach ($attributes as $key=> $value){
            $att_pairs[]="{$key}='{$value}'";
        }
        $id= static::$tableid;
        $sql="update ".static::$tablename." set ";
        $sql.=join(", ", $att_pairs);
        $sql.="where ".static::$tableid." = ".self::$cn_ob->escape_string($this->$id)." ";
        //return $sql;
        $result=self::$cn_ob->query($sql);
        return $result;
    }

    public function save(){
        $id=static::$tableid;
        if(isset($this->$id)){
            return  $this->update();
        }else{
            return  $this->create();
        }
    }

    public function merge_attributes($args=[]){
        foreach ($args as $key => $value){
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key=$value;
            }
        }
    }
    public function attributes(){
        $attributes=[];
        foreach (static::$db_columns as $column){
            if($column===static::$tableid){continue;}

                $attributes[$column]= $this->$column;
        }
        return $attributes;
    }

    protected function sanitized_attributes(){
        $sanitized=[];
        foreach ($this->attributes() as $key => $value){
            $sanitized[$key]= self::$cn_ob->escape_string($value);
        }
        return $sanitized;
    }

    public function delete(){
        $id= static::$tableid;
        $sql="delete from ".static::$tablename." where ".static::$tableid."=".self::$cn_ob->escape_string($this->$id)." limit 1";
        $result= self::$cn_ob->query( $sql);
        return $result;
    }

    public function predicted_id(){
       $sql="select max(".static::$tableid.") from ".static::$tablename." ";
        $result=self::$cn_ob->query($sql);
        $d=$result->fetch_array();
            return $d[0]+1;
    }


}












?>