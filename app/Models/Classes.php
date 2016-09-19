<?php
namespace App\Models;

class Classes extends Schooledge {

    protected $table = 'tb_class';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public function division(){

        return $this->belongsTo('App\Models\Division');

    }
    public static function querySelect(  ){

        return "SELECT tb_class.*,tb_division.name As division_name FROM tb_class";
    }

    public static function queryWhere(  ){
        return "  WHERE tb_class.id IS NOT NULL";
    }

    public static function queryGroup(){
        return "  ";
    }

    public static function queryJoin(){
        return " JOIN tb_division ON tb_class.division_id=tb_division.id";
    }
}