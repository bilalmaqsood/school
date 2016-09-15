<?php
namespace App\Http\Controllers;

use App\Models\Parents;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ;

class ParentController extends Controller
{
    protected $layout = "layouts.main";
    protected $data = array();
    public $module = 'parents';
    static $per_page	= '10';

    public function __construct()
    {

        parent::__construct();

        $this->model = new Parents();

        $this->info = $this->model->makeInfo($this->module);
        $this->access = $this->model->validAccess($this->info['id']);
        $this->data = array(
            'pageTitle'			=> 	'Parents',
            'pageNote'			=>  'Parents',
            'pageModule'		=> 'parents',
            'pageUrl'			=>  url('parents'),
            'return' 			=> 	self::returnUrl()
        );

    }

    public function getIndex()
    {
        if($this->access['is_view'] ==0)
            return Redirect::to('dashboard');
        $this->data['access']		= $this->access;
        return view('parent.index',$this->data);
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
        return view('parent.table',$this->data);

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

        $row = $this->model->find($id);
        if($row)
        {
            $this->data['row'] 		=  $row;
        } else {
            $this->data['row'] 		= $this->model->getColumnTable('tb_parent');
        }
        $this->data['id'] = $id;

        return view('parent.form',$this->data);
    }


    function postSave( Request $request, $id =0)
    {
        $data = $request->all();
        

        // $rules = $this->validateForm();
        $rules = [ 

                "last_name" => "required|max:10",
                "email" => "required|email|unique:Parents",
                "first_name" => "required",

        ];

$validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $id = $this->model->insertRow($data , $request->input('id'));
        return response()->json(array(
            'status'=>'success',
            'message'=> \Lang::get('core.note_success')
        ));
}else {

            $message = $this->validateListError(  $validator->getMessageBag()->toArray() );
            return response()->json(array(
                'message'   => $message,
                'status'    => 'error'
            ));
        }

        
        // $validator = Validator::make($request->all(), $rules);
        // if ($validator->passes()) {
        //     $data = $this->validatePost('sb_invoiceproducts');

        //     $id = $this->model->insertRow($data , $request->input('ProductID'));

        //     return response()->json(array(
        //         'status'=>'success',
        //         'message'=> \Lang::get('core.note_success')
        //     ));

        // } else {

        //     $message = $this->validateListError(  $validator->getMessageBag()->toArray() );
        //     return Response::json(array(
        //         'message'	=> $message,
        //         'status'	=> 'error'
        //     ));
        // }

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

            // dd($this->data);

        return view('Parent.view',$this->data);
    }

}