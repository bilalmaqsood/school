<?php
namespace App\Models;

class Mastergradebook extends Schooledge {

    protected $table = 'tb_grade';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public static function querySelect(  ){

        return "  SELECT tb_grade.* FROM tb_grade ";
    }

    public static function queryWhere(  ){

        return "  WHERE tb_grade.id IS NOT NULL";
    }

    public static function queryGroup(){
        return "  ";
    }

    public static function queryJoin(){
        return "";
    }
}