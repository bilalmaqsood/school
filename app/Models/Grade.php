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

        return "  WHERE tb_grade.id IS NOT NULL ";
    }

    public static function queryGroup(){
        return "  ";
    }

    public static function queryJoin(){

        return " JOIN tb_subject ON tb_grade.subject_id=tb_subject.id JOIN tb_users ON tb_grade.student_id=tb_users.id";
    }
    public function gradeSheet($studentId){
         $result = \DB::select(
             "SELECT tb_grade.*,tb_subject.name As subject_name,tb_users.first_name As student_name,tb_class.name As class_name FROM tb_grade
              JOIN tb_subject ON tb_grade.subject_id=tb_subject.id JOIN tb_users ON tb_grade.student_id=tb_users.id
              JOIN tb_class ON tb_subject.class_id=tb_class.id
              WHERE tb_grade.student_id =".$studentId
              );
        return $result;
    }
}