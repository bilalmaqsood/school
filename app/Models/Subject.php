<?php
namespace App\Models;

class Subject extends Schooledge {

    protected $table = 'tb_subject';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public static function querySelect(  ){

        return "SELECT tb_subject.*,tb_class.name As class_name,tb_users.first_name as teacher_name FROM tb_subject";
    }

    public static function queryWhere(  ){

        return "  WHERE tb_subject.id IS NOT NULL";
    }

    public static function queryGroup(){
        return "  ";
    }

    public static function queryJoin(){

        return " JOIN tb_class ON tb_subject.class_id=tb_class.id JOIN tb_users ON tb_subject.teacher_id=tb_users.id";
    }
}