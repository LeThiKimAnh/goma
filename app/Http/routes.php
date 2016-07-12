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

Route::get('/', function () {
    return view('welcome');
});

Route::get('vatlieu/add',['as'=>'getVatLieu','uses'=>'VatLieuController@get_themVatLieu','middleware'=>'auth']);
Route::post('vatlieu/add',['as'=>'postVatLieu','uses'=>'VatLieuController@post_themVatLieu','middleware'=>'auth']);
Route::get('vatlieu/list',['as'=>'list','uses'=>'VatLieuController@listVl','middleware'=>'auth']);
Route::get('vatlieu/del/{id}',['as'=>'delvatlieu','uses'=>'VatLieuController@deleteVL','middleware'=>'auth']);
Route::get('vatlieu/edit/{id}',['as'=>'getEdit','uses'=>'VatLieuController@getEdit','middleware'=>'auth']);
Route::post('vatlieu/edit/{id}',['as'=>'postEdit','uses'=>'VatLieuController@postEdit','middleware'=>'auth']);

Route::get('vatdung/add',['as'=>'getVatdung','uses'=>'VatDungController@get_themVatDung','middleware'=>'auth']);
Route::post('vatdung/add',['as'=>'postVatdung','uses'=>'VatDungController@post_themVatDung','middleware'=>'auth']);
Route::get('vatdung/list',['as'=>'vd-getList','uses'=>'VatDungController@listVd','middleware'=>'auth']);
Route::get('vatdung/delete/{id}',['as'=>'delvatdung','uses'=>'VatDungController@deleteVD','middleware'=>'auth']);
Route::get('vatdung/edit/{id}',['as'=>'getEditVD','uses'=>'VatDungController@getEdit','middleware'=>'auth']);
Route::post('vatdung/edit/{id}',['as'=>'postEditVD','uses'=>'VatDungController@postEdit','middleware'=>'auth']);
Route::get('vatdung/chitiet/{id}',['as'=>'chitietVD','uses'=>'VatDungController@chitiet','middleware'=>'auth']);

Route::get('donhang/add',['as'=>'getDonhang','uses'=>'DonHangController@get_themDonHang','middleware'=>'auth']);
Route::post('donhang/add',['as'=>'postDonhang','uses'=>'DonHangController@post_DonHang','middleware'=>'auth']);
Route::get('donhang/list',['as'=>'listDh','uses'=>'DonHangController@listDh','middleware'=>'auth']);
Route::get('donhang/delete/{id}',['as'=>'deldonhang','uses'=>'DonHangController@deleteDH','middleware'=>'auth']);
Route::get('donhang/edit/{id}',['as'=>'getEditDH','uses'=>'DonHangController@getEdit','middleware'=>'auth']);
Route::post('donhang/edit/{id}',['as'=>'postEditDH','uses'=>'DonHangController@postEdit','middleware'=>'auth']);
Route::get('donhang/chitiet/{id}',['as'=>'chitietDH','uses'=>'DonHangController@chitiet','middleware'=>'auth']);
Route::get('donhang/chitietDaXL/{id}',['as'=>'chitietDaXL','uses'=>'DonHangController@chitiet_daXL','middleware'=>'auth']);
Route::get('donhang/listDaXL',['as'=>'listDhDaXL','uses'=>'DonHangController@listDhDaXL','middleware'=>'auth']);
Route::get('donhang/listDhCXL',['as'=>'listDhCXL','uses'=>'DonHangController@listDhCXL','middleware'=>'auth']);
Route::post('donhang/listByMa',['as'=>'listByMa','uses'=>'DonHangController@listByMa','middleware'=>'auth']);
Route::post('donhang/listByNameKH',['as'=>'listByNameKH','uses'=>'DonHangController@listByNameKH','middleware'=>'auth']);
Route::post('donhang/listByNL',['as'=>'listByNL','uses'=>'DonHangController@listByNL','middleware'=>'auth']);
Route::post('donhang/listByDate',['as'=>'listByDate','uses'=>'DonHangController@listByDate','middleware'=>'auth']);



Route::post('session/{id}',['as'=>'session','uses'=>'SessionController@session','middleware'=>'auth']);
Route::get('result/{id}',['as'=>'result','uses'=>'SessionController@result','middleware'=>'auth']);

Route::get('user/add',['as'=>'userAdd','uses'=>'UserController@getAdd','middleware'=>'auth']);
Route::post('user/add',['as'=>'userPostAdd','uses'=>'UserController@postAdd','middleware'=>'auth']);
Route::get('user/list',['as'=>'listUser','uses'=>'UserController@listUser','middleware'=>'auth']);
Route::get('user/delete/{id}',['as'=>'delUser','uses'=>'UserController@deleteUser','middleware'=>'auth']);
Route::get('user/edit/{id}',['as'=>'getEditUser','uses'=>'UserController@getEdit','middleware'=>'auth']);
Route::post('user/edit/{id}',['as'=>'postEditUser','uses'=>'UserController@postEdit','middleware'=>'auth']);
Route::get('user/repass',['as'=>'getRepass','uses'=>'UserController@getRepass']);
Route::post('user/repass',['as'=>'postRepass','uses'=>'UserController@postRepass']);


Route::controllers([
		'auth' =>'Auth\AuthController',
		'password'=>'Auth\PasswordController'
	]);

Route::get('user/login',['as'=>'getLogin','uses'=>'Auth\AuthController@getLogin']);
Route::post('user/login',['as'=>'postLogin','uses'=>'Auth\AuthController@postLogin']);

Route::post('user/logout',['as'=>'postLogout','uses'=>'Auth\AuthController@postLogout']);


Route::get('dashboard',['as'=>'dashboard','middleware'=>'auth','uses'=>'DashboardController@dashboard','middleware'=>'auth']);
