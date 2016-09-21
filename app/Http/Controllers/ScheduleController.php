<?php
namespace App\Http\Controllers;

use App\Models\ClassSchedule;
use App\Models\Subject;
use App\Models\Period;
use App\Models\Classes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ;

class ScheduleController extends Controller
{
    protected $layout = "layouts.main";
    protected $data = array();
    public $module = 'class';
    static $per_page	= '10';

    public function __construct()
    {
        parent::__construct();
        $this->model = new ClassSchedule();
        $this->class = new Classes();
        $this->period = new Period();
        $this->info = $this->model->makeInfo($this->module);
        $this->access = $this->model->validAccess($this->info['id']);
        $this->data = array(
            'pageTitle'			=> 	'Class Schedule',
            'pageNote'			=>  'View All Class Schedules',
            'pageModule'		=> 'schedule',
            'pageUrl'			=>  url('schedule'),
            'return' 			=> 	self::returnUrl()
        );

    }

    public function getIndex()
    {
        $year_id = \Session::get('selected_year');
        $classes = Classes::all();
        $periods = Period::all();
        $monday = array();
        $tuesday = array();
        $wednesday = array();
        $thursday = array();
        $friday = array();
        foreach($classes as $cindex => $class)
        {
            foreach($periods as $pindex => $period)
            {
                $mon = \DB::table('tb_classes_schedule')->where('class_id', '=', $class->id)
                    ->where('period_id', '=', $period->id)
                    ->where('day_of_week', '=', 1)
                    ->where('year_id', '=', $year_id)
                    ->get();
                $tues = \DB::table('tb_classes_schedule')->where('class_id', '=', $class->id)
                    ->where('period_id', '=', $period->id)
                    ->where('day_of_week', '=', 2)
                    ->where('year_id', '=', $year_id)
                    ->get();
                $wednes = \DB::table('tb_classes_schedule')->where('class_id', '=', $class->id)
                    ->where('period_id', '=', $period->id)
                    ->where('day_of_week', '=', 3)
                    ->where('year_id', '=', $year_id)
                    ->get();
                $thurs = \DB::table('tb_classes_schedule')->where('class_id', '=', $class->id)
                    ->where('period_id', '=', $period->id)
                    ->where('day_of_week', '=', 4)
                    ->where('year_id', '=', $year_id)
                    ->get();
                $fri = \DB::table('tb_classes_schedule')->where('class_id', '=', $class->id)
                    ->where('period_id', '=', $period->id)
                    ->where('day_of_week', '=', 5)
                    ->where('year_id', '=', $year_id)
                    ->get();
                $monday[$cindex][$pindex]['class_id'] = $class->id;
                $monday[$cindex][$pindex]['day_of_week'] = 1;
                $monday[$cindex][$pindex]['period_id'] = $period->id;

                $tuesday[$cindex][$pindex]['class_id'] = $class->id;
                $tuesday[$cindex][$pindex]['day_of_week'] = 2;
                $tuesday[$cindex][$pindex]['period_id'] = $period->id;

                $wednesday[$cindex][$pindex]['class_id'] = $class->id;
                $wednesday[$cindex][$pindex]['day_of_week'] = 3;
                $wednesday[$cindex][$pindex]['period_id'] = $period->id;

                $thursday[$cindex][$pindex]['class_id'] = $class->id;
                $thursday[$cindex][$pindex]['day_of_week'] = 4;
                $thursday[$cindex][$pindex]['period_id'] = $period->id;

                $friday[$cindex][$pindex]['class_id'] = $class->id;
                $friday[$cindex][$pindex]['day_of_week'] = 5;
                $friday[$cindex][$pindex]['period_id'] = $period->id;

                if(count($mon) > 0)
                {
                    $monday[$cindex][$pindex]['subject_id'] = $mon[0]->subject_id;
                    $monday[$cindex][$pindex]['id'] = $mon[0]->id;
                }
                else
                {
                    $monday[$cindex][$pindex]['subject_id'] = '';
                    $monday[$cindex][$pindex]['id'] = '';
                }

                if(count($tues) > 0)
                {
                    $tuesday[$cindex][$pindex]['subject_id'] = $tues[0]->subject_id;
                    $tuesday[$cindex][$pindex]['id'] = $tues[0]->id;
                }
                else
                {
                    $tuesday[$cindex][$pindex]['subject_id'] = '';
                    $tuesday[$cindex][$pindex]['id'] = '';
                }

                if(count($wednes) > 0)
                {
                    $wednesday[$cindex][$pindex]['subject_id'] = $wednes[0]->subject_id;
                    $wednesday[$cindex][$pindex]['id'] = $wednes[0]->id;
                }
                else
                {
                    $wednesday[$cindex][$pindex]['subject_id'] = '';
                    $wednesday[$cindex][$pindex]['id'] = '';
                }

                if(count($thurs) > 0)
                {
                    $thursday[$cindex][$pindex]['subject_id'] = $thurs[0]->subject_id;
                    $thursday[$cindex][$pindex]['id'] = $thurs[0]->id;
                }
                else
                {
                    $thursday[$cindex][$pindex]['subject_id'] = '';
                    $thursday[$cindex][$pindex]['id'] = '';
                }

                if(count($fri) > 0)
                {
                    $friday[$cindex][$pindex]['subject_id'] = $fri[0]->subject_id;
                    $friday[$cindex][$pindex]['id'] = $fri[0]->id;
                }
                else
                {
                    $friday[$cindex][$pindex]['subject_id'] = '';
                    $friday[$cindex][$pindex]['id'] = '';
                }
            }
        }
        if($this->access['is_view'] ==0)
            return Redirect::to('dashboard');

        $this->data['access']   = $this->access;
        $this->data['monday']   = $monday;
        $this->data['tuesday']   = $tuesday;
        $this->data['wednesday']   = $wednesday;
        $this->data['thursday']   = $thursday;
        $this->data['friday']   = $friday;
        $this->data['classes']   = $classes;
        $this->data['periods']   = $periods;
        return view('schedule.index',$this->data);
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
        return view('schedule.table',$this->data);

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
            $this->data['row'] 		= $this->model->getColumnTable('tb_classes_schedule');
        }

        $this->data['id'] = $id;
        $this->data['weekDays'] = array('monday'=>'Monday','tuesday'=>'Tuesday','wednesday'=>'Wednesday','thursday'=>'Thursday','friday'=>'Friday','satuarday'=>'Satuarday','sunday'=>'Sunday');
        $this->data['subjects'] = Subject::lists('name','id');
        $this->data['periods'] = Period::lists('name','id');

        return view('schedule.form',$this->data);
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
            $data = $this->validatePost('tb_classes_schedule');

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
        $this->model->destroy($request->input('id'));
        return response()->json(array(
            'status'=>'success',
            'message'=> 'delete successfully'
        ));

    }

    public function getPopup(Request $request)
    {
        $year_id = \Session::get('selected_year');
        $data = $request->all();
        $this->data['schedule_id'] = $data['id'];
        $this->data['subject_id'] = $data['subject_id'];
        $this->data['class_id'] = $data['class_id'];
        $this->data['day_of_week'] = $data['day_of_week'];
        $this->data['period_id'] = $data['period_id'];
        $subjects = \DB::table('tb_subject')->where('year_id', '=', $year_id)->where('class_id', '=', $data['class_id'])->select('id', 'name')->get();
        $this->data['subjects'] = $subjects;
        return view('schedule.popup', $this->data);
    }


    public function postSavedata(Request $request)
    {
        $data = $request->all();
        $data = array(
            'subject_id' => $data['subject_id'],
            'class_id' => $data['class_id'],
            'day_of_week' => $data['day_of_week'],
            'period_id' => $data['period_id']
        );
        $id = $this->model->insertRow($data , $request->input('schedule_id'));

        return response()->json(array(
            'status'=>'success',
            'subject_title' => \SiteHelpers::getSubjectName($data['subject_id']),
            'message'=> \Lang::get('core.note_success')
        ));
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
            $this->data['row'] = $this->model->getColumnTable('tb_classes_schedule');
        }
        $this->data['id'] = $id;
        $this->data['access']	= $this->access;
        return view('schedule.view',$this->data);
    }

}