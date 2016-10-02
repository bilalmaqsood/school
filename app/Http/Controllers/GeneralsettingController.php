<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ;

class GeneralsettingController extends Controller
{
    protected $layout = "layouts.main";
    protected $data = array();
    public $module = 'setting';
    static $per_page	= '10';

    public function __construct()
    {
        parent::__construct();
        $this->model = new School();
        $this->data = array(
            'pageTitle'			=> 	'General Setting',
            'pageNote'			=>  'Manage School Year',
            'pageModule'		=> 'setting',
            'pageUrl'			=>  url('setting'),
            'return' 			=> 	self::returnUrl()
        );

    }

    public function getIndex()
    {
        if(\Session::get('gid') != 1)
            return Redirect::to('dashboard');

        return view('setting.index',$this->data);
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
            'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 1 )
        );
        // Get Query
        $results = $this->model->getRows( $params );

        $this->data['rowData']		= $results['rows'];
        // Render into template
        return view('setting.table',$this->data);

    }

    function getUpdate(Request $request, $id = null)
    {

        if(\Session::get('gid') != 1)
            return Redirect::to('dashboard');

        $row = $this->model->find($id);
        if($row)
        {
            $this->data['row'] 		=  $row;
        } else {
            $this->data['row'] 		= $this->model->getColumnTable('tb_school');
        }
        $this->data['id'] = $id;

        return view('setting.form',$this->data);
    }


    function postSave( Request $request, $id =0)
    {
        $rules = array();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $data = $request->all();
            $id = $this->model->insertRow($data , $request->input('id'));
            $school_year = \DB::table('tb_school')->select('id', 'year')->orderBy('id', 'desc')->get();
            \Session::put('selected_year', $school_year[0]->id);
            \Session::put('school_year', $school_year);
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
        if(\Session::get('gid') != 1)
            return Redirect::to('dashboard');
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
        return view('event.view',$this->data);
    }

    public function getSidemenu()
    {
        $modules = array(
            0 => 'Dashboard',
            1 => 'Students',
            2 => 'Teachers',
            3 => 'Parents',
            4 => 'Divisions',
            5 => 'Classes',
            6 => 'Subjects',
            7 => 'Classes Schedule',
            8 => 'School Calender',
            9 => 'News',
            10 => 'Events',
            11 => 'Grading System',
            12 => 'Finance',
            13 => 'Administrator Task',
            14 => 'Media Center',
        );
        $principal = \DB::table('tb_group')->select('tb_group.data_access')->where('id', 2)->get();
        $registrar = \DB::table('tb_group')->select('tb_group.data_access')->where('id', 3)->get();
        $finance = \DB::table('tb_group')->select('tb_group.data_access')->where('id', 4)->get();
        $teacher = \DB::table('tb_group')->select('tb_group.data_access')->where('id', 5)->get();
        $student = \DB::table('tb_group')->select('tb_group.data_access')->where('id', 6)->get();
        $this->data['modules'] = $modules;
        $this->data['principal'] = json_decode($principal[0]->data_access);
        $this->data['registrar'] = json_decode($registrar[0]->data_access);
        $this->data['finance'] = json_decode($finance[0]->data_access);
        $this->data['teacher'] = json_decode($teacher[0]->data_access);
        $this->data['student'] = json_decode($student[0]->data_access);
        return view('setting.sidemenu', $this->data);
    }

    public function postSaveSideMenuData(Request $request)
    {
        $data = $request->all();
        $defaultArray = array(
            0 => "0",
            1 => "0",
            2 => "0",
            3 => "0",
            4 => "0",
            5 => "0",
            6 => "0",
            7 => "0",
            8 => "0",
            9 => "0",
            10 => "0",
            11 => "0",
            12 => "0",
            13 => "0",
            14 => "0",
        );
        if(isset($data['principal']))
            $principal = array_replace($defaultArray, $data['principal']);
        else
            $principal = $defaultArray;
        if(isset($data['registrar']))
            $registrar = array_replace($defaultArray, $data['registrar']);
        else
            $registrar = $defaultArray;
        if(isset($data['finance']))
            $finance = array_replace($defaultArray, $data['finance']);
        else
            $finance = $defaultArray;
        if(isset($data['teacher']))
            $teacher = array_replace($defaultArray, $data['teacher']);
        else
            $teacher = $defaultArray;
        if(isset($data['student']))
            $student = array_replace($defaultArray, $data['student']);
        else
            $student = $defaultArray;
        $principal = json_encode($principal);
        $registrar = json_encode($registrar);
        $finance = json_encode($finance);
        $teacher = json_encode($teacher);
        $student = json_encode($student);

        \DB::table('tb_group')->where('id',2)->update(array('data_access'=>$principal));
        \DB::table('tb_group')->where('id',3)->update(array('data_access'=>$registrar));
        \DB::table('tb_group')->where('id',4)->update(array('data_access'=>$finance));
        \DB::table('tb_group')->where('id',5)->update(array('data_access'=>$teacher));
        \DB::table('tb_group')->where('id',6)->update(array('data_access'=>$student));

        return response()->json(array(
            'status'=>'success',
            'message'=> \Lang::get('core.note_success')
        ));
    }

    public function getModuleaccess()
    {
        $groups = \DB::table('tb_group')
            ->limit(6)
            ->get();

        $modules = array(
            0 => 'Dashboard',
            1 => 'Students',
            2 => 'Teachers',
            3 => 'Parents',
            4 => 'Divisions',
            5 => 'Classes',
            6 => 'Subjects',
            7 => 'Classes Schedule',
            8 => 'School Calender',
            9 => 'News',
            10 => 'Events',
            11 => 'Grading System',
            12 => 'Finance',
            13 => 'Administrator Task',
            14 => 'Media Center',
        );
        $dataAccess = array();
        foreach($groups as $group){
            foreach($modules as $moduleKey => $moduleName){
                $modulePermission = \DB::table('tb_group_access')->where('group_id',$group->id)->where('module_id',$moduleKey)->get();
                if(!empty($modulePermission)){
                    $dataAccess[$group->id][$moduleKey] = json_decode($modulePermission[0]->data_access,true);
                }
                else{
                    $dataAccess[$group->id][$moduleKey] = array ('is_global' => 0 ,'is_view' => 0, 'is_detail' => 0, 'is_add' => 0, 'is_edit' => 0, 'is_remove' => 0, 'is_excel' => 0 ) ;
                }
            }
        }

        $this->data['modules'] = $modules;
        $this->data['groups'] = $groups;
        $this->data['access'] = $dataAccess;

        return view('setting.module_access', $this->data);
    }

    public function getGeneral()
    {
        return view('setting.general_setting', $this->data);
    }

    public function postSaveGeneralSetting(Request $request)
    {
        $rules = array(
            'school_name' => 'required|min:2',
            'school_address' => 'required|min:2',
            'school_no' => 'required|min:2',
            'school_email' => 'required|email',
        );
        $validator = Validator::make($request->all(), $rules);
        if (!$validator->fails())
        {
            $val = "<?php \n";
            $val .= "define('CNF_APPNAME','" . $request->input('school_name') . "');\n";
            $val .= "define('CNF_APPADDRESS','" . $request->input('school_address') . "');\n";
            $val .= "define('CNF_APPEMAIL','" . $request->input('school_email') . "');\n";
            $val .= "define('CNF_APPNO','" . $request->input('school_no') . "');\n";
            $val .= "define('CNF_FRONT','true');\n";
            $val .= "define('CNF_DATEFORMAT','" . $request->input('school_date_format') . "');\n";
            $val .= "define('CNF_TIMEFORMAT','" . $request->input('school_time_format') . "');\n";
            $val .= "define('CNF_CURRENCY','" . $request->input('school_currency_format') . "');\n";
            $val .= "?>";
            $filename = base_path() . '/public/setting.php';
            $fp = fopen($filename, "w+");
            fwrite($fp, $val);
            fclose($fp);
            return response()->json(array(
                'status'=>'success',
                'message'=> \Lang::get('core.note_success')
            ));
        }
        else {
            $message = $this->validateListError(  $validator->getMessageBag()->toArray() );
            return response()->json(array(
                'message'	=> $message,
                'status'	=> 'error'
            ));
        }
    }
    public function postSavePermission(Request $request)
    {
        $data = $request->all();
        $noPermission = array('is_global'=>0,'is_view'=>0,'is_detail'=>0,'is_edit'=>0,'is_remove'=>0,'is_add'=>0);
        foreach($data['permission'] as $groupId=>$moduleAccess){
            foreach($moduleAccess as $moduleId=>$data) {
                $entry = \DB::table('tb_group_access')->where('group_id',$groupId)->where('module_id',$moduleId)->count();
                $permission = array_replace($noPermission, $data);

                if($entry == 0) {
                    \DB::table('tb_group_access')->insert(array('group_id'=>$groupId,'module_id'=>$moduleId,'data_access'=>json_encode($permission)));
                }else{
                    \DB::table('tb_group_access')->where('group_id',$groupId)->where('module_id',$moduleId)->update(array('data_access'=>json_encode($permission)));
                }
            }
        }
        return response()->json(array(
            'status'=>'success',
            'message'=> \Lang::get('core.note_success')
        ));
    }

}