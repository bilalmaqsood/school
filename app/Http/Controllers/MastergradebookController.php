<?php
namespace App\Http\Controllers;

use App\Models\Mastergradebook;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ;
use PDF;
class MastergradebookController extends Controller
{
    protected $layout = "layouts.main";
    protected $data = array();
    public $module = 'gradebook';
    static $per_page	= '10';

    public function __construct()
    {
        parent::__construct();
        $this->model = new Mastergradebook();
        $this->info = $this->model->makeInfo($this->module);
        $this->access = $this->model->validAccess($this->info['id']);
        $this->data = array(
            'pageTitle'			=> 	'Grade Book',
            'pageNote'			=>  'Master Grade Book',
            'pageModule'		=> 'gradebook',
            'pageUrl'			=>  url('gradebook'),
            'return' 			=> 	self::returnUrl()
        );

    }

    public function getIndex()
    {
        if($this->access['is_view'] ==0)
            return Redirect::to('dashboard');
        $this->data['pageTitle'] = 'Manage Marks';
        $this->data['pageNote'] = 'There should be no way to edit previous grade once next grade has been entered';
        $this->data['access'] = $this->access;
        return view('gradebook.index',$this->data);
    }



    public function postManageMarks(Request $request)
    {
        // Group users permission
        $this->data['access']		= $this->access;
        return view('gradebook.manage-marks', $this->data);
    }

    public function postManageGradebook(Request $request)
    {
        // Group users permission
        $this->data['access']		= $this->access;
        return view('gradebook.manage-gradebook', $this->data);
    }

    public function postManageTranscript(Request $request)
    {
        // Group users permission
        $this->data['access']		= $this->access;
        return view('gradebook.manage-transcript', $this->data);
    }

    public function getShow( $id = 1)
    {
        if($this->access['is_view'] ==0)
            return Redirect::to('dashboard');
        $this->data['pageTitle'] = 'View Master Grade Book';
        $this->data['pageNote'] = '';
        $this->data['access'] = $this->access;
        return view('gradebook.view',$this->data);
    }

    public function getTranscript( $id = 1)
    {
        if($this->access['is_view'] ==0)
            return Redirect::to('dashboard');
        $this->data['pageTitle'] = 'Transcript Sheet';
        $this->data['pageNote'] = '';
        $this->data['access'] = $this->access;
        return view('gradebook.transcript',$this->data);
    }

    public function postTranscriptSheet(Request $request)
    {
        if($this->access['is_detail'] ==0)
            return Redirect::to('dashboard')
                ->with('messagetext', Lang::get('core.note_restric'))->with('msgstatus','error');
        $data = $request->all();
        $student_status = \DB::table('tb_students')
                    ->where('student_id', $data['student'])
                    ->select('class_id')
                    ->first();
        $previous_classes = \DB::table('tb_student_class')
                            ->join('tb_school', 'tb_student_class.year_id', '=', 'tb_school.id' )
                            ->join('tb_class', 'tb_student_class.class_id', '=', 'tb_class.id')
                            ->join('tb_division', 'tb_class.division_id', '=', 'tb_division.id')
                            ->where('tb_student_class.student_id', $data['student'])
                            ->orderBy('tb_student_class.class_id', 'desc')
                            ->orderBy('tb_student_class.year_id', 'desc')
                            ->select('tb_school.year', 'tb_student_class.*', 'tb_student_class.id as student_class_id', 'tb_class.name as class_name', 'tb_division.name as division_name')
                            ->get();
        foreach($previous_classes as $index => $previous_class)
        {
            $subjects = \DB::table('tb_subject')
                        ->where('tb_subject.class_id', '=', $previous_class->class_id)
                        ->where('tb_subject.year_id', '=', $previous_class->year_id)
                        ->select('tb_subject.id as subject_id', 'tb_subject.*')
                        ->get();
            $previous_classes[$index]->subjects = $subjects;
        }
        $this->data['rows']		= $previous_classes;
        $this->data['student']		= $data['student'];
        $this->data['student_status']		= isset($student_status) ? $student_status->class_id: 0;
        $this->data['access']		= $this->access;
        return view('gradebook.transcript-sheet',$this->data);
    }

    public function postDetail(Request $request)
    {
        if($this->access['is_detail'] ==0)
            return Redirect::to('dashboard')
                ->with('messagetext', Lang::get('core.note_restric'))->with('msgstatus','error');
        $data = $request->all();
        $teacher = \DB::table('tb_subject')
                ->where('tb_subject.id', '=', $data['subject'])
                ->where('tb_subject.year_id', '=', \Session::get('selected_year'))
                ->select('teacher_id')->get();
        $rows = \DB::table('tb_grade')
                ->where('tb_grade.subject_id', '=', $data['subject'])
                ->where('tb_grade.year_id', '=', \Session::get('selected_year'))
                ->select('tb_grade.*')
                ->get();
        if(count($rows) > 0)
            $this->data['teacher'] = isset($teacher ) ? $teacher[0]->teacher_id : '';
        $this->data['subject'] = $data['subject'];
        $this->data['class'] = $data['class'];
        $this->data['rows'] = $rows;
        $this->data['access']		= $this->access;
        return view('gradebook.detail',$this->data);
    }
    public function postSave( Request $request, $id =0)
    {
        if (!empty($id)) {
            $data = $request->all();
            $classId = $data['class'];
            $status = $data['exam'];
            $exam = $this->getColumn($status);
            $subject = $data['subject'];
            $gIds = $data['ids'];
            $gMarks = $data['marks'];
            for($index = 0; $index < count($gIds); $index++)
            {
                $rData[$exam] = $gMarks[$index];
                $id = $this->model->insertRow($rData , $gIds[$index]);
            }
            if($status == 8) {
                $this->updateSecondSemesterAvgMarks($subject);
                $status++;
            }
            if($status == 4)
            {
                $this->updateFirstSemesterAvgMarks($subject);
            }
            \DB::table('tb_subject')->where('id',$subject)->update(array('status'=>$status));
            return response()->json(array(
                'status'=>'success',
                'message'=> \Lang::get('core.note_success')
            ));

        } else {

            $message = 'Form issue';
            return Response::json(array(
                'message'	=> $message,
                'status'	=> 'error'
            ));
        }

    }

    public function postUpdate(Request $request)
    {
        if($this->access['is_add'] ==0)
            return Redirect::to('dashboard')->with('messagetext',\Lang::get('core.note_restric'))->with('msgstatus','error');
        if($this->access['is_edit'] ==0 )
            return Redirect::to('dashboard')->with('messagetext',\Lang::get('core.note_restric'))->with('msgstatus','error');
        $rData = $request->all();
        $column = $this->getColumn($rData['exam']);

        $data = \DB::table('tb_grade')
            ->join('tb_student_class', 'tb_grade.student_id', '=', 'tb_student_class.student_id')
            ->join('tb_students', 'tb_student_class.student_id', '=', 'tb_students.student_id')
            ->join('tb_users', 'tb_students.user_id', '=', 'tb_users.id')
            ->select('tb_grade.id',"tb_grade.$column as marks", \DB::raw('concat(tb_users.first_name, " ",tb_users.last_name) as name'))
            ->where('tb_grade.subject_id', '=', $rData['subject'])
            ->where('tb_grade.class_id', '=', $rData['class'])
            ->where('tb_student_class.class_id', '=', $rData['class'])
            ->where('tb_student_class.status', '=', 0)
            ->where('tb_grade.year_id', '=', \Session::get('selected_year'))
            ->get();
        $this->data['id'] = substr( md5(rand()), 0, 7);
        $this->data['access'] = $this->access;
        $this->data['exam'] = $rData['exam'];
        $this->data['subject'] = $rData['subject'];
        $this->data['class'] = $rData['class'];
        $this->data['rows'] = $data;
        return view('gradebook.form', $this->data);
    }

    private function getColumn($status)
    {
        if($status == 1)
            return 'first_term';
        elseif($status == 2)
            return 'second_term';
        elseif($status == 3)
            return 'third_term';
        elseif($status == 4)
            return 'first_exam';
        elseif($status == 5)
            return 'four_term';
        elseif($status == 6)
            return 'fifth_term';
        elseif($status == 7)
            return 'sixth_term';
        elseif($status == 8)
            return 'second_exam';
    }

    private function updateFirstSemesterAvgMarks($subject_id)
    {
        $rows = \DB::table('tb_grade')->select('id','first_term', 'second_term', 'third_term', 'first_exam')->where('subject_id', $subject_id)->get();
        foreach($rows as $row)
        {
            $avg = round((($row->first_term + $row->second_term + $row->third_term + $row->first_exam)/400) * 100);
            \DB::table('tb_grade')->where('id',$row->id)->update(array('first_avg'=>$avg));
        }
    }

    private function updateSecondSemesterAvgMarks($subject_id)
    {
        $rows = \DB::table('tb_grade')->select('id','first_avg', 'four_term', 'fifth_term', 'sixth_term', 'second_exam')->where('subject_id', $subject_id)->get();
        foreach($rows as $row)
        {
            $sec_avg = round((($row->four_term + $row->fifth_term + $row->sixth_term + $row->second_exam)/400) * 100);
            if($sec_avg == 0)
                $final = $row->first_avg;
            elseif($row->first_avg == 0)
                $final = $sec_avg;
            else
                $final = round(($sec_avg + $row->first_avg) / 2);
            \DB::table('tb_grade')->where('id',$row->id)->update(array('second_avg'=>$sec_avg, 'final' => $final));
        }
    }

    public function getDownloadTranscript( Request $request, $id = '')
    {
        try
        {
            $last_three_classes = \DB::table('tb_student_class')
                ->join('tb_school', 'tb_student_class.year_id', '=', 'tb_school.id')
                ->where('student_id', $id)
                ->orderBy('tb_student_class.id', 'desc')
                ->limit(3)
                ->select("tb_student_class.*", "tb_school.year")
                ->get();
            $subjects_list = array();
            foreach($last_three_classes as $class)
            {
                $subjects = \DB::table('tb_subject')
                    ->where('tb_subject.class_id', $class->class_id)
                    ->where('tb_subject.year_id', $class->year_id)
                    ->select(\DB::raw('UPPER(tb_subject.name) as subject_name'))
                    ->get();
                $subjects_list = array_merge($subjects_list, $subjects);
            }
            $subjects_list = array_map('json_encode', $subjects_list);
            $subjects_list = array_unique($subjects_list);
            $subjects_list = array_map('json_decode', $subjects_list);

            $student_name = \DB::table('tb_students')
                ->join('tb_users', 'tb_students.user_id', '=', 'tb_users.id')
                ->where('tb_students.student_id', $id)
                ->select('first_name', 'last_name', 'middle_name', 'gender', 'class_id')
                ->first();

            $registrar_name = \DB::table('tb_users')
                ->where('tb_users.group_id', 3)
                ->select('first_name', 'last_name')
                ->first();
            $principal_name = \DB::table('tb_users')
                ->where('tb_users.group_id', 2)
                ->select('first_name', 'last_name')
                ->first();
            $row['registrar'] = isset($registrar_name->first_name) ? strtoupper($registrar_name->first_name.' '. $registrar_name->last_name) : 'JOHN DOE';
            $row['principal'] = isset($principal_name->first_name) ? strtoupper($principal_name->first_name.' '. $principal_name->last_name) : 'MARRY DOE';
            $row['student'] = isset($student_name) ? $student_name: array();
            $row['subject_list'] = $subjects_list;
            $row['last_three_classes'] = $last_three_classes;
            $row['id'] = $id;
            $pdf = PDF::loadView('gradebook.transcripts', $row);
            return $pdf->download('transcript.pdf');
        }
        catch(\Exception $e)
        {
            return Redirect::to('dashboard');
        }


    }

    public function getDownloadMasterGradebook( Request $request)
    {
        $data = $request->all();
        $teacher = \DB::table('tb_subject')
            ->where('tb_subject.id', '=', $data['subject'])
            ->where('tb_subject.year_id', '=', \Session::get('selected_year'))
            ->select('teacher_id')->get();
        $rows = \DB::table('tb_grade')
            ->where('tb_grade.subject_id', '=', $data['subject'])
            ->where('tb_grade.year_id', '=', \Session::get('selected_year'))
            ->select('tb_grade.*')
            ->get();
        if(count($rows) > 0)
            $data['teacher'] = isset($teacher ) ? $teacher[0]->teacher_id : '';
        $data['subject'] = $data['subject'];
        $data['class'] = $data['class'];
        $data['rows'] = $rows;
        $pdf = PDF::loadView('gradebook.mastergradebook', $data);
        return $pdf->download('mastergradebook.pdf');
    }

    public function getStudentGradeSheet(Request $request)
    {
        $this->data['pageTitle'] = 'Transcript Sheet';
        $this->data['pageNote'] = '';
        if(\Session::get('gid') == 6) {
            $student = \DB::table('tb_students')
                    ->where('tb_students.user_id', '=', \Session::get('uid'))
                    -> first();
            $student_status = \DB::table('tb_students')
                ->where('student_id', $student->student_id)
                ->select('class_id')
                ->first();
            $previous_classes = \DB::table('tb_student_class')
                ->join('tb_school', 'tb_student_class.year_id', '=', 'tb_school.id' )
                ->join('tb_class', 'tb_student_class.class_id', '=', 'tb_class.id')
                ->join('tb_division', 'tb_class.division_id', '=', 'tb_division.id')
                ->where('tb_student_class.student_id', $student->student_id)
                ->orderBy('tb_student_class.class_id', 'desc')
                ->orderBy('tb_student_class.year_id', 'desc')
                ->select('tb_school.year', 'tb_student_class.*', 'tb_student_class.id as student_class_id', 'tb_class.name as class_name', 'tb_division.name as division_name')
                ->get();
            foreach($previous_classes as $index => $previous_class)
            {
                $subjects = \DB::table('tb_subject')
                    ->where('tb_subject.class_id', '=', $previous_class->class_id)
                    ->where('tb_subject.year_id', '=', $previous_class->year_id)
                    ->select('tb_subject.id as subject_id', 'tb_subject.*')
                    ->get();
                $previous_classes[$index]->subjects = $subjects;
            }
            $this->data['rows']		= $previous_classes;
            $this->data['student']		= $student->student_id;
            $this->data['student_status']		= isset($student_status) ? $student_status->class_id: 0;
            $this->data['access']		= $this->access;
            return view('gradebook.student-transcript-sheet',$this->data);
        }
        return Redirect::to('dashboard');
    }
}