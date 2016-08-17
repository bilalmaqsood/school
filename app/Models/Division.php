<?php
namespace App\Models;

class Division extends Schooledge {

    protected $table = 'tb_division';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public static function querySelect(  ){

        return "SELECT * FROM tb_division";
    }

    public static function queryWhere(  ){

        return "  WHERE tb_division.id IS NOT NULL";
    }

    public static function queryGroup(){
        return "  ";
    }
}