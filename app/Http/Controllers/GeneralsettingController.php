<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
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
        $this->data = array(
            'pageTitle'			=> 	'General Setting',
            'pageNote'			=>  '',
            'pageModule'		=> '',
            'pageUrl'			=>  url('setting'),
            'return' 			=> 	self::returnUrl()
        );

    }

    public function getIndex()
    {

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

}