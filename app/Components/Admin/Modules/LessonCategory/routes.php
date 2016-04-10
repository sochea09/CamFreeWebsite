<?php

$controller = "App\Components\Admin\Modules\LessonCategory\LessonCategoryController";

Route::group(['prefix' => 'admin', 'middleware' => 'admin.auth'], function() use ($controller)
{
    Route::get('/lesson-category/', array('as' => 'admin.lesson.category.list', 'uses' => $controller."@getList"));
    Route::get('/lesson-category/create', array('as' => 'admin.lesson.category.create', 'uses' => $controller."@getCreate"));
    Route::post('/lesson-category/create', array('as' => 'admin.lesson.category.create', 'uses' => $controller."@postCreate"));
});