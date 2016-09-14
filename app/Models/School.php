<?php
namespace App\Models;

class School extends Schooledge {

    protected $table = 'tb_school';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public static function querySelect(  ){

        return "  SELECT tb_school.* FROM tb_school ";
    }

    public static function queryWhere(  ){

        return "  WHERE tb_school.id IS NOT NULL";
    }

    public static function queryGroup(){
        return "  ";
    }
    public static function queryJoin(){
        return "";
    }
}