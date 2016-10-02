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

        return "SELECT tb_subject.*,tb_class.name As class_name, concat(tb_users.first_name, ' ',tb_users.last_name) as teacher_name FROM tb_subject";
    }

    public static function queryWhere(  ){
        $year_id = \Session::get('selected_year');
        return "  WHERE tb_subject.id IS NOT NULL  AND tb_subject.year_id = '$year_id'";
    }

    public static function queryGroup(){
        return "  ";
    }

    public static function queryJoin(){

        return " Left JOIN tb_class ON tb_subject.class_id=tb_class.id Left JOIN tb_teachers on tb_subject.teacher_id = tb_teachers.id Left JOIN tb_users ON tb_teachers.user_id=tb_users.id";
    }

}
