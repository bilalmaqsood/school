<?php
namespace App\Http\Controllers;
use App\Models\Event;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ;

class EventController extends Controller
{
    protected $layout = "layouts.main";
    protected $data = array();
    public $module = 'event';
    static $per_page	= '10';

    public function __construct()
    {
        parent::__construct();
        $this->model = new Event();
        $this->info = $this->model->makeInfo($this->module);
        $this->access = $this->model->validAccess($this->info['id']);
        $this->data = array(
            'pageTitle'			=> 	'Event',
            'pageNote'			=>  'View All Event',
            'pageModule'		=> 'event',
            'pageUrl'			=>  url('event'),
            'return' 			=> 	self::returnUrl()
        );

    }

    public function getIndex()
    {
        if($this->access['is_view'] ==0)
            return Redirect::to('dashboard');

        $this->data['access']		= $this->access;
        return view('event.index',$this->data);
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
        return view('event.table',$this->data);

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
            $this->data['row'] 		= $this->model->getColumnTable('tb_event');
        }
        $this->data['id'] = $id;

        return view('event.form',$this->data);
    }


    function postSave( Request $request, $id =0)
    {
        //$rules = $this->validateForm();
        $rules = array();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            //$data = $this->validatePost('sb_event');
            $data = $request->all();
            if(isset($data['start_datetime']))
                $date['start_datetime'] = $this->changeDateTimeFormat($data['start_datetime']);
            if(isset($data['end_datetime']))
                $date['end_datetime'] = $this->changeDateTimeFormat($data['end_datetime']);
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

    public function getShowCalendar()
    {
        $events = Event::all();
        $data = array();
        foreach($events as $event)
        {
            $data[] = array(
                'title' => $event->title,
                'start' => $event->start_datetime,
                'end' => $event->end_datetime,
            );
        }
        $this->data['events'] = json_encode($data);
        return view('event.calendar', $this->data);
    }
}