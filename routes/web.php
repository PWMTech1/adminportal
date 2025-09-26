<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::get('/download/{id}', 'App\Http\Controllers\HomeController@getDownload');

Route::post('/GetPatientInfo', 'App\Http\Controllers\TrackerController@GetPatientInfo');

Route::resource('/visitsandpatients', 'App\Http\Controllers\TrackerController');
//Route::post('/tracker/visitsandpatients','TrackerController@VisitsFilter');

Route::post("/Tracker/UpdatedFacesheet", 'App\Http\Controllers\TrackerController@UpdatedFacesheet');

Route::post("/UpdateVisitStart", 'App\Http\Controllers\TrackerController@UpdateVisitStart');

Route::get('/tracker/woundtrackerapp/{visitid}', 'App\Http\Controllers\TrackerController@WoundTrackerApp');

Route::post('/SaveUpdateComplete', 'App\Http\Controllers\TrackerController@UpdateComplete');

Route::post('/UpdateVisitComplete', 'App\Http\Controllers\TrackerController@UpdateVisitComplete');

Route::get("/pcc/facilitydetails/{id}", "App\Http\Controllers\PCCController@FacilityDetails");
Route::get('/pcc/movepatient/{id}', 'App\Http\Controllers\PCCController@MovePatient');
Route::get('/visit/monthlycounts', 'App\Http\Controllers\VisitController@GetMonthCounts');
Route::get('/ffs/compensation', 'App\Http\Controllers\FFSController@Compensation');
Route::post('/ffs/compensation', 'App\Http\Controllers\FFSController@Compensation');
Route::get('/visit/index', 'App\Http\Controllers\VisitController@Index');
Route::get('/visit/payertotals', 'App\Http\Controllers\VisitController@GetPayerTotals');
Route::get('/ffs/ffsdetails/{id}', 'App\Http\Controllers\FFSController@FFSDetails');
Route::get('/ffs/compensationdocument/{id}/{fromdate}/{todate}', 'App\Http\Controllers\FFSController@CompensationDocument');
Route::get('/pcc/facilitylist', 'App\Http\Controllers\PCCController@FacilityList');
Route::get('/pcc/organizations', 'App\Http\Controllers\PCCController@OrganizationList');

Route::get('/pcc/patientmanagement', 'App\Http\Controllers\PCCController@PatientManagement');
Route::post('/pcc/savelinknotetype', 'App\Http\Controllers\PCCController@SaveLinkNoteType');

Route::post('/pcc/savelinkcategory', 'App\Http\Controllers\PCCController@SaveLinkCategory');
Route::post('/pcc/pcclinkfacility', 'App\Http\Controllers\PCCController@PCCLinkFacilityList');

Route::post('/pcc/pcclinknotetype', 'App\Http\Controllers\PCCController@PCCLinkNoteTypeList');

Route::post('/pcc/pcclinkcategory', 'App\Http\Controllers\PCCController@PCCLinkCategoryList');

Route::post('/pcc/savelinkfacility', 'App\Http\Controllers\PCCController@SaveLinkFacility');

Route::post('/pcc/enableorg', 'App\Http\Controllers\PCCController@EnableOrg');

Route::get("/forms/stiphends", [App\Http\Controllers\FormStiphendController::class, "create"]);

Route::post("/forms/stiphends/store", [App\Http\Controllers\FormStiphendController::class, "store"]);

Route::post('/pcc/saveorg', 'App\Http\Controllers\PCCController@SaveOrg');
Route::post('/pcc/patientdetails', 'App\Http\Controllers\PCCController@PatientDetails');
Route::get('/pcc/patientlist/{facid}/{reload}', 'App\Http\Controllers\PCCController@PatientList');
Route::get('/pcc/redownload/{facid}/{autodelete}', 'App\Http\Controllers\PCCController@ReDownloadPatients');

Route::get('/pcc/redownloadnotetypes/{facid}', 'App\Http\Controllers\PCCController@ReDownloadNoteTypes');
Route::get('/pcc/redownloadcategories/{facid}', 'App\Http\Controllers\PCCController@ReDownloadCategories');

Route::get('/pcc/settings', 'App\Http\Controllers\PCCController@Settings');
Route::get('/pcc/errorlog', 'App\Http\Controllers\PCCController@ErrorLog');
Route::get('/pcc/webhook', 'App\Http\Controllers\PCCController@Webhooks');
Route::get("/facility/contacts/{code}", "App\Http\Controllers\FacilityController@Contacts");

Route::get("/facility/list", "App\Http\Controllers\FacilityController@index");
Route::get("/facility/edit/{id}", "App\Http\Controllers\FacilityController@edit");

Route::get("/Facility/EditContact/{id}", "App\Http\Controllers\FacilityController@EditContact");

Route::post("/SaveContact", "App\Http\Controllers\FacilityController@SaveContact");

Route::get('/visit/progressnotes/{id}', 'App\Http\Controllers\VisitController@GetProgressNotes');

Route::get('/downloadcsv', [App\Http\Controllers\ReportController::class, "downloadcsv"]);

Route::post("/createorder", [App\Http\Controllers\FormOrderSupplyController::class, "create_order"]);

Route::group(['middleware' => 'auth'], function () {
    Route::middleware(['password_expired'])->group(function () {
        Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
        Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
        Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
        Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
        Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
        Route::resource('forms/mileage', 'App\Http\Controllers\FormMileageController');
        Route::resource('forms/ordersupplies', 'App\Http\Controllers\FormOrderSupplyController');
        Route::resource('formexplorer', 'App\Http\Controllers\FormController');
        //Route::resource('facility','FacilityController');
        //Route::resource("/facility/contacts?code={code}","FacilityController@Contacts");
    });
    Route::get('password/expired', 'App\Http\Controllers\Auth\ExpiredPasswordController@expired')
        ->name('password.expired');
    Route::post('password/post_expired', 'App\Http\Controllers\Auth\ExpiredPasswordController@postExpired')
        ->name('password.post_expired');
});
Route::get("/tracker/notes/{id}", "App\Http\Controllers\TrackerController@VisitNotes");
Auth::routes();

Route::get("/viewallnotes", [App\Http\Controllers\TrackerController::class, "VisitAllNotes"]);
Route::get("/viewreviewednotes", [App\Http\Controllers\VisitController::class, "VisitReviewedNotes"]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post("/uploadfacesheet", [App\Http\Controllers\TrackerController::class, "uploadfacesheets"]);
Route::post("/savereviewedvisits", [App\Http\Controllers\TrackerController::class, "SaveReviewed"]);
Route::get("/Visit/Reviewed", [App\Http\Controllers\VisitController::class, "ViewReviewedVisits"]);
Route::get('/addpatient', [App\Http\Controllers\PatientController::class, 'AddPatient']);
Route::get("/patient/list", [App\Http\Controllers\PatientController::class, "List"]);

Route::get("/getcliniciandetails/{id}", [App\Http\Controllers\UserController::class, "ClinicianDetails"]);
Route::get("/getcontactdetails/{id}", [App\Http\Controllers\UserController::class, "ContactDetails"]);

Route::post('/savepatient', [App\Http\Controllers\PatientController::class, "SavePatient"])->name("savepatient");
Route::post("/addeditcodes", [App\Http\Controllers\BillingController::class, "addeditcodes"]);
Route::post("/addcptcodes", [App\Http\Controllers\BillingController::class, "addcptcodes"]);

Route::get("/getvisitsbymonth", [App\Http\Controllers\HomeController::class, "GetVisitsByMonth"]);

Route::get("/codelist", [App\Http\Controllers\FFSController::class, "CodeList"]);
Route::post('/ffs/cptcode/store', [App\Http\Controllers\FFSController::class, "saveCPTCode"]);

Route::post("/sendemails", [App\Http\Controllers\FFSController::class, "EmailDocuments"]);

Route::get("/RevenueDetails", [App\Http\Controllers\FFSController::class, "RevenueDetails"])->name("RevenueDetails");

Route::get("/RevenueDetailsPDF", [App\Http\Controllers\FFSController::class, "FFSDetailsPDF"])->name("RevenueDetailsPDF");

Route::get("/entitylist", [App\Http\Controllers\FFSController::class, "EntityList"]);
Route::post('/ffs/entity/store', [App\Http\Controllers\FFSController::class, "saveEntity"]);

Route::get('/visit/newprogressnote/{id}', [App\Http\Controllers\VisitController::class, "GetProgressNotePDF"])->middleware("guest")->name("newprogressnote");
Route::get('/visit/generatednote/{id}', [App\Http\Controllers\VisitController::class, "GetGeneratedNotePDF"]);
Route::get('/reports', [App\Http\Controllers\ReportController::class, "index"])->name("reports");
Route::get('/facesheets/{id}', [App\Http\Controllers\TrackerController::class, "facesheets"])->name("facesheets");
Route::get('/worklist/index', [App\Http\Controllers\WorkListController::class, "index"])->name("crmworklist");
Route::get('/CompensationDocument', [App\Http\Controllers\FFSController::class, "CompensationDocument"])->name("CompensationDocument");