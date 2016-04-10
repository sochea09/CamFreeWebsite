<?php

namespace App\Components\Api\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Session;
use Validator;

class UserController extends Controller
{
    public function users(Request $request)
    {
        return response()->json($this->get('admin/user/list', $request->input()));
    }
    public function create(Request $request)
    {
        return response()->json($this->post('admin/user/create', $request->input()));
    }

    public function activate(Request $request)
    {
        return response()->json($this->post('admin/user/activate', $request->input()));
    }

    public function deactivate(Request $request)
    {
        return response()->json($this->post('admin/user/deactivate', $request->input()));
    }

    public function remove(Request $request)
    {
        return response()->json($this->post('admin/user/remove', $request->input()));
    }

}
