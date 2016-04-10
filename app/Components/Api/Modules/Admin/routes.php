<?php
$caregiver = "App\Components\Api\Modules\Admin\Controllers\CareGiverController";
$user = "App\Components\Api\Modules\Admin\Controllers\UserController";

Route::group(['prefix' => 'api/admin/caregiver', 'middleware' => 'admin.auth'], function() use ($caregiver)
{
    Route::get('/list', array('as' => 'api.admin.caregiver.list', 'uses' => $caregiver."@caregivers"));
    Route::post('/approve', array('as' => 'api.admin.caregiver.approve', 'uses' => $caregiver."@approve"));
    Route::post('/reject', array('as' => 'api.admin.caregiver.reject', 'uses' => $caregiver."@reject"));
    Route::post('/certified', array('as' => 'api.admin.caregiver.certified', 'uses' => $caregiver."@certified"));
});

Route::group(['prefix' => 'api/admin/user', 'middleware' => 'admin.auth'], function() use ($user)
{
    Route::get('/list', array('as' => 'api.admin.user.list', 'uses' => $user."@users"));
    Route::post('/activate', array('as' => 'api.admin.user.list', 'uses' => $user."@activate"));
    Route::post('/deactivate', array('as' => 'api.admin.user.list', 'uses' => $user."@deactivate"));
    Route::post('/remove', array('as' => 'api.admin.user.list', 'uses' => $user."@remove"));
});
