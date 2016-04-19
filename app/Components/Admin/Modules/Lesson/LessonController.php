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

        $result = $this->get("lesson-category/list", array());
        $tmp_field = $result->data;
        $cats = array();
        foreach ($tmp_field as $key => $value) {
            $cats[$value->id] = $value->title;
        }

        $title = 'Create Lesson';
        return $this->view('create')->with(compact('title','cats'));
    }
    public function postCreate(){

        extract($this->request->input());

        $data = [
            'title'                 => $title,
            'description'           => $description,
            'lesson_category_id'    => $lesson_category,
            'begin_file_name'       => $begin_file,
            'finish_file_name'      => $finish_file,
            'vdo_id'                => $vdo_file
        ];

        $result = $this->post('lesson/create', $data, array());

        if(strcmp($result['msg_status'], 'success') == 0){
            return redirect()->route('admin.lesson.list');
        }

        return redirect()->route('admin.lesson.create')->withInput();
    }
}
