<?php
namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ;

class StudentController extends Controller
{
 protected $layout = "layouts.main";
    protected $data = array();
    public $module = 'student';
    static $per_page	= '10';

    public function __construct()
    {
        parent::__construct();
        $this->model = new Student();
        $this->info = $this->model->makeInfo($this->module);
        $this->access = $this->model->validAccess($this->info['id']);
        $this->data = array(
            'pageTitle'			=> 	'Student',
            'pageNote'			=>  'Student',
            'pageModule'		=> 'student',
            'pageUrl'			=>  url('student'),
            'return' 			=> 	self::returnUrl()
        );

    }

    public function getIndex()
    {
        if($this->access['is_view'] ==0)
            return Redirect::to('dashboard');

        $this->data['access']		= $this->access;
        return view('student.index',$this->data);
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

        $this->data['rowData']		= $results['rows'];
        // Group users permission
        $this->data['access']		= $this->access;
        // Render into template
        return view('student.table',$this->data);

    }

    function getUpdate(Request $request, $id = NULL)
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

        $row = $this->model->getRow($id);

        if($row)
        {
            $this->data['row'] 		= (array)$row;
        } else {
            $userFields =   $this->model->getColumnTable('tb_students');
            $studentFields =   $this->model->getColumnTable('tb_users');
            $records = array_merge($studentFields,$userFields);
            $this->data['row'] = array_merge($studentFields,$userFields) ;
        }
        $this->data['id'] = $id;

        return view('student.form',$this->data);
    }


    function postSave( Request $request, $id =0)
    {
        $fields = $this->model->getColumnTable('tb_students');
        $data = $request->all();
        $user = array_diff_key($data,$fields);
        $student = array_intersect_key($data,$fields);

        if($data['user_id']== NULL){
            $users = new User();
            $userId = $users->insertRow($user , $data['user_id']);
            $student['user_id'] = $userId;
            $id = $this->model->insertRow($student , $request->input('id'));
        }
        else{
            $id = $this->model->insertRow($student , $request->input('id'));
            if($user['password'] == NULL ){
                unset($user['password']);
            }
            $users = new User();
            $userId = $users->insertRow($user , $data['user_id']);
        }

        return response()->json(array(
            'status'=>'success',
            'message'=> \Lang::get('core.note_success')
        ));

        /* $rules = $this->validateForm();
        $rules = [
                "last_name" => "required|min:8",
                "middle_name" => "required",
                "first_name" => "required",

        ];
        
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
        }*/

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
        $this->data['row2'] = Student::find($id)->getParent()->first();
        if($row)
        {
            $this->data['row'] =  $row;
        } else {
            $this->data['row'] = $this->model->getColumnTable('sb_invoiceproducts');
        }

        $this->data['id'] = $id;
        $this->data['access']		= $this->access;

            // dd($this->data);

        return view('student.view',$this->data);
    }

}