<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\BarangayController;
use App\Http\Controllers\BarangayOfficialController;
use App\Http\Controllers\DownloadFileController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\LockAccountController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\ResidentSectorController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\SitioController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResidentImportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserImportController;
use Illuminate\Support\Facades\Auth;


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

//Access website/storage-link after deploying to link the storage to public
Route::get('/storage-link', function(){
    $targetFolder = storage_path('app/public');
    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    symlink($targetFolder,$linkFolder);
    echo "Link Success";
});


Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');


//Route::get('/', function () {
//    return view('welcome');
//});



//Auth::routes();
Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
  ]);
//===================================================================================//
// ==================lock screen ====================================================//
//===================================================================================//
Route::controller(LockAccountController::class)->group(function () {
    Route::get('locked', 'locked')->middleware('auth')->name('login.locked');
    Route::post('unlock', 'unlock')->name('login.unlock');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(DownloadFileController::class)->group(function(){
    Route::get('get/', 'downloadFile')->name('template.download');
    Route::get('getfile/{id}', 'downloadExcelFile')->name('excelfile.download');
});

//===================================================================================//
//=============Activity Log Controller===============================================//
//===================================================================================//
Route::resource('activity_logs', ActivityLogController::class);
Route::get('view.logs/{id}', [ActivityLogController::class, 'viewLogs'])->name('view.logs');


//===================================================================================//
//==============Barangay-Sectors Controller==========================================//
//===================================================================================//
Route::resource('barangays', BarangayController::class);
Route::controller(BarangayController::class)->group(function(){
    Route::get('Dashboard/{barangay}','dashboard');
    Route::get('Residents/{barangay}','barangayResidentList');
});


//===================================================================================//
//==============Barangay Officials Controller========================================//
//===================================================================================//
Route::resource('barangay_officials', BarangayOfficialController::class);


//===================================================================================//
//==============File Controller======================================================//
//===================================================================================//
Route::resource('files', FileController::class);


//===================================================================================//
//==============Resident Controller==================================================//
//===================================================================================//
Route::resource('residents', ResidentController::class);
Route::controller(ResidentController::class)->group(function(){
    Route::get('residents', 'index')->name('residents.index');
    Route::put('residents', 'index');
    Route::put('change-address', 'changeBrgy')->name('change.address');
    Route::delete('resDelAll', 'deleteAll')->name('resident.multi-delete');
});



//1 - Family Head, 2 - Farmer, 3 - Household Head, 4 - OFW
//5 - Out Of School Youth, 6 - PWD, 7 - Senior Citizen, 8 - Solo Parent, 9 - 4Ps, 10 - Business Owener
//===================================================================================//
//==============Resident Sectors Controller==========================================//
//===================================================================================//
Route::resource('resident_sectors', ResidentSectorController::class);
Route::controller(ResidentSectorController::class)->group(function(){
    Route::get('family_heads/list', 'indexFamilyHead')->name('family.head');
    Route::get('farmers/list', 'indexFarmer')->name('farmers.list');
    Route::get('household_heads/list', 'indexHouseholdHead')->name('household.head');
    Route::get('ofw/list', 'indexOFW')->name('ofw.list');
    Route::get('out_of_school_youth/list', 'indexOSY')->name('osy.list');
    Route::get('person_with_disability/list', 'indexPWD')->name('pwd.list');
    Route::get('senior_citizen/list', 'indexSeniorCitizen')->name('senior_citisen.list');
    Route::get('solo_parent/list', 'indexSoloParent')->name('solo_parent.list');
    Route::get('4ps/list', 'index4Ps')->name('4ps.list');
    Route::get('business_owner/list', 'indexBusinessOwner')->name('business_owner.list');
    Route::get('children/list', 'indexChildren')->name('children.list');
    Route::get('women/list', 'indexWomen')->name('women.list');

    Route::get('view.household.member/{id}', 'viewHouseholdMember')->name('household.view');
    Route::delete('delete', 'deleteResSec')->name('delete.res.sec');
});


//===================================================================================//
//==============Resident Import & Export Controller==================================//
//===================================================================================//
Route::controller(ResidentImportController::class)->group(function(){
    Route::get('residents_import', 'index');
    Route::get('residents-export', 'exportResident')->name('residents.export');
    Route::post('residents-import', 'importResident')->name('residents.import');    
});

Route::get('export/{id}', [ExportController::class, 'exportExcel'])->name('excel.export');
Route::get('exportBarangay/{barangay}', [ExportController::class, 'exportBarangayExcel'])->name('excel.export.brgy');


//===================================================================================//
//==============Barangay-Sectors Controller==========================================//
//===================================================================================//
Route::resource('sectors', SectorController::class);



//===================================================================================//
//==============User Controller======================================================//
//===================================================================================//
Route::resource('users', UserController::class);

Route::controller(UserController::class)->group(function(){
    Route::get('block/{id}', 'blockUnblock')->name('block.unblock');
    Route::get('reset/{id}', 'resetPassword')->name('reset.password');
    Route::put('user-archive', 'archive')->name('user.archive');
    Route::put('user-restore', 'restore')->name('user.restore');
    Route::get('archives', 'archiveIndex')->name('archive.index');
    Route::get('profile/{id}', 'profile')->name('edit.profile');
    Route::put('change.password/{id}', 'changePassword')->name('change.password');
});



//===================================================================================//
//==============User Import Controller===============================================//
//===================================================================================//
Route::controller(UserImportController::class)->group(function(){
    Route::get('users_import', 'index');
    Route::get('users-export', 'exportUser')->name('users.export');
    Route::post('users-import', 'importUser')->name('users.import');
});


//===================================================================================//
//==============Setting Controller===================================================//
//===================================================================================//
Route::controller(SettingController::class)->group(function(){
    Route::get('settings/user_roles', 'indexUserRoles')->name('settings.role');
    Route::get('settings/barangay', 'indexBrgy')->name('settings.brgy');
    Route::get('settings/sector', 'indexSctr')->name('settings.sector');
});