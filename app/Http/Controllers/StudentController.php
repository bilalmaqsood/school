<?php
namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\User;
use App\Models\Parents;
use App\Models\Classes;
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
        $this->parent_model = new Parents();
        $this->info = $this->model->makeInfo($this->module);
        $this->access = $this->model->validAccess($this->info['id']);
        $this->data = array(
            'pageTitle'			=> 	'Students List',
            'pageNote'			=>  'View all student',
            'pageModule'		=> 'student',
            'pageUrl'			=>  url('student'),
            'return' 			=> 	self::returnUrl()
        );

    }

    public function getIndex()
    {
        if($this->access['is_view'] ==0)
            return Redirect::to('dashboard')->with('messagetext',\Lang::get('core.note_restric'))->with('msgstatus','error');

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
            $this->data['row'] = array_merge($studentFields,$userFields) ;
        }
        $this->data['id'] = $id;
        $this->data['parents'] = \DB::table('tb_parent')->join('tb_users', 'tb_parent.user_id', '=', 'tb_users.id')->select('tb_users.first_name', 'tb_users.last_name', 'tb_parent.parent_id as id')->get();
        $this->data['classes'] = \DB::table('tb_class')->select('tb_class.name', 'tb_class.id')->get();
        return view('student.form',$this->data);
    }


    function postSave( Request $request, $id =0)
    {
        $flag = 0;
        $rules = array(
            'email'=>'required|email|unique:tb_users'
        );
        $validator = Validator::make($request->all(), $rules);
        if($request->input('student_id') != '')
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
            $fields = $this->model->getColumnTable('tb_students');
            $data = $request->all();
            $user = array_diff_key($data, $fields);
            $student = array_intersect_key($data, $fields);
            $year_id = \Session::get('selected_year');
            if ($data['user_id'] == NULL) {
                $users = new User();
                $user['status'] = 1;
                $user['password'] = bcrypt($user['password']);
                $userId = $users->insertRow($user, $data['user_id']);
                $student['user_id'] = $userId;
                $id = $this->model->insertRow($student, $request->input('student_id'));
                \DB::table('tb_student_class')->insert(array('student_id'=>$id, 'class_id'=>$student['class_id'],'year_id'=>$year_id));
            } else {
                $id = $this->model->insertRow($student, $request->input('student_id'));
                if ($user['password'] == NULL) {
                    unset($user['password']);
                } else {
                    $user['password'] = bcrypt($user['password']);
                }
                $users = new User();
                $userId = $users->insertRow($user, $data['user_id']);
                \DB::table('tb_student_class')->insert(array('student_id'=>$id, 'class_id'=>$student['class_id'],'year_id'=>$year_id));
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
            $user_id = \DB::table('tb_students')->where('student_id', '=', $request->input('id'))->select('user_id')->get();
            User::where('id', '=', $user_id[0]->user_id)->delete();
            $this->model->destroy($request->input('id'));

            return response()->json(array(
                'status'=>'success',
                'message'=> 'delete successfully'
            ));
        } else {
            return response()->json(array(
                'status'=>'error',
                'message'=> 'Error'
            ));

        }

    }

    public function getShow( $id = null)
    {

        if($this->access['is_detail'] ==0)
            return Redirect::to('dashboard')
                ->with('messagetext', Lang::get('core.note_restric'))->with('msgstatus','error');

        $row = $this->model->getRow($id);
        $parent = $this->parent_model->getRow($row->parent_id);
        $this->data['id'] = $id;
        $this->data['parent']		= $parent;
        $this->data['row']		= $row;
        $this->data['access']		= $this->access;
        return view('student.view',$this->data);
    }
    function uploadFileThumbnail($file)
    {
        $width=100;
        $height=100;
        if(!empty($file)) {
            $destinationPath = public_path() . '/upload/images';

            $file = str_replace('data:image/png;base64,', '', $file);
            $img = str_replace(' ', '+', $file);
            $data = base64_decode($img);
            $filename = date('ymdhis') . '_croppedImage' . ".png";
            $file = $destinationPath . $filename;
            $success = file_put_contents($file, $data);

            // THEN RESIZE IT
            $returnData = $filename;
            $image = Image::make(file_get_contents(URL::asset($returnData)));
            $image = $image->resize($width,$height)->save($destinationPath . $filename);

            if($success){
                return $returnData;
            }
        }
    }

    function getStudentList($id = null)
    {
        $students = \DB::table('tb_student_class')
                ->join('tb_students', 'tb_student_class.student_id', '=', 'tb_students.student_id')
                ->join('tb_users', 'tb_students.user_id', '=', 'tb_users.id')
                ->where('tb_student_class.class_id', '=', $id)
                ->where('tb_student_class.year_id', '=', \Session::get('selected_year'))
                ->select('tb_users.first_name', 'tb_users.last_name')
                ->get();
        $this->data['rows'] = $students;
        $this->data['class_id'] = $id;
        return view('student.list',$this->data);
    }
}