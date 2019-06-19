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


//page requests
Route::get('/','App@index')->name('home');
Route::get('/login','App@login')->name('login');
Route::get('/logout','App@Logout')->name('logout');
Route::get('/maintenance','App@Maintenance')->name('maintenance');
Route::get('/client','ClientDetail@index')->name('clientDetails');
Route::get('/summary','ClientDetail@summary')->name('clientSummary');


//posts
Route::post('process_login', 'ClientDetail@clientLogin');
Route::post('process_personal_details', 'ClientDetail@processPersonalDetails');
Route::post('process_employment_details', 'ClientDetail@processEmploymentDetails');
Route::post('process_correspondence_details', 'ClientDetail@processCorrespondenceDetails');
Route::post('process_nok_details', 'ClientDetail@processNextOfKinDetails');
Route::post('process_appointment', 'ClientDetail@processAppointment');
Route::post('get_lgas','ClientDetail@getLGAsForState');




