<?php
namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Classes;
use App\Models\User;
use App\Models\Teacher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ;

class SubjectController extends Controller
{
    protected $layout = "layouts.main";
    protected $data = array();
    public $module = 'class';
    static $per_page	= '10';

    public function __construct()
    {
        parent::__construct();
        $this->model = new Subject();
        $this->info = $this->model->makeInfo($this->module);
        $this->access = $this->model->validAccess($this->info['id']);
        $this->data = array(
            'pageTitle'			=> 	'Subject',
            'pageNote'			=>  'View All Subject',
            'pageModule'		=> 'subject',
            'pageUrl'			=>  url('subject'),
            'return' 			=> 	self::returnUrl()
        );

    }

    public function getIndex()
    {
        if($this->access['is_view'] ==0)
            return Redirect::to('dashboard');

        $this->data['access']   = $this->access;
        return view('subject.index',$this->data);
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
        return view('subject.table',$this->data);

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
        $this->data['classes'] = Classes::lists('name','id');
        $this->data['teacher'] = User::where('group_id', '=', '5')->select('id' ,\DB::raw('concat(last_name, " ",first_name) as name'))->lists('name','id');

        return view('subject.form',$this->data);
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
        return view('subject.view',$this->data);
    }

}