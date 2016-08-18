<?php 
namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Student extends Schooledge  {
	
	protected $table = 'tb_users';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_user.* FROM tb_user  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_user.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];
}
