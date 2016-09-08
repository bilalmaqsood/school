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
                        $sidemenu = \DB::table('tb_group')->select('tb_group.data_access')->where('id', $row->group_id)->get();
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
                    //->with('message', \SiteHelpers::alert('error','Your username/password combination was incorrect'))
                    ->withInput();
            }
        }
    }

    public function getProfile() {

        if(!\Auth::check()) return redirect('user/login');

        $id = \Session::get('uid');
        $email = \Session::get('eid');
        $result = \DB::select('select * from tb_users where email = :email AND id  = :id', ['email' => $email, 'id' => $id]);
        $info = $result[0];
        // dd($info); die;
        $this->data = array(
            'pageTitle' => 'My Profile',
            'pageNote'  => 'View Detail My Info',
            'row'       => $info,
        );
        return view('user.profile',$this->data);
    }
    public function postProfile(Request $request) {

        if(!\Auth::check()) return redirect('user/login');
        $id = \Session::get('uid');
        $password = $request->input("password");
        $last_name = $request->input("last_name");
        $middle_name = $request->input("middle_name");
        $first_name = $request->input("first_name");
        $mobile_number = $request->input("mobile_number");
        $phone_number = $request->input("phone_number");


        if (isset($password) && !empty($password)) {
        $data = [
            'password' => bcrypt($password),
        ];
    $responce = \DB::table('tb_users')->where("id","=",$id)->update($data);
        }
        $data = [
            
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
            'mobile_number' => $mobile_number,
            'phone_number' => $phone_number,
        ];
    $responce = \DB::table('tb_users')->where("id","=",$id)->update($data);
        return view('user.profile');
    }

    public function getLogout() {
        \Auth::logout();
        \Session::flush();
        return Redirect::to('');
            //->with('message', \SiteHelpers::alert('info','Your are now logged out!'));
    }
}