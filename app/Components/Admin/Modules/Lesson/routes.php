<?php

$controller = "App\Components\Admin\Modules\Lesson\LessonController";

Route::group(['prefix' => 'admin', 'middleware' => 'admin.auth'], function() use ($controller)
{
    Route::get('/lesson/', array('as' => 'admin.lesson.list', 'uses' => $controller."@getList"));
    Route::get('/lesson/create', array('as' => 'admin.lesson.create', 'uses' => $controller."@getCreate"));
    Route::post('/lesson/create', array('as' => 'admin.lesson.create', 'uses' => $controller."@postCreate"));
});