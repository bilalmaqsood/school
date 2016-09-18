<?php
namespace App\Models;

class Promote extends Schooledge {

    protected $table = 'tb_student_class';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public static function querySelect(  ){

        return "SELECT concat(tb_users.last_name, ' ',tb_users.first_name) as student_name, tb_student_class.id, tb_student_class.student_id, tb_student_class.status, tb_class.name as class_name from tb_student_class";
    }

    public static function queryWhere(  ){
        $year_id = \Session::get('selected_year');
        return "  WHERE tb_student_class.id IS NOT NULL AND tb_student_class.year_id = $year_id";
    }

    public static function queryGroup(){
        return " ";
    }

    public static function queryJoin(){
        return "  join tb_students on tb_student_class.student_id = tb_students.student_id join tb_users on
tb_students.user_id = tb_users.id join tb_class on tb_student_class.class_id = tb_class.id";
    }



}