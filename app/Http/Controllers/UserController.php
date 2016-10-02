<?php
/**
 * Created by PhpStorm.
 * User: macbook
 * Date: 14/08/16
 * Time: 01:30
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Socialize;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ;

class UserController extends Controller
{
    protected $layout = "layouts.main";
    protected $user;

    public function __construct() {
        parent::__construct();
    }

    public function getLogin() {
        if(\Auth::check())
        {
            return Redirect::to('dashboard');
                //->with('message',\SiteHelpers::alert('success','Youre already login'));

        } else {
            //$this->data['socialize'] =  config('services');
            return View('user.login');

        }
    }

    public function postSignin( Request $request)
    {
        $rules = array(
            'email' => 'required|email',
            'password' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->passes())
        {
            $remember = (!is_null($request->get('remember')) ? 'true' : 'false' );
            if (\Auth::attempt(array('email'=>$request->input('email'), 'password'=> $request->input('password') ), $remember ))
            {
                if(\Auth::check())
                {
                    $row = User::find(\Auth::user()->id);
                    if($row->status =='0')
                    {
                        // inactive
                        \Auth::logout();
                        return Redirect::to('user/login')->with('message', \SiteHelpers::alert('error','Your Account is not active'));

                    }
                    else if($row->status=='2')
                    {
                        // BLocked users
                        \Auth::logout();
                        return Redirect::to('user/login');
                            //->with('message', \SiteHelpers::alert('error','Your Account is BLocked'));
                    }
                    else
                    {
                        \DB::table('tb_users')->where('id', '=',$row->id )->update(array('last_login' => date("Y-m-d H:i:s")));
                        $school_year = \DB::table('tb_school')->select('id', 'year')->orderBy('id', 'desc')->get();
                        $sidemenu = \DB::table('tb_group')->select('tb_group.data_access', 'tb_group.name')->where('id', $row->group_id)->get();
                        \Session::put('selected_year', $school_year[0]->id);
                        \Session::put('school_year', $school_year);
                        \Session::put('gname', $sidemenu[0]->name);
                        \Session::put('sidemenu', json_decode($sidemenu[0]->data_access));
                        \Session::put('uid', $row->id);
                        \Session::put('gid', $row->group_id);
                        \Session::put('eid', $row->email);
                        \Session::put('fid', $row->first_name.' '. $row->last_name);
                        if(CNF_FRONT =='false') :
                            return Redirect::to('dashboard');
                        else :
                            return Redirect::to('');
                        endif;

                    }

                }
            }
            else
            {
                return Redirect::to('user/login')
                    ->with('message', \SiteHelpers::alert('error','Your username/password combination was incorrect'))
                    ->withInput();
            }
        }
    }

    public function getLogout() {
        \Auth::logout();
        \Session::flush();
        return Redirect::to('');
            //->with('message', \SiteHelpers::alert('info','Your are now logged out!'));
    }


    public function getChangeYear(Request $request)
    {
        $id = $request->input('id');
        if($id != '')
        {
            \Session::put('selected_year', $id);
        }
        return response()->json(array(
            'status'=>'success',
            'message'=> 'Changed Year'
        ));
    }
}