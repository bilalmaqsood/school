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

class ProfileController extends Controller
{
    protected $layout = "layouts.main";
    protected $user;

    public function __construct() {
        parent::__construct();
    }

    public function getIndex() {

        if(!\Auth::check()) return redirect('user/login');

        $id = \Session::get('uid');
        $email = \Session::get('eid');
        $result = \DB::select('select * from tb_users where email = :email AND id  = :id', ['email' => $email, 'id' => $id]);
        $info = $result[0];
        $this->data = array(
            'pageTitle' => 'My Profile',
            'pageNote'  => 'View Detail My Info',
            'row'       => $info,
        );
        return view('user.profile',$this->data);
    }
    public function postUpdate(Request $request) {

        if(!\Auth::check()) return redirect('user/login');
        $id = \Session::get('uid');
        $password = $request->input("password");
        $last_name = $request->input("last_name");
        $middle_name = $request->input("middle_name");
        $first_name = $request->input("first_name");
        $mobile_number = $request->input("mobile_number");
        $phone_number = $request->input("phone_number");
        $avatar = $request->input("avatar");


        if (isset($password) && !empty($password)) {
        $data = [
            'password' => bcrypt($password),
        ];
            $result = \DB::table('tb_users')->where("id","=",$id)->update($data);
        }
        $data = [
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
            'mobile_number' => $mobile_number,
            'phone_number' => $phone_number,
            'avatar' => $avatar
        ];
        $result = \DB::table('tb_users')->where("id","=",$id)->update($data);
        \Session::put('fid', $first_name.' '. $last_name);
     return response()->json(array(
                'status' => 'success',
                'message' => \Lang::get('core.note_success')
            ));
    }
}