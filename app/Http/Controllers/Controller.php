<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Http\Request;
class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {
        $driver             = config('database.default');
        $database           = config('database.connections');

        $this->db           = $database[$driver]['database'];
        $this->dbuser       = $database[$driver]['username'];
        $this->dbpass       = $database[$driver]['password'];
        $this->dbhost       = $database[$driver]['host'];
        if(\Auth::check() == true)
        {
            if(!\Session::get('gid'))
            {
                \Session::put('uid', \Auth::user()->id);
                \Session::put('gid', \Auth::user()->group_id);
                \Session::put('eid', \Auth::user()->email);
                \Session::put('fid', \Auth::user()->first_name.' '. \Auth::user()->last_name);
            }
        }
    }

    function returnUrl()
    {
        $pages 	= (isset($_GET['page']) ? $_GET['page'] : '');
        $sort 	= (isset($_GET['sort']) ? $_GET['sort'] : '');
        $order 	= (isset($_GET['order']) ? $_GET['order'] : '');
        $rows 	= (isset($_GET['rows']) ? $_GET['rows'] : '');
        $search 	= (isset($_GET['search']) ? $_GET['search'] : '');

        $appends = array();
        if($pages!='') 	$appends['page'] = $pages;
        if($sort!='') 	$appends['sort'] = $sort;
        if($order!='') 	$appends['order'] = $order;
        if($rows!='') 	$appends['rows'] = $rows;
        if($search!='') $appends['search'] = $search;

        $url = "";
        foreach($appends as $key=>$val)
        {
            $url .= "&$key=$val";
        }
        return $url;

    }

    function buildSearch( )
    {
        return '';
    }

    function injectPaginate()
    {

        $sort 	= (isset($_GET['sort']) 	? $_GET['sort'] : '');
        $order 	= (isset($_GET['order']) 	? $_GET['order'] : '');
        $rows 	= (isset($_GET['rows']) 	? $_GET['rows'] : '');
        $search 	= (isset($_GET['search']) ? $_GET['search'] : '');

        $appends = array();
        if($sort!='') 	$appends['sort'] = $sort;
        if($order!='') 	$appends['order'] = $order;
        if($rows!='') 	$appends['rows'] = $rows;
        if($search!='') $appends['search'] = $search;

        return $appends;

    }

    function validateForm()
    {
        $forms = $this->info['config']['forms'];
        $rules = array();
        foreach($forms as $form)
        {
            if($form['required']== '' || $form['required'] !='0')
            {
                $rules[$form['field']] = 'required';
            } elseif ($form['required'] == 'alpa'){
                $rules[$form['field']] = 'required|alpa';
            } elseif ($form['required'] == 'alpa_num'){
                $rules[$form['field']] = 'required|alpa_num';
            } elseif ($form['required'] == 'alpa_dash'){
                $rules[$form['field']]='required|alpa_dash';
            } elseif ($form['required'] == 'email'){
                $rules[$form['field']] ='required|email';
            } elseif ($form['required'] == 'numeric'){
                $rules[$form['field']] = 'required|numeric';
            } elseif ($form['required'] == 'date'){
                $rules[$form['field']]='required|date';
            } else if($form['required'] == 'url'){
                $rules[$form['field']] = 'required|active_url';
            } else {

            }
        }
        return $rules ;
    }

    function validatePost(  $table )
    {
        $request = new Request;
        return $request->all();
        /*
        $request = new Request;
        if(!is_null(Input::file($field)))
        {

            $file = Input::file($field);
            $destinationPath = public_path(). $f['option']['path_to_upload'];
            $filename = $file->getClientOriginalName();
            $extension =$file->getClientOriginalExtension(); //if you need extension of the file
            $rand = rand(1000,100000000);
            $newfilename = strtotime(date('Y-m-d H:i:s')).'-'.$rand.'.'.$extension;
            $uploadSuccess = $file->move($destinationPath, $newfilename);
            if($f['option']['resize_width'] != '0' && $f['option']['resize_width'] !='')
            {
                if( $f['option']['resize_height'] ==0 )
                {
                    $f['option']['resize_height']	= $f['option']['resize_width'];
                }
                $orgFile = $destinationPath.'/'.$newfilename;
                \SiteHelpers::cropImage($f['option']['resize_width'] , $f['option']['resize_height'] , $orgFile ,  $extension,	 $orgFile)	;
            }

            if( $uploadSuccess ) {
                $data[$field] = $newfilename;
            }
        } else {
            unset($data[$field]);
        }

        $global	= (isset($this->access['is_global']) ? $this->access['is_global'] : 0 );

        if($global == 0 )
            $data['entry_by'] = \Session::get('uid');
        */
        return $data;
    }
    public function changeDateTimeFormat($date)
    {
        return date("Y-m-d H:i:s", strtotime($date));
    }
}
