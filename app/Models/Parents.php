<?php
namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Parents extends Schooledge  {

    protected $table = 'tb_parent';
    protected $primaryKey = 'parent_id';

    public function __construct() {
        parent::__construct();

    }

    public static function querySelect(  ){

        return "  SELECT tb_users.*, tb_parent.* FROM tb_parent  ";

    }

    public static function queryWhere(  ){

        $year_id = \Session::get('selected_year');
        return "  WHERE tb_parent.parent_id IS NOT NULL AND tb_parent.year_id = '$year_id'";
    }

    public static function queryGroup(){
        return "";
    }

    public static function queryJoin(){
        return " JOIN tb_users ON tb_parent.user_id = tb_users.id ";
    }

}
