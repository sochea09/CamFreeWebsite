<?php
$controller	= "App\Components\Api\Modules\CareGiver\Controllers\CareGiverController";

Route::group(['prefix' => 'api'], function() use ($controller)
{
    // ---------------------------- CareGiver Update Profile Info ------------------------------------------
    Route::post('/update-profile-info', $controller."@updateCareGiverProfileInfo");
    
    // ---------------------------- CareGiver Update Profile Pic ------------------------------------------
    Route::post('/update-profile-pic', $controller."@updateCareGiverProfilePicture");
});
