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


// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
Route::view('/user-register','register')->name('user.register')->middleware('guest');
Route::post('/user-register','RegisterUserController@index')->name('user.register.submit');

Route::view('/user-login','login')->name('user.login')->middleware('guest');
Route::post('/user-login','LoginUserController@authenticate')->name('user.login.submit');

Route::get('/user-logout', 'LoginUserController@logout')->name('user.logout');

// Route::resource('user','UserController')->except([
//     'show','update','create','edit','destroy' ,'index'
// ]);


// Route::prefix('admin')->middleware('auth')->name('user.')->group(function(){
//     // route::resource('user','UserController')->middleware('RegisterUserAuth');
//     route::resource('user','UserController');
// });

Route::prefix('manufacturer-admin')->middleware(['auth','ManufacturerRoleAuth'])->name('manufacturer.admin')->group(function(){
    route::get('/dashboard','ManufacturerHomeController@index')->name('.dashboard');
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
    ]);
    
});


Route::prefix('dealer-admin')->middleware(['auth','DealerRoleAuth'])->name('dealer.admin')->group(function(){
    route::get('/dashboard','DealerHomeController@index')->name('.dashboard');
    // route::resource('/vehicals','VehicalController',
    //     ['names' => 
    //         [
    //             'index'     => '.view.vehicals',
    //             'store'     => '.store.vehical',
    //             'create'    => '.create.vehical',
    //             'show'      => '.show.vehical',
    //             'destroy'   => '.delete.vehical',
    //             'edit'      => '.edit.vehical',
    //             'update'    => '.update.vehical',
    //         ]
    // ]);
    
});




