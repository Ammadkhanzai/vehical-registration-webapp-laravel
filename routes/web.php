<?php

use App\Admin;

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

// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
Route::view('/user-register','register')->name('user.register')->middleware('guest');
Route::post('/user-register','RegisterUserController@index')->name('user.register.submit');

Route::view('/user-login','login')->name('user.login')->middleware('guest');
Route::post('/user-login','LoginUserController@authenticate')->name('user.login.submit');

Route::get('/user-logout', 'LoginUserController@logout')->name('user.logout');

Route::get('/', 'HomeController@index')->name('home');
Route::POST('/', 'HomeController@search')->name('verify-vehical');

// Route::resource('user','UserController')->except([
//     'show','update','create','edit','destroy' ,'index'
// ]);


// Route::prefix('admin')->middleware('auth')->name('user.')->group(function(){
//     // route::resource('user','UserController')->middleware('RegisterUserAuth');
//     route::resource('user','UserController');
// });


Route::prefix('admin')->name('admin')->group(function(){
    Route::get('/login','AdminLoginController@showLoginForm')->name('.login');
    Route::post('/login','AdminLoginController@login')->name('.submit.login');
    Route::get('/logout','AdminLoginController@logout')->name('.logout');
});

Route::prefix('admin')->name('admin')->middleware('AdminAuth:admin')->group(function(){
        
    //Login Routes
    route::get('/dashboard','AdminHomeController@index')->name('.home');
    route::post('/dashboard','AdminHomeController@updateProfile')->name('.update-profile');
    route::get('/dealer-profile-approvals','AdminHomeController@dealerProfileApprovalsView')->name('.dealer-profile-approval');
    route::POST('/dealer-profile-approvals','AdminHomeController@dealerProfileApprove')->name('.dealer-profile-approval-submit');
    route::get('/manufacturer-profile-approvals','AdminHomeController@manufacturerProfileApprovalsView')->name('.manufacturer-profile-approval');
    route::POST('/manufacturer-profile-approvals','AdminHomeController@manufacturerProfileApprove')->name('.manufacturer-profile-approval-submit');
    route::get('/user-profile-approvals','AdminHomeController@userProfileApprovalsView')->name('.user-profile-approval');
    route::POST('/user-profile-approvals','AdminHomeController@userProfileApprove')->name('.user-profile-approval-submit');
    route::get('/dealer-profiles','AdminHomeController@dealerProfileView')->name('.dealer-profile-view');
    route::get('/dealer-profiles/{id}','AdminHomeController@dealerProfileDetailsView')->name('.dealer.profile-details');
    route::get('/manufacturer-profiles','AdminHomeController@manufacturerProfileView')->name('.manufacturer-profile-view');
    route::get('/manufacturer-profiles/{id}','AdminHomeController@manufacturerProfileDetailsView')->name('.manufacturer.profile-details');
    route::get('/user-profiles','AdminHomeController@userProfileView')->name('.user-profile-view');
    route::get('/user-profiles/{id}','AdminHomeController@userProfileDetailsView')->name('.user-profile-details');
    


});

route::get('/manufacturer-admin/vehicals/data','AdminHomeController@data')->name('.data');

// dd(md5(44));
Route::prefix('manufacturer-admin')->middleware(['auth','ManufacturerRoleAuth'])->name('manufacturer.admin')->group(function(){
    
    route::get('/dealers','ManufacturerHomeController@showDealer')->name('.view.dealers')->middleware('ManufacturerProfileAuth');
    route::get('/dealers/{id}','TransferToDealerController@show')->name('.show.transfer-vehical')->middleware('ManufacturerProfileAuth');
    route::get('/transfered-vehicals/','TransferToDealerController@create')->name('.create.transfered-vehicals')->middleware('ManufacturerProfileAuth');
    route::resource('/vehicals','VehicalController',
        ['names' => 
            [
                'index'     => '.view.vehicals',
                'store'     => '.store.vehical',
                'create'    => '.create.vehical',
                'show'      => '.show.vehical',
                'destroy'   => '.delete.vehical',
                'edit'      => '.edit.vehical',
                'update'    => '.update.vehical',
            ]
    ])->middleware('ManufacturerProfileAuth');
    
    // Route::get('transfer-vehical/{id}', ['as' => '.view.transfer-vehical', 'uses' => 'TransferToDealerController@index']);

    route::resource('/transfer-vehical/','TransferToDealerController',
        ['names' => 
            [
                'index'     => '.view.transfer-vehical',
                'store'     => '.store.transfer-vehical',
                'create'    => '.create.transfered-vehical',
                'show'      => '.show.transfer-vehical',
                'destroy'   => '.delete.transfer-vehical',
                'edit'      => '.edit.transfer-vehical',
                'update'    => '.update.transfer-vehical',
            ]
        ])->except(['show','create','destroy','edit','update'])->middleware('ManufacturerProfileAuth');

    // route::post('/update-profile','ProfileApprovalController@update')->name('.update-profile');
    route::get('/dashboard','ManufacturerHomeController@index')->name('.dashboard');
    route::resource('/update-profile','ManufacturerProfileController',
        ['names'=>
            [
                // 'index' => '.dashboard',
                'update'     => '.update.manufacturer-profile', 
            ]
        ])->except(['show','create','destroy','edit','store','index']);
    
});







Route::prefix('dealer-admin')->middleware(['auth','DealerRoleAuth'])->name('dealer.admin')->group(function(){
    route::get('/dashboard','DealerHomeController@index')->name('.dashboard');
    route::get('/manufacturers','DealerHomeController@showManufacturers')->name('.view.manufacturers')->middleware('DealerProfileApproval');
    route::get('/receive-new-vehicals','DealerHomeController@receiveVehicals')->name('.receive.transfered-vehicals')->middleware('DealerProfileApproval');
    route::post('/receive-new-vehicals','DealerHomeController@receiveVehical')->name('.receive.transfered-vehical')->middleware('DealerProfileApproval');

    route::get('/vehicals','DealerHomeController@vehicals')->name('.view.vehicals')->middleware('DealerProfileApproval');
    route::get('/vehical/{id}','DealerHomeController@showVehical')->name('.show.vehical')->middleware('DealerProfileApproval');
    
    route::get('/transfer-to-client','DealerHomeController@transferVehicals')->name('.transfer.vehicals')->middleware('DealerProfileApproval');
    route::get('/transfer-to-client/{id}','DealerHomeController@transferVehicalSecond')->name('.transfer.vehicals.proceed')->middleware('DealerProfileApproval');
    route::post('/submit-transfer-to-client/','DealerHomeController@transferVehicalSubmit')->name('.transfer.vehicals.submit')->middleware('DealerProfileApproval');

    route::get('/transfered-vehicals','DealerHomeController@transferedVehicals')->name('.transfered.vehicals')->middleware('DealerProfileApproval');
    
    route::get('/clients','DealerHomeController@clients')->name('.view.clients')->middleware('DealerProfileApproval');
    route::get('/clients/{id}','DealerHomeController@client')->name('.view.client')->middleware('DealerProfileApproval');
    route::post('/update-profile/','DealerHomeController@updateProfile')->name('.update.dealer-profile')->middleware('DealerProfileApproval');
    
});

Route::prefix('user-admin')->middleware(['auth','UserRoleAuth'])->name('user.admin')->group(function(){
    route::get('/dashboard','UserHomeController@index')->name('.dashboard');
    route::get('/dealers','UserHomeController@showDealers')->name('.view.dealers')->middleware('userProfileApproval');
    route::get('/vehicals','UserHomeController@showVehicals')->name('.view.vehicals')->middleware('userProfileApproval');
    route::get('/vehicals/{id}','UserHomeController@vehical')->name('.show.vehical')->middleware('userProfileApproval');
    route::get('/receive-vehicals','UserHomeController@showReceiveVehicals')->name('.view.receive-vehicals')->middleware('userProfileApproval');
    route::post('receive-vehicals','UserHomeController@receiveVehical')->name('.receive.transfered-vehical')->middleware('userProfileApproval');

    route::get('transfer-vehical/{id}','UserHomeController@showTransferVehical')->name('.show.transfer-vehical')->middleware('userProfileApproval');
    route::post('/search-user-form','UserHomeController@searchUser')->name('.search.user')->middleware('userProfileApproval');
    route::post('/transfer-vehical-submit','UserHomeController@transferVehical')->name('.transfer-vehical')->middleware('userProfileApproval');
    route::get('/transfered-vehicals','UserHomeController@transferedVehical')->name('.transfered-vehical')->middleware('userProfileApproval');
    route::post('/dashboard','UserHomeController@updateProfile')->name('.update.user-profile')->middleware('userProfileApproval');
    
});




