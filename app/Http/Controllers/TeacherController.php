<?php
namespace App\Http\Controllers;
use App\Models\Teacher;
use App\Models\User;
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
            'pageTitle'			=> 	'Teachers',
            'pageNote'			=>  'View All Teachers',
            'pageModule'		=> 'teacher',
            'pageUrl'			=>  url('teacher'),
            'return' 			=> 	self::returnUrl()
        );

    }

    public function getIndex()
    {
        if($this->access['is_view'] ==0)
            return Redirect::to('dashboard')->with('messagetext',\Lang::get('core.note_restric'))->with('msgstatus','error');

        $this->data['access']		= $this->access;
        return view('teacher.index',$this->data);
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
        return view('teacher.table',$this->data);

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

        $row = $this->model->getRow($id);
        if($row)
        {
            $this->data['row'] 		=  (array)$row;
        } else {
            $teacherFields =   $this->model->getColumnTable('tb_teachers');
            unset($teacherFields['id']);
            $teacherFields["teacher_id"] = "";
            $userFields =   $this->model->getColumnTable('tb_users');
            $this->data['row'] = array_merge($teacherFields,$userFields) ;
        }
        $this->data['id'] = $id;
        return view('teacher.form',$this->data);
    }


    function postSave( Request $request, $id =0)
    {
        $flag = 0;
        $rules = array(
            'email'=>'required|email|unique:tb_users,email,'.$request->input('user_id')
        );
        $data = $request->all();
        $validator = Validator::make($request->all(), $rules);
        if($request->input('teacher_id') != '')
        {
            $flag = 1;
        }
        else
        {
            if($validator->passes())
                $flag = 1;
            else
                $flag = 0;
        }
        if ($flag != 0)
        {
            $fields = $this->model->getColumnTable('tb_teachers');
            $data = $request->all();
            $user = array_diff_key($data, $fields);
            unset($user['teacher_id']);
            $teacher = array_intersect_key($data, $fields);
            $teacher['id'] = $request->input('teacher_id');
            if ($data['user_id'] == NULL) {
                $users = new User();
                $user['status'] = 1;
                $user['password'] = bcrypt($user['password']);
                $userId = $users->insertRow($user, $data['user_id']);
                $teacher['user_id'] = $userId;
                $id = $this->model->insertRow($teacher, $request->input('teacher_id'));
            } else {
                $id = $this->model->insertRow($teacher, $request->input('teacher_id'));
                if ($user['password'] == NULL) {
                    unset($user['password']);
                } else {
                    $user['password'] = bcrypt($user['password']);
                }
                $users = new User();
                $userId = $users->insertRow($user, $data['user_id']);
            }

            return response()->json(array(
                'status' => 'success',
                'message' => \Lang::get('core.note_success')
            ));
        }
        else
        {
            return response()->json(array(
                'status' => 'error',
                'message' => 'Sorry, This email address already exist.'
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
            $user_id = \DB::table('tb_teachers')->where('id', '=', $request->input('id'))->select('user_id')->get();
            User::where('id', '=', $user_id[0]->user_id)->delete();
            $this->model->destroy($request->input('id'));

            return response()->json(array(
                'status'=>'success',
                'message'=> 'delete successfully'
            ));
            $this->model->destroy($request->input('id'));

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
        return view('teacher.view',$this->data);
    }

}