<?php

$controller = "App\Components\Site\Modules\Frontend\FrontendController";
$security_controller = "App\Components\Site\Modules\Frontend\SecurityController";

Route::get('/', array('as' => 'site.frontend.home', 'uses' =>  $controller . "@index"));
Route::get('/register', array('as' => 'site.frontend.register', 'uses' =>  $controller . "@register"));

Route::post('/do-register', array('as' => 'site.frontend.do_register', 'uses' => $controller . "@do_registration"));
