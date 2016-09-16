<?php
namespace App\Models;

class Teacher extends Schooledge {

    protected $table = 'tb_teachers';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public static function querySelect(  ){

        return "SELECT tb_users.*,tb_teachers.* FROM tb_teachers";
    }

    public static function queryWhere(  ){
        $year_id = \Session::get('selected_year');
        return " WHERE tb_teachers.id IS NOT NULL";
    }

    public static function queryGroup(){
        return "  ";
    }

    public static function queryJoin(){
        return " JOIN tb_users ON tb_teachers.user_id=tb_users.id";
    }
}