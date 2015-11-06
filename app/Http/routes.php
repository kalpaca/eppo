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
     return view('about');
});

// Authentication routes...
Route::get('auth/login', array('uses' => 'Auth\AuthController@getLogin', 'as' => 'auth.login'));
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', array('uses' => 'Auth\AuthController@getLogout', 'as' => 'auth.logout'));

// Registration routes...
Route::get('auth/register', array('uses' => 'Auth\AuthController@getRegister', 'as' => 'auth.reg'));
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('/home', function () {
     return view('about');
});

Route::get('/about', function () {
     return view('about');
});

Route::get('ppos/explore/{patientid}', array('uses' => 'PposController@explore', 'as' => 'ppos.explore'));
Route::get('prescriptions/create/{ppoid}/{diagnosisid}/{patientid}', array('uses' => 'PrescriptionsController@create', 'as' => 'prescriptions.create'));
Route::resource('diagnoses', 'DiagnosesController');
Route::resource('diagnosisprimarycategories', 'DiagnosisPrimaryCategoriesController');
Route::resource('diagnosissecondarycategories', 'DiagnosisSecondaryCategoriesController');
Route::resource('regimens', 'RegimensController');
Route::resource('medications', 'MedicationsController');
Route::resource('prescriptions', 'PrescriptionsController', array('except' => array('create')));
Route::resource('ppos', 'PposController');
Route::resource('lucodes', 'LucodesController');
Route::resource('patients', 'PatientsController');
Route::resource('pposections', 'PpoSectionsController');
Route::resource('prescriptionoperationrecords', 'PrescriptionOperationRecordsController');
Route::resource('ppoitems', 'PpoItemsController');
Route::resource('dosecalculationtypes', 'DoseCalculationTypesController');
Route::resource('doseroutes', 'DoseRoutesController');
Route::resource('doseunits', 'DoseUnitsController');
Route::resource('mitteunits', 'MitteUnitsController');
Route::resource('dosemodificationreasons', 'DoseModificationReasonsController');
Route::resource('ppos.ppoitems', 'PpoItemsController');

