<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

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
}
