<?php

$controller = "App\Components\Admin\Modules\Admin\AdminController";

Route::get('/admin/login', array('as' => 'admin.login', 'uses' =>  $controller . "@Login"));
Route::post('/admin/login', array('as' => 'admin.login', 'uses' =>  $controller . "@doLogin"));
Route::get('/admin/logout', array('as' => 'admin.logout', 'uses' =>  $controller . "@doLogout"));

Route::group(['prefix' => 'admin', 'middleware' => 'admin.auth'], function() use ($controller)
{
    Route::get('/dashboard', array('as' => 'admin.dashboard', 'uses' => $controller."@Dashboard"));
});