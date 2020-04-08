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


 
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Auth::routes(['register' => false]);
Route::get('/', 'HomeController@index');
Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::group(['namespace' => 'admin', 'prefix' => 'admin'], function () {
  Route::resource('users', 'UserController');
  Route::resource('machines', 'MachineController');
  Route::resource('units', 'UnitController');
  Route::resource('countries', 'CountryController');
  Route::resource('brands', 'BrandController');
  Route::resource('currencies', 'CurrencyController');
  Route::resource('brand_models', 'BrandModelController');

  Route::resource('spare_parts', 'SparePartController');
  Route::get('spare_parts/{id?}/{name?}/{brand_id?}/{brand_model_id?}/{machine_id?}/{part_number?}', 'SparePartController@index')->name('spare_parts.search');
 
  Route::resource('suppliers', 'SupplierController');
  Route::get('suppliers/{id?}/{name?}/{country_id?}/{email?}', 'SupplierController@index')->name('suppliers.search');
 
  Route::resource('materials', 'MaterialController');
  Route::get('materials/{id?}/{name?}/{country_id?}/{email?}', 'MaterialController@index')->name('materials.search');

  Route::resource('machineries', 'MachineryController');
  Route::get('machineries/{id?}/{name?}/{brand_id?}/{brand_model_id?}/{machine_id?}/{part_number?}', 'MachineryController@index')->name('machineries.search');
 
  Route::resource('customers', 'CustomerController');
  Route::get('customers/{id?}/{name?}/{email?}', 'CustomerController@index')->name('customers.search');
 
  Route::resource('employee_categories', 'EmployeeCategoryController');

  Route::resource('employees', 'EmployeeController');
  Route::get('employees/{id?}/{name?}/{nic_number?}/{employee_category_id?}', 'EmployeeController@index')->name('employees.search');


  
});

Route::group(['namespace' => 'Overhead', 'prefix' => 'accounts_overhead'], function () {
  Route::resource('accounts', 'AccountController');
  Route::resource('sub_accounts', 'SubAccountController');
});

Route::group(['namespace' => 'SparePart', 'prefix' => 'spareparts'], function () {
  Route::resource('spare_po', 'SparePoController'); 
  Route::get('spare_po/{id?}/{name?}/{company_id?}/{user_id?}/{employee_categories?}', 'SparePoController@index')->name('spare_po.search');
  Route::get('spare_po_print/{sparePo}', 'SparePoController@print')->name('spare_po.print');
  
  Route::resource('spare_grn', 'SpareGrnController'); 
  Route::get('spare_grn/{id?}/{name?}/{company_id?}/{user_id?}/{employee_categories?}', 'SparePoController@index')->name('spare.grn.search');
  Route::get('spare_grn_print/{spareGrn}', 'SpareGrnController@print')->name('spare_grn.print');
  Route::resource('customer_pos', 'CustomerPoController'); 

  Route::resource('spare_invoice', 'SpareInvoiceController'); 
  Route::get('spare_invoice/{id?}/{name?}/{company_id?}/{user_id?}/{employee_categories?}', 'SparePoController@index')->name('spare.grn.search');
  Route::get('spare_invoice_print/{spareInvoice}', 'SpareInvoiceController@print')->name('spare_invoice.print');
  Route::get('spare_invoice_print/{spareGrn}', 'SpareGrnController@print')->name('spare_invoice.print');


  Route::resource('spare_gin', 'SpareGinController'); 
  Route::get('spare_gin_print/{spareGin}', 'SpareGinController@print')->name('spare_gin.print');

  Route::resource('spare_dn', 'SpareDnController'); 
  Route::get('spare_dn_print/{spareDn}', 'SpareDnController@print')->name('spare_dn.print');

  Route::resource('spare_grf', 'SpareGrfController'); 
  Route::get('spare_grf_print/{spareDn}', 'SpareGrfController@print')->name('spare_grf.print');
});

Route::post('/get_select', 'DynamicSelectController@index')->name('select');