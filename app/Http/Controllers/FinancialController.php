<?php
namespace App\Http\Controllers;
use App\Models\Financial;
use App\Models\Classes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ;
use PDF;

class FinancialController extends Controller
{
    protected $layout = "layouts.main";
    protected $data = array();
    public $module = 'finance';
    static $per_page	= '10';

    public function __construct()
    {
        parent::__construct();
        $this->model = new Financial();
        $this->info = $this->model->makeInfo($this->module);
        $this->access = $this->model->validAccess($this->info['id']);
        $this->data = array(
            'pageTitle'			=> 	'Financial',
            'pageNote'			=>  'View All Financial Records',
            'pageModule'		=> 'finance',
            'pageUrl'			=>  url('finance'),
            'return' 			=> 	self::returnUrl()
        );

    }

    public function getIndex()
    {
        if($this->access['is_view'] ==0)
            return Redirect::to('dashboard');

        $this->data['access']		= $this->access;
        return view('financial.index',$this->data);
    }
    public function getReceipt()
    {
        if($this->access['is_view'] ==0)
            return Redirect::to('dashboard');

        $this->data['access']		= $this->access;
        $this->data['pageTitle']		= 'Receipt';
        $this->data['pageNote']		= 'View All Receipt';
        return view('financial.receipt',$this->data);
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
        return view('financial.table',$this->data);

    }

    public function postReceiptData( Request $request)
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
        return view('financial.receipt-data',$this->data);

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
            $this->data['row'] 		= $this->model->getColumnTable('tb_payment');
        }
        $this->data['classes'] = Classes::lists('name','id');
        $this->data['id'] = $id;
        return view('financial.form',$this->data);
    }


    function postSave( Request $request, $id =0)
    {
        //$rules = $this->validateForm();
        $rules = array();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            //$data = $this->validatePost('sb_event');
            $data = $request->all();
            if(empty($data['no']))
                $data['no'] = substr(rand().time(), 0, 6);
            if(empty($request->input('id')))
                $data['status'] = 0;
            $id = $this->model->insertRow($data , $request->input('id'));

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

    public function getDownload( Request $request, $id = '')
    {
        $row = $this->model->getRow($id);
        if(count($row) > 0)
        {
            $row->student_id = \SiteHelpers::getUserName($row->student_id);
            $row->updated_by = \SiteHelpers::getUserName($row->updated_by);
            $pdf = PDF::loadView('financial.pdf', (array)$row);
            return $pdf->download('receipt.pdf');
        }
        else
        {
            return Redirect::to('receipt')->with('messagetext',\Lang::get('core.note_restric'))->with('msgstatus','error');
        }
    }

    public function getShow( $id = null)
    {

        $row = $this->model->getRow($id);
        if(count($row) > 0)
        {
            $row->student_id = \SiteHelpers::getUserName($row->student_id);
            $row->updated_by = \SiteHelpers::getUserName($row->updated_by);
            $pdf = PDF::loadView('financial.pdf', (array)$row);
            return $pdf->stream('receipt.pdf');
        }
        else
        {
            return Redirect::to('receipt')->with('messagetext',\Lang::get('core.note_restric'))->with('msgstatus','error');
        }
        /*
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
        return view('financial.view',$this->data);*/
    }

    public function postChangeStatus(Request $request)
    {
        if($this->access['is_edit'] ==0) {
            return response()->json(array(
                'status'=>'error',
                'message'=> \Lang::get('core.note_restric')
            ));
            die;

        }
        if(!empty($request->input('id')))
        {
            $row = $this->model->find($request->input('id'));
            if($row)
            {
                if($row->status == 1)
                {
                    $data = array(
                        'received_date' => '',
                        'status' => 0,
                    );
                }
                else
                {
                    $data = array(
                        'received_date' => date("Y-m-d H:i:s"),
                        'status' => 1,
                    );
                }
                $id = $this->model->insertRow($data , $request->input('id'));
            }
            else
            {
                return response()->json(array(
                    'status'=>'error',
                    'message'=> 'error in payment'
                ));
            }
            return response()->json(array(
                'status'=>'success',
                'message'=> 'Update successfully'
            ));
        } else {
            return response()->json(array(
                'status'=>'error',
                'message'=> 'error in payment'
            ));

        }
    }
}