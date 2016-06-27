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
Route::get('test',function(){
	return view('admin.donhang.add');
});

Route::get('vatlieu/add',['as'=>'getVatLieu','uses'=>'VatLieuController@get_themVatLieu']);
Route::post('vatlieu/add',['as'=>'postVatLieu','uses'=>'VatLieuController@post_themVatLieu']);
Route::get('vatlieu/list',['as'=>'list','uses'=>'VatLieuController@list']);
Route::get('vatlieu/del/{id}',['as'=>'delvatlieu','uses'=>'VatLieuController@delete']);
Route::get('vatlieu/edit/{id}',['as'=>'getEdit','uses'=>'VatLieuController@getEdit']);
Route::post('vatlieu/edit/{id}',['as'=>'postEdit','uses'=>'VatLieuController@postEdit']);

Route::get('vatdung/add',['as'=>'getVatdung','uses'=>'VatDungController@get_themVatDung']);
Route::post('vatdung/add',['as'=>'postVatdung','uses'=>'VatDungController@post_themVatDung']);
Route::get('vatdung/list',['as'=>'vd-getList','uses'=>'VatDungController@list']);
Route::get('vatdung/delete/{id}',['as'=>'delvatdung','uses'=>'VatDungController@delete']);
Route::get('vatdung/edit/{id}',['as'=>'getEditVD','uses'=>'VatDungController@getEdit']);
Route::post('vatdung/edit/{id}',['as'=>'postEditVD','uses'=>'VatDungController@postEdit']);
Route::get('vatdung/chitiet/{id}',['as'=>'chitietVD','uses'=>'VatDungController@chitiet']);

Route::get('donhang/add',['as'=>'getDonhang','uses'=>'DonHangController@get_themDonHang']);
Route::post('donhang/add',['as'=>'postDonhang','uses'=>'DonHangController@post_DonHang']);
Route::get('donhang/list',['as'=>'listDh','uses'=>'DonHangController@list']);
Route::get('donhang/delete/{id}',['as'=>'deldonhang','uses'=>'DonHangController@delete']);
Route::get('donhang/edit/{id}',['as'=>'getEditDH','uses'=>'DonHangController@getEdit']);
Route::post('donhang/edit/{id}',['as'=>'postEditDH','uses'=>'DonHangController@postEdit']);
Route::get('donhang/chitiet/{id}',['as'=>'chitietDH','uses'=>'DonHangController@chitiet']);

Route::get('session/{id}',['as'=>'session','uses'=>'SessionController@session']);