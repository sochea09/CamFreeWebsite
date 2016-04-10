<?php

namespace App\Components\Api\Modules\Site\Controllers;

use App\Components\Site\Modules\Frontend\Model\general_mod as General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Session;
use Validator;
use CURLFile;

class FrontendController extends Controller
{
    // Newsletter Signup
    public function newsletterSignup() {
        $data       = array(
                      'email' => Input::get('email')
                    );

        return $this->responseSuccess($data, 200);
        // $result         = $this->normalizeAPIData($this->put('/caregiver/profile/picture', $data));

        return $result;
    }

    // Check existence email
    public function checkExistenceEmail(Request $request) {
        return response()->json($this->post('validation/auth/email', $request->input()));
        // $data       = array(
        //               'email' => Input::get('email')
        //             );

        // $result		= $this->normalizeAPIData($this->post('validation/auth/email', $data));

        // return $result;
    }

    // Check existence phone number
    public function checkExistencePhone(Request $request) {
        return response()->json($this->post('validation/auth/mobile', $request->input()));
        // $data       = array(
        //               'country_code' => Input::get('country_code'),
        //               'phone_number' => Input::get('phone_number')
        //             );

        // $result		= $this->normalizeAPIData($this->post('validation/auth/mobile', $data));

        // return $result;
    }

}
