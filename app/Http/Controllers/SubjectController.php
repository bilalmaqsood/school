<?php
namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Classes;
use App\Models\User;
use App\Models\Teacher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ;

class SubjectController extends Controller
{
    protected $layout = "layouts.main";
    protected $data = array();
    public $module = 'class';
    static $per_page	= '10';

    public function __construct()
    {
        parent::__construct();
        $this->model = new Subject();
        $this->info = $this->model->makeInfo($this->module);
        $this->access = $this->model->validAccess($this->info['id']);
        $this->data = array(
            'pageTitle'			=> 	'Subject',
            'pageNote'			=>  'View All Subject',
            'pageModule'		=> 'subject',
            'pageUrl'			=>  url('subject'),
            'return' 			=> 	self::returnUrl()
        );

    }

    public function getIndex()
    {
        if($this->access['is_view'] ==0)
            return Redirect::to('dashboard');

        $this->data['access']   = $this->access;
        return view('subject.index',$this->data);
    }

    public function postData( Request $request)
    {
        $sort = (!is_null($request->input('sort')) ? $request->input('sort') : 'desc');
        $order = (!is_null($request->input('order')) ? $request->input('order') : '');
        // End Filter sort and order for query
        // Filter Search for query
        $filter = (!is_null($request->input('search')) ? $this->buildSearch() : '');


        $page = $request->input('page', 1);
        $params = array(
            'page'		=> $page ,
            'limit'		=> (!is_null($request->input('rows')) ? filter_var($request->input('rows'),FILTER_VALIDATE_INT) : 25 ) ,
            'sort'		=> $sort ,
            'order'		=> $order,
            'params'	=> $filter,
            'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
        );
        // Get Query
        $results = $this->model->getRows( $params );
        //$results = $this->model->getRecords( $params );

        $this->data['rowData']		= $results['rows'];

        // Group users permission
        $this->data['access']		= $this->access;
        // Render into template
        return view('subject.table',$this->data);

    }

    function getUpdate(Request $request, $id = null)
    {

        if($id =='')
        {
            if($this->access['is_add'] ==0 )
                return Redirect::to('dashboard')->with('messagetext',\Lang::get('core.note_restric'))->with('msgstatus','error');
        }

        if($id !='')
        {
            if($this->access['is_edit'] ==0 )
                return Redirect::to('dashboard')->with('messagetext',\Lang::get('core.note_restric'))->with('msgstatus','error');
        }

        $row = $this->model->find($id);
        if($row)
        {
            $this->data['row'] 		=  $row;
        } else {
            $this->data['row'] 		= $this->model->getColumnTable('tb_class');
        }

        $this->data['id'] = $id;
        $this->data['classes'] = Classes::lists('name','id');
        $this->data['teacher'] = Teacher::join('tb_users', 'tb_teachers.user_id', '=' ,'tb_users.id')->select('tb_teachers.id' ,\DB::raw('concat(tb_users.first_name, " ",tb_users.last_name) as name'))->lists('name','id');

        return view('subject.form',$this->data);
    }


    function postSave( Request $request, $id =0)
    {
        $data = $request->all();
        $id = $this->model->insertRow($data , $request->input('id'));

        return response()->json(array(
            'status'=>'success',
            'message'=> \Lang::get('core.note_success')
        ));

        $rules = $this->validateForm();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $data = $this->validatePost('sb_invoiceproducts');

            $id = $this->model->insertRow($data , $request->input('ProductID'));

            return response()->json(array(
                'status'=>'success',
                'message'=> \Lang::get('core.note_success')
            ));

        } else {

            $message = $this->validateListError(  $validator->getMessageBag()->toArray() );
            return Response::json(array(
                'message'	=> $message,
                'status'	=> 'error'
            ));
        }

    }

    public function postDelete( Request $request)
    {
        if($this->access['is_remove'] ==0) {
            return response()->json(array(
                'status'=>'error',
                'message'=> \Lang::get('core.note_restric')
            ));
            die;

        }
        // delete multipe rows
        if(count($request->input('id')) >=1)
        {
            $this->model->destroy($request->input('id'));

            return response()->json(array(
                'status'=>'success',
                'message'=> 'delete successfully'
            ));
        } else {
            return response()->json(array(
                'status'=>'error',
                'message'=> 'error in delete'
            ));

        }

    }

    public function getShow( $id = null)
    {

        if($this->access['is_detail'] ==0)
            return Redirect::to('dashboard')
                ->with('messagetext', Lang::get('core.note_restric'))->with('msgstatus','error');

        $row = $this->model->getRow($id);
        if($row)
        {
            $this->data['row'] =  $row;
        } else {
            $this->data['row'] = $this->model->getColumnTable('sb_invoiceproducts');
        }

        $this->data['id'] = $id;
        $this->data['access']		= $this->access;
        return view('subject.view',$this->data);
    }


    public function getStudentSubject( $id = null)
    {
        if(\Session::get('gid') == 6)
        {
            $student = \DB::table('tb_students')
                        ->where('tb_students.user_id', '=', \Session::get('uid'))
                        ->first();
            $class = \DB::table('tb_student_class')
                        ->join('tb_class', 'tb_student_class.class_id', '=', 'tb_class.id')
                        ->join('tb_division', 'tb_class.division_id', '=' ,'tb_division.id')
                        ->where('student_id', '=', $student->student_id)
                        ->where('year_id', '=', \Session::get('selected_year'))
                        ->select('tb_student_class.*', 'tb_class.name as class_name', 'tb_division.name as division_name')
                        ->get();
            if(count($class) > 0)
            {
                $rows = \DB::table('tb_subject')
                        ->join('tb_teachers', 'tb_subject.teacher_id', '=', 'tb_teachers.id')
                        ->join('tb_users', 'tb_teachers.user_id', '=', 'tb_users.id')
                        ->where('tb_subject.class_id', '=', $class[0]->class_id)
                        ->where('year_id', '=', \Session::get('selected_year'))
                        ->select('tb_subject.name as subject_name', 'tb_users.first_name', 'tb_users.last_name')
                        ->get();
            }
            $this->data['class'] = isset($class[0]) ? $class[0]->class_name : '';
            $this->data['division'] = isset($class[0]) ? $class[0]->division_name : '';
            $this->data['status'] = isset($class[0]) ? $class[0]->status : '';
            $this->data['rows'] = isset($rows) ? $rows : array();
            return view('student.mysubjects',$this->data);
        }
        return Redirect::to('dashboard');
    }

    public function getTeacherSubject( $id = null)
    {
        if(\Session::get('gid') == 5)
        {
            $teacher = \DB::table('tb_teachers')
                ->where('tb_teachers.user_id', '=', \Session::get('uid'))
                ->first();
            $rows = \DB::table('tb_subject')
                ->join('tb_class', 'tb_subject.class_id', '=' ,'tb_class.id')
                ->join('tb_division', 'tb_class.division_id', '=' ,'tb_division.id')
                ->where('tb_subject.teacher_id', '=', $teacher->id)
                ->where('tb_subject.year_id', '=', \Session::get('selected_year'))
                ->select('tb_subject.name as subject_name', 'tb_class.id', 'tb_class.name as class_name', 'tb_division.name as division_name')
                ->get();
            $this->data['rows'] = $rows;
            return view('teacher.mysubjects',$this->data);
        }
        return Redirect::to('dashboard');
    }
}