<?php 
Route::group(['middleware' => ['web']], function () {
	// Authentication Routes...
	Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('/login', 'Auth\LoginController@login');

/*	// Registration Routes...
	Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
	Route::post('/register', 'Auth\RegisterController@register');*/

	// Password Reset Routes...
	Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
	Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
	Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

	// Email Verification Routes...
	Route::get('/email/verify', 'Auth\VerificationController@show')->name('verification.notice');
	Route::get('/email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
	Route::get('/email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
});

Route::group(['middleware' => ['web','auth:hub_users']], function () {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/brigde/{profile}', 'BridgeAppController@bridgeToApp')->name('brigde');
	Route::get('/dashboard/{profile}', 'HomeController@dashboard')->name('dashboard');
	Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
});