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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('login', 'AuthController@login')->name('login');
Route::get('/registercustomer', 'AuthController@registercustomer');
Route::get('/registersupplier', 'AuthController@registersupplier');
Route::get('/registermanager', 'AuthController@registermanager');
Route::post('/postregistercustomer', 'AuthController@postregistercustomer');
Route::post('/postregistersupplier', 'AuthController@postregistersupplier');
Route::post('/postregistermanager', 'AuthController@postregistermanager');
Route::post('/postlogin', 'AuthController@postlogin');
Route::get('/logout', 'AuthController@logout');

Route::group(['middleware' => ['auth', 'CheckRole:manager']], function(){
    Route::get('/home', 'AuthController@setviewhomemanager');
    Route::get('/manager/profile/profile/{id}', 'ManagerController@managerprofile');
    Route::get('/manager/profile/edit/{id}', 'ManagerController@managereditprofile');
    Route::post('/manager/profile/update/{id}', 'ManagerController@managerupdateprofile');
    Route::get('/manager/katalog/katalog', 'ManagerController@index');
    Route::get('/manager/katalog/detailkatalog/{id}', 'ManagerController@detail');
    Route::post('/manager/katalog/detailkatalog/{id}', 'ManagerController@katalog');
    Route::get('/manager/katalog/check_out', 'ManagerController@check_out');
    Route::delete('/manager/katalog/check_out/{id}', 'ManagerController@delete');
    Route::get('/manager/katalog/konfirmasi', 'ManagerController@konfirmasi');
    Route::get('/manager/katalog/pesanan', 'ManagerController@pesanan');
    Route::get('/manager/katalog/pesanan/{id}', 'ManagerController@detailpesanan');
    Route::get('/manager/katalog/bukti/{id}', 'ManagerController@buktiupload');
    Route::post('/manager/katalog/pesanan/{id}', 'ManagerController@bukti');
    Route::get('/manager/katalog/pendapatan', 'ManagerController@pendapatan');

    Route::get('/manager/kamar/kamar', 'ManagerController@indexkamar');
    Route::get('/manager/kamar/buatkamar', 'ManagerController@create');
    Route::post('/manager/kamar/kamar', 'ManagerController@store');
    Route::delete('/manager/kamar/kamar/{id}', 'ManagerController@destroy');
    Route::get('/manager/kamar/editkamar/{id}', 'ManagerController@edit');
    Route::post('/manager/kamar/kamar/{id}', 'ManagerController@update');

    Route::get('/manager/contact', 'ManagerController@contact');
});

Route::group(['middleware' => ['auth', 'CheckRole:supplier']], function(){
    Route::get('/supplier/dashboard', 'AuthController@setviewhomesupplier');
    Route::get('/supplier/profile/profile/{id}', 'SupplierController@supplierprofile');
    Route::get('/supplier/profile/edit/{id}', 'SupplierController@suppliereditprofile');
    Route::post('/supplier/profile/update/{id}', 'SupplierController@supplierupdateprofile');
    Route::get('/supplier/katalog/katalog', 'SupplierController@index');
    Route::get('/supplier/katalog/buatkatalog', 'SupplierController@create');
    Route::post('/supplier/katalog/katalog', 'SupplierController@store');
    Route::delete('/supplier/katalog/katalog/{id}', 'SupplierController@destroy');
    Route::get('/supplier/katalog/editkatalog/{id}', 'SupplierController@edit');
    Route::post('/supplier/katalog/katalog/{id}', 'SupplierController@update');
    Route::get('/supplier/contact', 'SupplierController@contact');

    Route::get('/supplier/katalog/verifikasi', 'SupplierController@verif');
    Route::get('/supplier/katalog/verifikasi/{id}', 'SupplierController@verifikasidetail');
    Route::get('/supplier/katalog/disetujuiverifikasi/{id}', 'SupplierController@disetujui');
    Route::get('/supplier/katalog/ditolakverifikasi/{id}', 'SupplierController@ditolak');
});

Route::group(['middleware' => ['auth', 'CheckRole:customer']], function(){
    Route::get('/customer/index', 'AuthController@setviewhomecustomer');
    Route::get('/customer/profile/profile/{id}', 'CustomerController@customerprofile');
    Route::get('/customer/profile/edit/{id}', 'CustomerController@customereditprofile');
    Route::post('/customer/profile/update/{id}', 'CustomerController@customerupdateprofile');
    Route::get('/customer/kamar/kamar', 'CustomerController@index');
    Route::get('/customer/kamar/detailkamar/{id}', 'CustomerController@detail');    

    Route::get('/customer/contact', 'CustomerController@contact');
});

