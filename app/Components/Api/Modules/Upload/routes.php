<?php
$upload	= "App\Components\Api\Modules\Upload\Controllers\UploadController";

Route::group(['prefix' => 'api'], function() use ($upload)
{
	// File upload
	Route::post('/files/upload', $upload . '@storeFile');
	Route::post('/youtube/upload', $upload . '@storeYoutube');
	Route::post('/image/upload', $upload . '@storeImage');
	Route::get('/files/upload/{filename}', $upload . '@show');
});
