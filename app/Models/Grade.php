<?php
namespace App\Models;

class Grade extends Schooledge {

    protected $table = 'tb_grade';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public static function querySelect(  ){

        return "SELECT tb_grade.*,tb_subject.name As subject_name FROM tb_grade";
    }

    public static function queryWhere(  ){
        $year_id = \Session::get('selected_year');
        return "  WHERE tb_grade.id IS NOT NULL AND tb_grade.year_id = '$year_id'";
    }

    public static function queryGroup(){
        return "  ";
    }

    public static function queryJoin(){

        return " JOIN tb_subject ON tb_grade.subject_id=tb_subject.id JOIN tb_users ON tb_grade.student_id=tb_users.id";
    }
    public function gradeSheet($studentId, $classId){
        $year_id = \Session::get('selected_year');
         $result = \DB::select(
             "SELECT tb_grade.*,tb_subject.name As subject_name, concat(tb_users.first_name, ' ', tb_users.last_name) As student_name,tb_class.name As class_name
              FROM tb_grade
              LEFT JOIN tb_subject ON tb_grade.subject_id=tb_subject.id
              JOIN tb_students on tb_grade.student_id = tb_students.student_id
              JOIN tb_users ON tb_students.user_id = tb_users.id
              LEFT JOIN tb_class ON tb_subject.class_id=tb_class.id
              WHERE tb_grade.class_id =".$classId." AND tb_grade.student_id =".$studentId." AND tb_grade.year_id = '$year_id'"
              );
        return $result;
    }
}