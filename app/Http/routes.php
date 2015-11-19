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

Route::get('/', array('as' => 'home', function () {
     return view('about');
}));
Route::get('home', function () {
     return view('about');
});
Route::get('about', function () {
     return view('about');
});

// Authentication routes
Route::get('auth/login', array('uses' => 'Auth\AuthController@getLogin', 'as' => 'auth.login'));
Route::post('auth/login', 'Auth\AuthController@postLogin');

// Registration routes
Route::get('auth/register', array('uses' => 'Auth\AuthController@getRegister', 'as' => 'auth.reg'));
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Routes need auth
Route::group(['middleware' => 'auth'], function () {


    Route::get('ppos/explore/{patientid}', array('uses' => 'PposController@explore', 'as' => 'ppos.explore'));

    Route::get('patients', array('uses' => 'PatientsController@index', 'as' => 'patients.index'));
    Route::get('patients/index', array('uses' => 'PatientsController@index', 'as' => 'patients.index'));
    Route::post('patients/index', array('uses' => 'PatientsController@index', 'as' => 'patients.index'));
    Route::resource('patients', 'PatientsController');
    Route::get('prescriptions/create/{ppoid}/{diagnosisid}/{patientid}', array('uses' => 'PrescriptionsController@create', 'as' => 'prescriptions.create'));
    Route::post('prescriptions/finalize/{id}', array('uses' => 'PrescriptionsController@finalize', 'as' => 'prescriptions.finalize'));
    Route::post('prescriptions/void/{id}', array('uses' => 'PrescriptionsController@void', 'as' => 'prescriptions.void'));
    Route::resource('prescriptions', 'PrescriptionsController', array('except' => array('create')));

    Route::get('auth/logout', array('uses' => 'Auth\AuthController@getLogout', 'as' => 'auth.logout'));

    //Routes need to be admin to access
    Route::group(['middleware' => 'eppo\Http\Middleware\AdminMiddleware'], function()
    {
        Route::post('ppo/addDignosisAjax', array('uses' => 'PposController@addDignosisAjax', 'as' => 'ppos.addDiagnosisAjax'));
        Route::get('ppo/addDignosisAjax', array('uses' => 'PposController@addDignosisAjax', 'as' => 'ppos.addDiagnosisAjax'));

        Route::post('ppo/addRegimenAjax', array('uses' => 'PposController@addRegimenAjax', 'as' => 'ppos.addRegimenAjax'));
        Route::get('ppo/addRegimenAjax', array('uses' => 'PposController@addRegimenAjax', 'as' => 'ppos.addRegimenAjax'));

        Route::post('ppo/addReasonAjax', array('uses' => 'PposController@addReasonAjax', 'as' => 'ppos.addReasonAjax'));
        Route::get('ppo/addReasonAjax', array('uses' => 'PposController@addReasonAjax', 'as' => 'ppos.addReasonAjax'));

        Route::post('ppoitems/addLucodeAjax', array('uses' => 'PpoItemsController@addLucodeAjax', 'as' => 'ppoitems.addLucodeAjax'));
        Route::get('ppoitems/addLucodeAjax', array('uses' => 'PpoItemsController@addLucodeAjax', 'as' => 'ppoitems.addLucodeAjax'));

        Route::post('ppoitems/addMedicationAjax', array('uses' => 'PpoItemsController@addMedicationAjax', 'as' => 'ppoitems.addMedicationAjax'));
        Route::get('ppoitems/addMedicationAjax', array('uses' => 'PpoItemsController@addMedicationAjax', 'as' => 'ppoitems.addMedicationAjax'));

        Route::post('lucodes/ajaxListByMed/', array('uses' => 'LucodesController@ajaxListByMed','as' => 'lucodes.ajaxListByMed'));
        Route::get('lucodes/ajaxListByMed/', function()
        {
            return redirect()->home();
        });
        Route::post('ppoitems/ajaxListByMed/', array('uses' => 'PpoItemsController@ajaxListByMed','as' => 'ppoitems.ajaxListByMed'));
        Route::get('ppoitems/ajaxListByMed/', function()
        {
            return redirect()->home();
        });

        Route::get('medications', array('uses' => 'MedicationsController@index', 'as' => 'medications.index'));
        Route::get('medications/index', array('uses' => 'MedicationsController@index', 'as' => 'medications.index'));
        Route::post('medications/index', array('uses' => 'MedicationsController@index', 'as' => 'medications.index'));

        Route::get('ppos', array('uses' => 'PposController@index', 'as' => 'ppos.index'));
        Route::get('ppos/index', array('uses' => 'PposController@index', 'as' => 'ppos.index'));
        Route::post('ppos/index', array('uses' => 'PposController@index', 'as' => 'ppos.index'));

        Route::get('ppoitems/create/{ppoid}/{templateid?}/', array('uses' => 'PpoItemsController@create', 'as' => 'ppoitems.create'));

        Route::get('lucodes/create/{medid?}/', array('uses' => 'LucodesController@create', 'as' => 'lucodes.create'));

        Route::resource('diagnoses', 'DiagnosesController');
        Route::resource('diagnosisprimarycategories', 'DiagnosisPrimaryCategoriesController');
        Route::resource('diagnosissecondarycategories', 'DiagnosisSecondaryCategoriesController');
        Route::resource('regimens', 'RegimensController');
        Route::resource('medications', 'MedicationsController', array('except' => array('index')));
        Route::resource('ppos', 'PposController', array('except' => array('index')));
        Route::resource('lucodes', 'LucodesController', array('except' => array('create')));

        Route::resource('pposections', 'PpoSectionsController');
        Route::resource('prescriptionoperationrecords', 'PrescriptionOperationRecordsController');
        Route::resource('ppoitems', 'PpoItemsController', array('except' => array('create')));
        Route::resource('dosecalculationtypes', 'DoseCalculationTypesController');
        Route::resource('doseroutes', 'DoseRoutesController');
        Route::resource('doseunits', 'DoseUnitsController');
        Route::resource('mitteunits', 'MitteUnitsController');
        Route::resource('dosemodificationreasons', 'DoseModificationReasonsController');
        Route::resource('ppos.ppoitems', 'PpoItemsController');
    });

});

