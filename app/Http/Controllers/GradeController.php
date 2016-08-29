<?php
namespace App\Http\Controllers;

use App\Models\Grade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ;

class GradeController extends Controller
{
    protected $layout = "layouts.main";
    protected $data = array();
    public $module = 'class';
    static $per_page	= '10';

    public function __construct()
    {
        parent::__construct();
        $this->model = new Grade();
        $this->info = $this->model->makeInfo($this->module);
        $this->access = $this->model->validAccess($this->info['id']);
        $this->data = array(
            'pageTitle'			=> 	'Grade Sheets',
            'pageNote'			=>  'View All Classes',
            'pageModule'		=> 'class',
            'pageUrl'			=>  url('class'),
            'return' 			=> 	self::returnUrl()
        );

    }

    public function getIndex()
    {
        if($this->access['is_view'] ==0)
            return Redirect::to('dashboard');

        $this->data['access']   = $this->access;
        return view('grade.index',$this->data);
    }

    public function getShow( $id = null)
    {
        if($this->access['is_detail'] ==0)
            return Redirect::to('dashboard')
                ->with('messagetext', Lang::get('core.note_restric'))->with('msgstatus','error');

        $row = $this->model->gradeSheet($id);
        if($row)
        {
            $this->data['rowData'] =  $row;
        } else {
            $this->data['row'] = $this->model->getColumnTable('tb_grade');
        }

        $this->data['id'] = $id;
        $this->data['access']		= $this->access;
        return view('grade.view',$this->data);
    }
}