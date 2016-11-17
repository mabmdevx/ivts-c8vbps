<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(array('prefix' => 'api'), function () {
    
	Route::resource('customers', 'CustomersController');
	Route::get('customers/{customerId}/certificates', 'CertificatesController@getCertificatesByCustomer');
	Route::get('customers/{customerId}/certificates/active', 'CertificatesController@getActiveCertificatesByCustomer');
	
	Route::resource('certificates', 'CertificatesController');
	Route::put('certificates/{certificateId}/activate', 'CertificatesController@activateCertificate');
	Route::put('certificates/{certificateId}/deactivate', 'CertificatesController@deactivateCertificate');

});
