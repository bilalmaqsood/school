<?php
namespace App\Http\Controllers;
use App\Models\Teacher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ;

class TeacherController extends Controller
{
    protected $layout = "layouts.main";
    protected $data = array();
    public $module = 'teacher';
    static $per_page	= '10';

    public function __construct()
    {
        parent::__construct();
        $this->model = new Teacher();
        $this->info = $this->model->makeInfo($this->module);
        $this->access = $this->model->validAccess($this->info['id']);
        $this->data = array(
            'pageTitle'			=> 	'Teacher Module',
            'pageNote'			=>  'View All Teachers',
            'pageModule'		=> 'freelancer',
            'pageUrl'			=>  url('teacher'),
            'return' 			=> 	self::returnUrl()
        );

    }

    public function getIndex()
    {

    }
}