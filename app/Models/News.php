<?php
namespace App\Models;

class News extends Schooledge {

    protected $table = 'tb_news';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public static function querySelect(  ){

        return "  SELECT tb_news.* FROM tb_news ";
    }

    public static function queryWhere(  ){
        $year_id = \Session::get('selected_year');
        return "  WHERE tb_news.id IS NOT NULL AND tb_news.year_id = '$year_id'";
    }

    public static function queryGroup(){
        return "  ";
    }

    public static function queryJoin(){
        return "";
    }
}