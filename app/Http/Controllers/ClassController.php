<?php
namespace App\Http\Controllers;
use App\Models\Classes;
use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ;

class ClassController extends Controller
{
    protected $layout = "layouts.main";
    protected $data = array();
    public $module = 'class';
    static $per_page	= '10';

    public function __construct()
    {
        parent::__construct();
        $this->model = new Classes();
        $this->info = $this->model->makeInfo($this->module);
        $this->access = $this->model->validAccess($this->info['id']);
        $this->data = array(
            'pageTitle'			=> 	'Class',
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
        return view('class.index',$this->data);
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
        //$results = $this->model->getRows( $params );
        $results = $this->model->getRecords( $params );

        $this->data['rowData']		= $results['rows'];

        // Group users permission
        $this->data['access']		= $this->access;
        // Render into template
        return view('class.table',$this->data);

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
        $this->data['divisions'] = Division::lists('name','id');
        return view('class.form',$this->data);
    }


    function postSave( Request $request, $id =0)
    {
        $data = $request->all();
        if(isset($data['status']))
            $data['status'] = 1;
        else
            $data['status'] = 0;
        $id = $this->model->insertRow($data , $request->input('id'));

        return response()->json(array(
            'status'=>'success',
            'message'=> \Lang::get('core.note_success')
        ));

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

    public function getStudentClasses( $id = null)
    {
        if(\Session::get('gid') == 6)
        {
            $student = \DB::table('tb_students')
                ->where('tb_students.user_id', '=', \Session::get('uid'))
                ->first();
            $rows = \DB::table('tb_student_class')
                ->join('tb_class', 'tb_student_class.class_id', '=' ,'tb_class.id')
                ->join('tb_division', 'tb_class.division_id', '=' ,'tb_division.id')
                ->where('tb_student_class.student_id', '=', $student->student_id)
                ->orderBy('tb_student_class.class_id', 'desc')
                ->select('tb_student_class.*', 'tb_class.name as class_name', 'tb_division.name as division_name')
                ->get();
            $this->data['rows'] = $rows;
            return view('student.myclasses',$this->data);
        }
        return Redirect::to('dashboard');
    }

    public function getTeacherClasses( $id = null)
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
                ->groupBy('tb_subject.class_id')
                ->select('tb_class.id', 'tb_class.name as class_name', 'tb_division.name as division_name')
                ->get();
            $this->data['rows'] = $rows;
            return view('teacher.myclasses',$this->data);
        }
        return Redirect::to('dashboard');
    }

}