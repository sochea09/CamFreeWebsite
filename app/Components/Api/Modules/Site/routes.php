<?php
$controller	= "App\Components\Api\Modules\Site\Controllers\FrontendController";

Route::group(['prefix' => 'api'], function() use ($controller)
{
	// Newsletter Signup
	Route::post('/newsletter-signup', $controller . '@newsletterSignup');

	// Check existence email
	Route::post('/check-email', $controller . '@checkExistenceEmail');

	// Check existence phone number
	Route::post('/check-phone', $controller . '@checkExistencePhone');
});
