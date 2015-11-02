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
Route::get('/about', function () {
     return view('about');
});
Route::get('ppos/explore/', array('uses' => 'PposController@explore', 'as' => 'ppos.explore'));
Route::get('prescriptions/create/{ppo_id}/{diagnosis_id}', array('uses' => 'PrescriptionsController@create', 'as' => 'prescriptions.create'));
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

