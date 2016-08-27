<?php 
namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Student extends Schooledge  {
	
	protected $table = 'tb_students';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_students.* FROM tb_students  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_students.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	public function getParent(){
		 return $this->hasOne( 'App\Models\Parents', 'id', 'parent_id' );
	}
}
