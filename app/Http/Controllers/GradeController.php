<?php
namespace App\Http\Controllers;

use App\Models\Grade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ;
use PDF;
class GradeController extends Controller
{
    protected $layout = "layouts.main";
    protected $data = array();
    public $module = 'gradebook';
    static $per_page	= '10';

    public function __construct()
    {
        parent::__construct();
        $this->model = new Grade();
        $this->info = $this->model->makeInfo($this->module);
        $this->access = $this->model->validAccess($this->info['id']);
        $this->data = array(
            'pageTitle'			=> 	'Grade Sheet',
            'pageNote'			=>  '',
            'pageModule'		=> 'gradesheet',
            'pageUrl'			=>  url('gradesheet'),
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

    public function postMarkSheet(Request $request)
    {
        $this->data['access']		= $this->access;
        return view('grade.mark-sheet', $this->data);
    }

    public function postShow( Request $request)
    {

        if($this->access['is_detail'] ==0)
            return Redirect::to('dashboard')
                ->with('messagetext', Lang::get('core.note_restric'))->with('msgstatus','error');

        $row = $this->model->gradeSheet($request->input('student'), $request->input('class'));
        $this->data['rowData'] =  $row;
        $this->data['id'] = $request->input('student');
        $this->data['class'] = $request->input('class');
        $this->data['access']		= $this->access;
        return view('grade.view',$this->data);
    }

    public function getDownloadGradesheet( Request $request)
    {
        $row = $this->model->gradeSheet($request->input('student'), $request->input('class'));
        $data['rowData'] =  $row;
        $data['id'] = $request->input('student');
        $data['class'] = $request->input('class');
        $pdf = PDF::loadView('grade.gradesheet', $data);
        return $pdf->download('gradesheet.pdf');
    }
}