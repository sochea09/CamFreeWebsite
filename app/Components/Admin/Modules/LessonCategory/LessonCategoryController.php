<?php

namespace App\Components\Admin\Modules\LessonCategory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class LessonCategoryController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getList(){
        return 'y';
    }

    public function getCreate(){
        $title = 'Create Lesson Category';
        return $this->view('create')->with(compact('title'));
    }
    public function postCreate(){
        extract($this->request->input());

        $data = [
            'title' => $title,
            'description' => $description
        ];

        $result = $this->post('lesson-category/create', $data, array());

        if(strcmp($result['msg_status'], 'success') == 0){
            return redirect()->route('admin.lesson.category.list');
        }

        return redirect()->route('admin.lesson.category.create')->withInput();
    }
}
