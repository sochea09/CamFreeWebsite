<?php
$upload	= "App\Components\Api\Modules\Upload\Controllers\UploadController";

Route::group(['prefix' => 'api'], function() use ($upload)
{
	// File upload
	Route::post('/files/upload', $upload . '@storeFile');
	Route::get('/files/upload/{filename}', $upload . '@show');
});
