<?php
namespace App\Models;

class Financial extends Schooledge {

    protected $table = 'tb_payment';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public static function querySelect(  ){

        return "  SELECT tb_payment.* FROM tb_payment ";
    }

    public static function queryWhere(  ){
        $student_id = '';
        if(\Session::get('gid') == 6) {
            $student = \DB::table('tb_students')
                ->where('tb_students.user_id', '=', \Session::get('uid'))
                ->first();
            $student_id = " AND tb_payment.student_id = '$student->student_id' ";

        }
        $year_id = \Session::get('selected_year');
        return "  WHERE tb_payment.id IS NOT NULL AND tb_payment.year_id = '$year_id' $student_id";
    }

    public static function queryGroup(){
        return "  ";
    }
    public static function queryJoin(){
        return "";
    }
}