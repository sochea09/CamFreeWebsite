<?php

namespace App\Components\Api\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Session;
use Validator;

class CareGiverController extends Controller
{
    public function caregivers(Request $request)
    {
        return response()->json($this->get('admin/caregiver/list', $request->input()));
    }

    public function approve(Request $request)
    {
        return response()->json($this->post('admin/caregiver/approve', $request->input()));
    }

    public function reject(Request $request)
    {
        return response()->json($this->post('admin/caregiver/reject', $request->input()));
    }

    public function certified(Request $request)
    {
        return response()->json($this->post('admin/caregiver/certified', $request->input()));
    }
}
