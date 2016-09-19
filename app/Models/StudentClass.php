<?php
namespace App\Models;

class StudentClass extends Schooledge {

    protected $table = 'tb_student_class';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public static function querySelect(  ){

        return "SELECT COUNT(tb_student_class.student_id) as total, tb_student_class.class_id, tb_student_class.id, tb_class.name FROM tb_student_class";
    }

    public static function queryWhere(  ){
        $year_id = \Session::get('selected_year');
        return "  WHERE tb_student_class.id IS NOT NULL AND tb_student_class.year_id = $year_id";
    }

    public static function queryGroup(){
        return "  group by tb_student_class.class_id";
    }

    public static function queryJoin(){
        return " join tb_class on tb_student_class.class_id = tb_class.id";
    }

}