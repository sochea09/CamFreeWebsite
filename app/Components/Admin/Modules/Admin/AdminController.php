<?php

namespace App\Components\Admin\Modules\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class AdminController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function Login()
    {
        $title = 'Login';
        return $this->view('login')->with(compact('title'));
    }
    public function doLogin(){
        extract($this->request->input());

        $userData = array(
            'email' => $email,
            'password' => $password
        );
        $result = $this->post('auth/signin', $userData, array());

        if($result['msg_status']){
            if(strcmp($result['msg_status'], 'success') == 0){
                $logged_data = $result['responseText'];
                $ses_data = array(
                    'username' => $logged_data['username'],
                    'auth_token' => $logged_data['access_key'],
                    'role' => $logged_data['role']
                );

                if($ses_data['role'] != 'admin' && $ses_data['role'] != 'super-admin') {
                    Session::flash('msg_err', 'Account is not an admin account.');
                    return $this->view('login');
                }

                Session::put('user', $ses_data);

                return redirect()->route('admin.dashboard');
            }else{
                Session::flash('msg_err', ucfirst($result['msg_status']));
                return $this->view('login');
            }
        }

        Session::flash('msg_err', 'Invalid email or password.');
        return $this->view('login');
    }
    public function doLogout(){
        Session::forget('user');
        return redirect()->route('admin.login');
    }
    public function Dashboard(){
        return $this->view('dashboard');
    }
}
