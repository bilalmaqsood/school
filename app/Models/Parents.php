<?php
namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Parents extends Schooledge  {

    protected $table = 'tb_parent';
    protected $primaryKey = 'id';

    public function __construct() {
        parent::__construct();

    }

    public static function querySelect(  ){

        return "  SELECT tb_parent.* FROM tb_parent  ";
    }

    public static function queryWhere(  ){

        return "  WHERE tb_parent.id IS NOT NULL ";
    }

    public static function queryGroup(){
        return "  ";
    }

    public static function queryJoin(){
        return "";
    }

}
