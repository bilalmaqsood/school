<?php
namespace App\Models;

class Period extends Schooledge {

    protected $table = 'tb_period';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public function division(){

        return $this->belongsTo('App\Models\Division');

    }
    public static function querySelect(  ){

        return "SELECT * FROM tb_period";
    }

    public static function queryWhere(  ){

        return "  WHERE tb_period.id IS NOT NULL";
    }

    public static function queryGroup(){
        return "  ";
    }

    public static function queryJoin(){

        return "";
    }
}