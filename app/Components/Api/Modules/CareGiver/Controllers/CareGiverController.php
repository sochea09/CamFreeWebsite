<?php

namespace App\Components\Api\Modules\CareGiver\Controllers;

use App\Components\Site\Modules\Frontend\Model\general_mod as General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Session;
use Validator;
use CURLFile;

class CareGiverController extends Controller
{

    public function updateCareGiverProfileInfo()
    {
        foreach (Input::all() as $key => $value) {
            $data       = array(
                          $key  => $value
                        );
        }

        $result         = $this->put('caregiver/profile/update', $data);
        if (@$result['msg_status']=='success') {
            $data       = @$result['responseText'];
            // dd($data);
            $user_info                                  = Session::get('profile');
            // General::debug($user_info, 1, "User Info:");
            // $user_info->bio                              = @$data->bio;
            foreach (Input::all() as $key => $value) {
                if(isset($user_info->$key)) $user_info->$key = @$data->$key;
            }
            Session::put('profile', $user_info);
        }
        // General::debug($user_info, 1, "User Info:");
        // dd($user_info);

        $result         = $this->normalizeAPIData($result);

        return $result;
    }

    public function updateCareGiverProfilePicture()
    {
        $data       = array(
                      'profile_picture' => Input::get('url')
                    );

        $result         = $this->normalizeAPIData($this->put('/caregiver/profile/picture', $data));

        return $result;
    }

}
