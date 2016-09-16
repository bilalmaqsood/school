<?php 
namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Student extends Schooledge  {
	
	protected $table = 'tb_students';
	protected $primaryKey = 'student_id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(){

		return "  SELECT tb_users.*,tb_students.* FROM tb_students  ";
	}

	public static function queryWhere(){
		return "  WHERE tb_students.student_id IS NOT NULL";
	}
	
	public static function queryGroup(){
		return "  ";
	}

	public static function queryJoin(){
		return " JOIN tb_class ON tb_students.class_id=tb_class.id JOIN tb_users ON tb_students.user_id=tb_users.id";
	}
}
