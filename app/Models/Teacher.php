<?php
namespace App\Models;

class Teacher extends Schooledge {

    protected $table = 'tb_users';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public static function querySelect(  ){

        return "  SELECT tb_users.* FROM tb_users  ";
    }

    public static function queryWhere(  ){

        return "  WHERE tb_users.id IS NOT NULL";
    }

    public static function queryGroup(){
        return "  ";
    }
}