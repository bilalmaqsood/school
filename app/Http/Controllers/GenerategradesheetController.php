<?php
namespace App\Http\Controllers;
use App\Models\StudentClass;
use App\Models\Subject;
use App\Models\Grade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ;

class GenerategradesheetController extends Controller
{
    protected $layout = "layouts.main";
    protected $data = array();
    public $module = 'generate';
    static $per_page	= '10';

    public function __construct()
    {
        parent::__construct();
        $this->model = new StudentClass();
        $this->data = array(
            'pageTitle'			=> 	'Generate Grade Sheet',
            'pageNote'			=>  'with respect to class and year',
            'pageModule'		=> 'generate',
            'pageUrl'			=>  url('generate'),
            'return' 			=> 	self::returnUrl()
        );
    }

    public function getIndex()
    {
        if(\Session::get('gid') != 1)
            return Redirect::to('dashboard');
        return view('generategradesheet.index',$this->data);
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
        return view('generategradesheet.table',$this->data);

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
}