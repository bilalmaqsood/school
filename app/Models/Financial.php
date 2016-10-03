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
        $year_id = \Session::get('selected_year');
        return " WHERE tb_payment.id IS NOT NULL AND tb_payment.year_id = '$year_id'";
    }

    public static function queryGroup(){
        return "  ";
    }
    public static function queryJoin(){
        return "";
    }
}