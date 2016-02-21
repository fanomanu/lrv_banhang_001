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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

View::share('title','Đây là project1');

Route::get('aaa',function(){
	return view('admin.category.add');
});


Route::group(['prefix'=>'admin','middleware' => 'auth'], function(){
	// -- Category --
	Route::group(['prefix'=>'category'], function(){
		// list
		Route::get('list',['as'=>'admin.category.list','uses'=>'CategoryController@getList']);
		// add
		Route::get('add',['as'=> 'admin.category.getAdd', 'uses'=>'CategoryController@getAdd']);
		Route::post('add',['as'=> 'admin.category.postAdd', 'uses'=>'CategoryController@postAdd']);
		// delete
		Route::get('delete/{id}',['as'=> 'admin.category.getDelete', 'uses'=>'CategoryController@getDelete']);
		// edit
		Route::get('edit/{id}',['as'=> 'admin.category.getEdit', 'uses'=>'CategoryController@getEdit']);
		Route::post('edit/{id}',['as'=> 'admin.category.postEdit', 'uses'=>'CategoryController@postEdit']);
	});
	// -- End Category --

	// -- Product --
	Route::group(['prefix'=>'product'],function(){
		// list
		Route::get('list',['as'=> 'admin.product.list', 'uses'=>'ProductController@getList']);
		// add
		Route::get('add',['as'=> 'admin.product.getAdd', 'uses'=>'ProductController@getAdd']);
		Route::post('add',['as'=> 'admin.product.postAdd', 'uses'=>'ProductController@postAdd']);
		// delete
		Route::get('delete/{id}',['as'=> 'admin.product.getDelete', 'uses'=>'ProductController@getDelete']);
		// edit
		Route::get('edit/{id}',['as'=> 'admin.product.getEdit', 'uses'=>'ProductController@getEdit']);
		Route::post('edit/{id}',['as'=> 'admin.product.postEdit', 'uses'=>'ProductController@postEdit']);
		// delete image
		Route::get('delimg/{id}',['as'=>'admin.product.delimg', 'uses'=> 'ProductController@getDelImg']);
	});
	// -- End Product --

	// -- User --
	Route::group(['prefix'=>'user'],function(){
		// list
		Route::get('list',['as'=> 'admin.user.list', 'uses'=>'UserController@getList']);
		// add
		Route::get('add',['as'=> 'admin.user.getAdd', 'uses'=>'UserController@getAdd']);
		Route::post('add',['as'=> 'admin.user.postAdd', 'uses'=>'UserController@postAdd']);
		// delete
		Route::get('delete/{id}',['as'=> 'admin.user.getDelete', 'uses'=>'UserController@getDelete']);
		// edit
		Route::get('edit/{id}',['as'=> 'admin.user.getEdit', 'uses'=>'UserController@getEdit']);
		Route::post('edit/{id}',['as'=> 'admin.user.postEdit', 'uses'=>'UserController@postEdit']);
	});
	// -- End User --
});

Route::get('loai-san-pham/{id}/{tenloai}',['as' => 'loaisanpham','uses' => 'WelcomeController@loaisanpham']);
Route::get('chi-tiet-san-pham/{id}/{tenloai}',['as' => 'chitietsanpham','uses' => 'WelcomeController@chitietsanpham']);
Route::get('lien-he/',['as' => 'getLienhe','uses' => 'WelcomeController@getLienhe']);
Route::post('lien-he/',['as' => 'postLienhe','uses' => 'WelcomeController@postLienhe']);
Route::get('mua-hang/{id}/{tensanpham}',['as' => 'muahang', 'uses'=>'WelcomeController@muahang']);
Route::get('gio-hang',['as'=>'giohang','uses'=>'WelcomeController@giohang']);
Route::get('xoa-sp-gio-hang/{id}',['as'=>'xoaspgiohang','uses'=>'WelcomeController@xoaspgiohang']);
Route::get('cap-nhat-gio-hang/{id}/{qty}',['as'=>'capnhatgiohang','uses'=>'WelcomeController@capnhatgiohang']);