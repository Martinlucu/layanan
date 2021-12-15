<?php

use Illuminate\Support\Facades\Route;

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




Auth::routes();
Route::get('/', function () {
    return view('home');
})->middleware('auth');
Route::get('/home', 'HomeController@index');
/*
Route::get('/login/aak', 'Auth\LoginController@showaakLoginForm')->name('logaak');
Route::get('/login/mhs', 'Auth\LoginController@showmhsLoginForm')->name('logmhs');*/
Route::get('/register/aak', 'Auth\RegisterController@showaakRegisterForm');
Route::get('/register/mhs', 'Auth\RegisterController@showmhsRegisterForm');
Route::get('/register/dosen', 'Auth\RegisterController@showdosenRegisterForm');

/*
Route::post('/login/aak', 'Auth\LoginController@aakLogin');
Route::post('/login/mhs', 'Auth\LoginController@mhsLogin');*/
Route::post('/register/aak', 'Auth\RegisterController@createaak');
Route::post('/register/mhs', 'Auth\RegisterController@createmhs');
Route::post('/register/dosen', 'Auth\RegisterController@createdosen');

Route::group(['middleware' => 'auth:aak'], function () {
    Route::get('/aak', 'utamaController@aak');
    Route::get('/dashcuti', 'DashboardController@dashcuti');
    Route::get('/dashdispen', 'DashboardController@dashdispen');
    Route::get('/dashyudi', 'DashboardController@dashyudi');
    Route::get('/dashbst', 'DashboardController@dashbst');

    Route::get('/detyudi', 'detailController@detyudi');
    Route::get('/detyudi/stjyudi/{id}', 'detailController@stjyudi');
    Route::get('/detyudi/tlkyudi/{id}', 'detailController@tlkyudi');
    Route::get('/detdispen', 'detailController@detdispen');
    Route::get('/detdispen/stjdis/{id}', 'detailController@stjdis');
    Route::get('/detdispen/tlkdis/{id}', 'detailController@tlkdis');
    Route::get('/detbst', 'detailController@detbst');
    Route::get('/detbst/stjbst/{id}', 'detailController@stjbst');
    Route::get('/detbst/tlkbst/{id}', 'detailController@tlkbst');
    Route::get('/detcuti', 'detailController@detcuti');
    Route::get('/detcuti/stjcuti/{id}', 'detailController@stjcuti');
    Route::get('/detcuti/tlkcuti/{id}', 'detailController@tlkcuti');
    Route::get('/setting', 'settingController@setting');
    Route::post('/updateset', 'settingController@updateset');

    Route::get('/dokdispen', 'dokumenController@dokdispen');
    Route::get('/dokdispen/export_excel', 'dokumenController@export_excel');
    Route::get('/dokyudi', 'dokumenController@dokyudi');
    Route::get('/dokyudi/export_yudi', 'dokumenController@export_yudi');
    Route::get('/dokbst', 'dokumenController@dokbst');
    Route::get('/dokbst/export_bst', 'dokumenController@export_bst');
    Route::get('/dokcuti', 'dokumenController@dokcuti');
    Route::get('/dokcuti/export_cuti', 'dokumenController@export_cuti');
    });

Route::group(['middleware' => 'auth:mhs'], function () {
    Route::view('/mhs', 'mhs');
    Route::get('/mhscuti', 'mahasiswaController@mhscuti');
    Route::get('/mhsdispen', 'mahasiswaController@mhsdispen');
    Route::get('/mhsyudi', 'mahasiswaController@mhsyudi');
    Route::get('/mhsbst', 'mahasiswaController@mhsbst');

    // Route upload
    Route::post('/uploadbss', 'mahasiswaController@createbss');
    Route::post('/uploadbst', 'mahasiswaController@createbst');
    Route::post('/uploadyudisium', 'mahasiswaController@createyudi');
    Route::post('/uploaddispensasi', 'mahasiswaController@createdispensasi');
    });

Route::group(['middleware' => 'auth:dosen'], function () {
        Route::get('/doshome', 'dosenController@doshome');
        
        
    });
