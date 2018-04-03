<?php
header('Access-Control-Allow-Origin: *');
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

//
//Route::get('/', function () {
//    return view('pagina.index');
//});
Route::get('/', ['as' => 'pagina.index', 'uses' => 'HomeController@index']);
Route::get('/contact', ['as' => 'pagina.contact', 'uses' => 'HomeController@agents']);
Route::get('/agents', ['as' => 'pagina.agents', 'uses' => 'HomeController@agents']);
Route::get('/about', ['as' => 'pagina.about', 'uses' => 'HomeController@about']);
Route::get('/list', ['as' => 'pagina.list', 'uses' => 'HomeController@listado']);
Route::get('/tasaciones', ['as' => 'pagina.tasaciones', 'uses' => 'HomeController@tasaciones']);
Route::get('/administramos', ['as' => 'pagina.administramos', 'uses' => 'HomeController@administramos']);


Route::get('/property-detail/{propiedad}', ['as' => 'pagina.property-detail', 'uses' => 'HomeController@property_detail']);


//Entrust::routeNeedsRole('admin/', 'admin', Redirect::to('/home'));
/*
|--------------------------------------------------------------------------
| API routes
|--------------------------------------------------------------------------
*/
//solicitud de token
Route::post('auth_login', 'API\APIAuthController@userAuth');

Route::group(['middleware' => 'jwt.auth'], function () {
//rutas protegidas por token


});

Route::post('getLoginCliente', 'API\APIAuthController@getLoginCliente');


Route::group(['prefix' => 'api', 'namespace' => 'API'], function () {
    Route::group(['prefix' => 'v1'], function () {
        require config('infyom.laravel_generator.path.api_routes');
    });
});

Route::get('/admin/', ['middleware' => 'auth', function () {

}]);


Route::get('/homeadmin', ['as' => 'admin.home', 'uses' => 'HomeController@homeAdmin']);
Route::get('/admin', ['as' => 'admin.home', 'uses' => 'HomeController@homeAdmin']);


Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@logout');

// Registration Routes...
Route::get('register', 'Auth\AuthController@getRegister');
Route::post('register', 'Auth\AuthController@postRegister');

// Password Reset Routes...
Route::get('password/reset', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');


Route::get('admin/users/editPassword', ['as' => 'admin.users.editPassword', 'uses' => 'Admin\UserController@editPassword', 'middleware' => ['auth']]);
Route::post('admin/users/updatePassword', ['as' => 'admin.users.updatePassword', 'uses' => 'Admin\UserController@updatePassword', 'middleware' => ['auth']]);

Route::get('admin/users', ['as' => 'admin.users.index', 'uses' => 'Admin\UserController@index']);
Route::post('admin/users', ['as' => 'admin.users.store', 'uses' => 'Admin\UserController@store']);
Route::get('admin/users/create', ['as' => 'admin.users.create', 'uses' => 'Admin\UserController@create']);
Route::put('admin/users/{users}', ['as' => 'admin.users.update', 'uses' => 'Admin\UserController@update']);
Route::patch('admin/users/{users}', ['as' => 'admin.users.update', 'uses' => 'Admin\UserController@update']);
Route::delete('admin/users/{users}', ['as' => 'admin.users.destroy', 'uses' => 'Admin\UserController@destroy']);
Route::get('admin/users/{users}', ['as' => 'admin.users.show', 'uses' => 'Admin\UserController@show']);
Route::get('admin/users/{users}/edit', ['as' => 'admin.users.edit', 'uses' => 'Admin\UserController@edit']);


Route::get('admin/estadoPropiedads', ['as' => 'admin.estadoPropiedads.index', 'uses' => 'Admin\EstadoPropiedadController@index']);
Route::post('admin/estadoPropiedads', ['as' => 'admin.estadoPropiedads.store', 'uses' => 'Admin\EstadoPropiedadController@store']);
Route::get('admin/estadoPropiedads/create', ['as' => 'admin.estadoPropiedads.create', 'uses' => 'Admin\EstadoPropiedadController@create']);
Route::put('admin/estadoPropiedads/{estadoPropiedads}', ['as' => 'admin.estadoPropiedads.update', 'uses' => 'Admin\EstadoPropiedadController@update']);
Route::patch('admin/estadoPropiedads/{estadoPropiedads}', ['as' => 'admin.estadoPropiedads.update', 'uses' => 'Admin\EstadoPropiedadController@update']);
Route::delete('admin/estadoPropiedads/{estadoPropiedads}', ['as' => 'admin.estadoPropiedads.destroy', 'uses' => 'Admin\EstadoPropiedadController@destroy']);
Route::get('admin/estadoPropiedads/{estadoPropiedads}', ['as' => 'admin.estadoPropiedads.show', 'uses' => 'Admin\EstadoPropiedadController@show']);
Route::get('admin/estadoPropiedads/{estadoPropiedads}/edit', ['as' => 'admin.estadoPropiedads.edit', 'uses' => 'Admin\EstadoPropiedadController@edit']);


Route::get('admin/tipoPropiedads', ['as' => 'admin.tipoPropiedads.index', 'uses' => 'Admin\TipoPropiedadController@index']);
Route::post('admin/tipoPropiedads', ['as' => 'admin.tipoPropiedads.store', 'uses' => 'Admin\TipoPropiedadController@store']);
Route::get('admin/tipoPropiedads/create', ['as' => 'admin.tipoPropiedads.create', 'uses' => 'Admin\TipoPropiedadController@create']);
Route::put('admin/tipoPropiedads/{tipoPropiedads}', ['as' => 'admin.tipoPropiedads.update', 'uses' => 'Admin\TipoPropiedadController@update']);
Route::patch('admin/tipoPropiedads/{tipoPropiedads}', ['as' => 'admin.tipoPropiedads.update', 'uses' => 'Admin\TipoPropiedadController@update']);
Route::delete('admin/tipoPropiedads/{tipoPropiedads}', ['as' => 'admin.tipoPropiedads.destroy', 'uses' => 'Admin\TipoPropiedadController@destroy']);
Route::get('admin/tipoPropiedads/{tipoPropiedads}', ['as' => 'admin.tipoPropiedads.show', 'uses' => 'Admin\TipoPropiedadController@show']);
Route::get('admin/tipoPropiedads/{tipoPropiedads}/edit', ['as' => 'admin.tipoPropiedads.edit', 'uses' => 'Admin\TipoPropiedadController@edit']);


Route::get('admin/tipoOperacions', ['as' => 'admin.tipoOperacions.index', 'uses' => 'Admin\TipoOperacionController@index']);
Route::post('admin/tipoOperacions', ['as' => 'admin.tipoOperacions.store', 'uses' => 'Admin\TipoOperacionController@store']);
Route::get('admin/tipoOperacions/create', ['as' => 'admin.tipoOperacions.create', 'uses' => 'Admin\TipoOperacionController@create']);
Route::put('admin/tipoOperacions/{tipoOperacions}', ['as' => 'admin.tipoOperacions.update', 'uses' => 'Admin\TipoOperacionController@update']);
Route::patch('admin/tipoOperacions/{tipoOperacions}', ['as' => 'admin.tipoOperacions.update', 'uses' => 'Admin\TipoOperacionController@update']);
Route::delete('admin/tipoOperacions/{tipoOperacions}', ['as' => 'admin.tipoOperacions.destroy', 'uses' => 'Admin\TipoOperacionController@destroy']);
Route::get('admin/tipoOperacions/{tipoOperacions}', ['as' => 'admin.tipoOperacions.show', 'uses' => 'Admin\TipoOperacionController@show']);
Route::get('admin/tipoOperacions/{tipoOperacions}/edit', ['as' => 'admin.tipoOperacions.edit', 'uses' => 'Admin\TipoOperacionController@edit']);


Route::get('admin/tipoMedia', ['as' => 'admin.tipoMedia.index', 'uses' => 'Admin\TipoMediaController@index']);
Route::post('admin/tipoMedia', ['as' => 'admin.tipoMedia.store', 'uses' => 'Admin\TipoMediaController@store']);
Route::get('admin/tipoMedia/create', ['as' => 'admin.tipoMedia.create', 'uses' => 'Admin\TipoMediaController@create']);
Route::put('admin/tipoMedia/{tipoMedia}', ['as' => 'admin.tipoMedia.update', 'uses' => 'Admin\TipoMediaController@update']);
Route::patch('admin/tipoMedia/{tipoMedia}', ['as' => 'admin.tipoMedia.update', 'uses' => 'Admin\TipoMediaController@update']);
Route::delete('admin/tipoMedia/{tipoMedia}', ['as' => 'admin.tipoMedia.destroy', 'uses' => 'Admin\TipoMediaController@destroy']);
Route::get('admin/tipoMedia/{tipoMedia}', ['as' => 'admin.tipoMedia.show', 'uses' => 'Admin\TipoMediaController@show']);
Route::get('admin/tipoMedia/{tipoMedia}/edit', ['as' => 'admin.tipoMedia.edit', 'uses' => 'Admin\TipoMediaController@edit']);


Route::get('admin/media', ['as' => 'admin.media.index', 'uses' => 'Admin\MediaController@index']);
Route::post('admin/media', ['as' => 'admin.media.store', 'uses' => 'Admin\MediaController@store']);
Route::get('admin/media/create', ['as' => 'admin.media.create', 'uses' => 'Admin\MediaController@create']);
Route::put('admin/media/{media}', ['as' => 'admin.media.update', 'uses' => 'Admin\MediaController@update']);
Route::patch('admin/media/{media}', ['as' => 'admin.media.update', 'uses' => 'Admin\MediaController@update']);
Route::delete('admin/media/{media}', ['as' => 'admin.media.destroy', 'uses' => 'Admin\MediaController@destroy']);
Route::get('admin/media/{media}', ['as' => 'admin.media.show', 'uses' => 'Admin\MediaController@show']);
Route::get('admin/media/{media}/edit', ['as' => 'admin.media.edit', 'uses' => 'Admin\MediaController@edit']);


Route::get('admin/propiedads', ['as' => 'admin.propiedads.index', 'uses' => 'Admin\PropiedadController@index', 'middleware' => ['auth']]);
Route::post('admin/propiedads', ['as' => 'admin.propiedads.store', 'uses' => 'Admin\PropiedadController@store', 'middleware' => ['auth']]);
Route::get('admin/propiedads/create', ['as' => 'admin.propiedads.create', 'uses' => 'Admin\PropiedadController@create', 'middleware' => ['auth']]);
Route::put('admin/propiedads/{propiedads}', ['as' => 'admin.propiedads.update', 'uses' => 'Admin\PropiedadController@update', 'middleware' => ['auth']]);
Route::patch('admin/propiedads/{propiedads}', ['as' => 'admin.propiedads.update', 'uses' => 'Admin\PropiedadController@update', 'middleware' => ['auth']]);
Route::delete('admin/propiedads/{propiedads}', ['as' => 'admin.propiedads.destroy', 'uses' => 'Admin\PropiedadController@destroy', 'middleware' => ['auth']]);
Route::get('admin/propiedads/{propiedads}', ['as' => 'admin.propiedads.show', 'uses' => 'Admin\PropiedadController@show', 'middleware' => ['auth']]);
Route::get('admin/propiedads/{propiedads}/edit', ['as' => 'admin.propiedads.edit', 'uses' => 'Admin\PropiedadController@edit', 'middleware' => ['auth']]);
