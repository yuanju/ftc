<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::pattern('id', '[0-9]+');

Route::get('login', 'UserController@login');
Route::get('register', 'UserController@register');
Route::post('doLogin', 'UserController@doLogin');
Route::post('doRegister', 'UserController@doRegister');
Route::get('logout', 'UserController@logout');


Route::get('family', 'FamilyController@index');
Route::get('family/add', 'FamilyController@add');
Route::get('member/getList', 'FamilyMemberController@getList');
Route::get('member/edit', 'FamilyMemberController@edit');


//小工具
Route::get('tools', 'FamilyController@uiTools');


//家族照片
Route::get('familyPicture', 'FamilyPictureController@index');

//家庭传记
Route::controller('familyBiography', 'FamilyBiographyController');

//家族新闻
Route::controller('familyNews', 'FamilyNewsController');


//家族通知
Route::controller('familyNotice', 'FamilyNoticeController');

//系统通知
Route::get('sysHelper', 'SysHelperController@index');


