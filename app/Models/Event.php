<?php
namespace App\Models;

class Event extends Schooledge {

    protected $table = 'tb_news';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public static function querySelect(  ){

        return "  SELECT tb_event.* FROM tb_event ";
    }

    public static function queryWhere(  ){

        return "  WHERE tb_event.id IS NOT NULL";
    }

    public static function queryGroup(){
        return "  ";
    }
}