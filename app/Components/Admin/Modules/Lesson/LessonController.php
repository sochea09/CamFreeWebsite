<?php

namespace App\Components\Admin\Modules\Lesson;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class LessonController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getList(){
        return 'y';
    }

    public function getCreate(){
        $title = 'Create Lesson';
        return $this->view('create')->with(compact('title'));
    }
    public function postCreate(){
        dd($this->request->input());
        extract($this->request->input());

        $data = [
            'title' => $title,
            'description' => $description
        ];

        $result = $this->post('lesson/create', $data, array());

        if(strcmp($result['msg_status'], 'success') == 0){
            return redirect()->route('admin.lesson.list');
        }

        return redirect()->route('admin.lesson.create')->withInput();
    }
}
