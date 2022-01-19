<?php


class Payment_dues{
    public $cas_id;
    public $dues;

    function get_cas_id($cas_id){
        $this -> cas_id=$cas_id;
    }


}