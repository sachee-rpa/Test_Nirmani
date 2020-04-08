<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['namespace' => 'SparePart', 'prefix' => 'spareparts'], function () {
    Route::post('spare_po/upsert', 'SparePoController@upsert'); 
    Route::delete('spare_po/delete/{SparePoItem}', 'SparePoController@removePoItem');
    Route::post('spare_po/get/{sparePo}', 'SparePoController@getPoItem');

    Route::post('spare_grn/upsert', 'SpareGrnController@upsert'); 
    Route::delete('spare_grn/delete/{spareGrnItem}', 'SpareGrnController@removeGrnItem');
    Route::post('spare_grn/get/{sparePart}', 'SpareGrnController@getGrnItems');
    Route::post('spare_grn/available/{spareGrnItem}', 'SpareGrnController@getGrnItem');

    Route::post('spare_invoice/upsert', 'SpareInvoiceController@upsert'); 
    Route::delete('spare_invoice/delete/{spareInvoiceItems}', 'SpareInvoiceController@removeInvoiceItem');
    Route::post('spare_invoice/get/{spareInvoice}', 'SpareInvoiceController@getInvoice');

    Route::post('spare_gin/upsert', 'SpareGinController@upsert');
    Route::post('spare_dn/upsert', 'SpareDnController@upsert');  


    Route::post('spare_grf/upsert', 'SpareGrfController@upsert'); 
  });
 

  Route::post('customer/get/{customer}', 'Admin\CustomerController@getDetails');