<?php
namespace App\Models;

class Teacher extends Schooledge {

    protected $table = 'tb_users';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }
}