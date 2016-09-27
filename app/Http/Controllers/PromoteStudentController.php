<?php
namespace App\Http\Controllers;
use App\Models\Promote;
use App\Models\Subject;
use App\Models\Grade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ;

class PromoteStudentController extends Controller
{
    protected $layout = "layouts.main";
    protected $data = array();
    public $module = 'promote';
    static $per_page	= '10';

    public function __construct()
    {
        parent::__construct();
        $this->model = new Promote();
        $this->data = array(
            'pageTitle'			=> 	'Promote Student',
            'pageNote'			=>  'to next year/grade',
            'pageModule'		=> 'promote',
            'pageUrl'			=>  url('promote'),
            'return' 			=> 	self::returnUrl()
        );
    }

    public function getIndex()
    {
        if(\Session::get('gid') != 1)
            return Redirect::to('dashboard');
        return view('promote.index',$this->data);
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
        return view('promote.table',$this->data);

    }

    public function postCreateGradeSheet(Request $request)
    {
        if($request->input('id') != '') {
            $year_id = \Session::get('selected_year');
            $rows = StudentClass::where('class_id', '=', $request->input('id'))->where('year_id', '=', $year_id)->get();
            foreach($rows as $row)
            {
                $subjects = Subject::where('class_id', '=', $row->class_id)->where('year_id', '=', $row->year_id)->get();
                foreach ($subjects as $subject) {
                    $record = Grade::where('subject_id', '=', $subject->id)->where('class_id', '=', $row->class_id)->where('year_id', '=', $row->year_id)->where('student_id', '=', $row->student_id)->get();
                    if (count($record) == 0)
                        $id = \DB::table('tb_grade')->insert(array('subject_id' => $subject->id, 'class_id' => $row->class_id, 'student_id' => $row->student_id, 'year_id' => $row->year_id));
                }

            }

            return response()->json(array(
                'status' => 'success',
                'message' => \Lang::get('core.note_success')
            ));

        }
        else{
            return response()->json(array(
                'status'=>'error',
                'message'=> 'Record Not Found'
            ));
        }
    }

    public function postPromoteStudent(Request $request)
    {
        if($request->input('id') != '') {

            $selected_year = \Session::get('selected_year');
            $data = $request->all();
            $student_class = \DB::table('tb_student_class')->where('id', $data['id'])->first();
            if($data['status'] == -1)
            {
                $id = \DB::table('tb_students')->where('student_id', $student_class->student_id)->update(array('class_id'=> -1));
                $id =  \DB::table('tb_student_class')->where('id', $student_class->id)->update(array('status' => -1));
                return response()->json(array(
                    'status' => 'success',
                    'message' => 'Congrats, That student will be pass out'
                ));
            }
            elseif($data['status'] == 1)
            {
                $new_class = $data['promote_class'];
                $id = \DB::table('tb_students')->where('student_id', $student_class->student_id)->update(array('class_id'=>$new_class));
                $id =  \DB::table('tb_student_class')->where('id', $student_class->id)->update(array('status' => 1));
                $id =  \DB::table('tb_student_class')->insert(array('student_id'=>$student_class->student_id, 'class_id'=> $new_class,'year_id'=>$selected_year, 'status'=> 0));
                return response()->json(array(
                    'status' => 'success',
                    'message' => 'Successfully promote to next class in same year'
                ));
            }
            else
            {
                $next_year = \DB::table('tb_school')->orderBy('id', 'desc')->first();
                if($next_year->id != $selected_year)
                {
                    if($data['status'] == 2)
                    {
                        $new_class = $data['promote_class'];
                        $id = \DB::table('tb_students')->where('student_id', $student_class->student_id)->update(array('class_id'=>$new_class));
                        $id =  \DB::table('tb_student_class')->where('id', $student_class->id)->update(array('status' => 1));
                        $id =  \DB::table('tb_student_class')->insert(array('student_id'=>$student_class->student_id, 'class_id'=> $new_class,'year_id'=>$next_year->id, 'status'=> 0));
                        return response()->json(array(
                            'status' => 'success',
                            'message' => 'Successfully promote to next class & year'
                        ));
                    }
                    elseif($data['status'] == 3)
                    {
                        $same_class = $student_class->class_id;
                        $id = \DB::table('tb_students')->where('student_id', $student_class->student_id)->update(array('class_id'=>$same_class));
                        $id =  \DB::table('tb_student_class')->where('id', $student_class->id)->update(array('status' => 1));
                        $id =  \DB::table('tb_student_class')->insert(array('student_id'=>$student_class->student_id, 'class_id'=> $same_class,'year_id'=>$next_year->id, 'status'=> 0));
                        return response()->json(array(
                            'status' => 'success',
                            'message' => 'Successfully promote to same class in next year'
                        ));
                    }
                }
                else
                {
                    return response()->json(array(
                        'status' => 'error',
                        'message' => 'Sorry no new year exist'
                    ));

                }
            }
        }
        else{
            return response()->json(array(
                'status'=>'error',
                'message'=> 'Record Not Found'
            ));
        }
    }
}