<?php
namespace App\Models;

class Event extends Schooledge {

    protected $table = 'tb_event';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public static function querySelect(  ){

        return "  SELECT tb_event.* FROM tb_event ";
    }

    public static function queryWhere(){
        $year_id = \Session::get('selected_year');
        return "  WHERE tb_event.id IS NOT NULL AND tb_event.year_id = '$year_id'";
    }

    public static function queryGroup(){
        return "  ";
    }
    public static function queryJoin(){
        return "";
    }
}