<?php
namespace App\Models;

class ClassSchedule extends Schooledge {

    protected $table = 'tb_classes_schedule';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public static function querySelect(  ){

        return "SELECT tb_classes_schedule.*,tb_subject.name As subject_name,tb_period.name as period_no FROM tb_classes_schedule";
    }

    public static function queryWhere(  ){

        return "  WHERE tb_classes_schedule.id IS NOT NULL";
    }

    public static function queryGroup(){
        return "  ";
    }

    public static function queryJoin(){

        return " JOIN tb_subject ON tb_classes_schedule.subject_id=tb_subject.id JOIN tb_period ON tb_classes_schedule.period_id=tb_period.id";
    }
    public static function classSchedule( )
    {
        $rows = array();
        $result = \DB::select("SELECT tb_classes_schedule.*,
        tb_subject.name As subject_name,
        tb_users.first_name,
        tb_period.name as period_no,tb_period.start_time as period_start_time,tb_period.end_time as period_end_time
        FROM tb_classes_schedule
            JOIN tb_subject ON tb_classes_schedule.subject_id=tb_subject.id
            JOIN tb_users ON tb_subject.teacher_id=tb_users.id
            JOIN tb_period ON tb_classes_schedule.period_id=tb_period.id
            Order By day_of_week");

        return $result;

    }
}