<?php

namespace App\Components\Site\Modules\Frontend;

use App\Components\Site\Modules\Frontend\Model\general_mod as General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Session;
use Input;
use Meta;

class FrontendController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->role = '';
        if(Session::has('authUser')){
            $user = Session::get('authUser');
            $this->role = Session::has('role') ? Session::get('role') : $user['role'];
        }
    }

    public function index()
    {
        $title = 'Home | CamFree';
        return $this->view('home')->with(compact('title'));
    }
    public function register($input = null)
    {
        $data['title']          = 'Member Registration Form';
        $data['roleUser']       = @$this->role;
        $data['userType']       = General::bindingUserType();
        $data['country']        = General::bindingCountry();

        if(is_array($input))
            $preloadinfo        = array_except($input, array('password','password_confirmation'));
        else $preloadinfo       = $input;

        Meta::set(array('camfree:preloadinfo' => base64_encode(json_encode($preloadinfo))));

        return $this->view('register')->with($data);

    }
    public function do_registration()
    { return $this->register($this->request->input());
        extract($request->input());

        $term = false;
        if(@$agree_term)
            $term = true;

        if($registerAs == 'CareGiver'){
            $url_type = 'caregiver';
        }else{
            $url_type = 'careclient';
        }

        if($country_code != "" && $phone != ""):
            $mobile = array('country_code' => $country_code, 'phone_number' => $phone);
        elseif($country_code == "" && $phone != ""):
            $mobile = array('country_code' => false, 'phone_number' => $phone);
        else:
            $mobile = false;
        endif;

        $data = array(
            "password"=> $password,
            "email"   => $email,
            "device" => false,
            "mobile"  => $mobile,
            "roles"   => array($registerAs),
            "profile_picture" => null,
            "first_name"  => $fname,
            "last_name"   => $lname,
            "resident_address" => @$address,
            "created_at"  => date('H:i:s Y-m-d'),
            "updated_at"  => date('H:i:s Y-m-d'),
            "city"        => @$city,
            "state"       => @$state,
            "zip"         => @$zip_code,
            "country"     => @$country,
            "agree_term"  => @$term
        );

        // dd($data);
        $result = $this->post($url_type.'/signup' , $data , array());

        if(@$result['msg_status']){
            if(strcmp($result['msg_status'], "success") == 0){
                Session::flash('msg_status', '<div class="alert alert-success"><b>Success : </b> You\'re complete registration as <em>'.$registerAs.'</em><br/> Please check your email for confirming your account.</div>');
                return redirect()->route('site.frontend.register');
            }else{
                Session::flash('msg_status', '<div class="alert alert-danger"><b>Error : </b> '.$result['msg_status'].'</div>');
            }
        }else{
            Session::flash('msg_status', '<div class="alert alert-danger"><b>Error : </b> All user information are required.</div>');
        }

        return $this->register(Input::except('password', 'password_confirmation'));
    }
}
