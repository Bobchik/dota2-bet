<?php
if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('layouts.welcome');
    })->middleware('guest');

    Auth::routes();
        
    Route::group(['middleware' => ['auth']], function () {
        //RoomController
        Route::get('/rooms', 'RoomController@index');
        Route::get('/rooms/list/{rank}', 'RoomController@all');
        Route::get('/new_room', 'RoomController@create');
        Route::post('/new_room/set', 'RoomController@set');

        Route::get('/profile', 'UserController@index')->name('profile');
        Route::get('/profile/games', 'UserController@games')->name('games');
        Route::get('/profile/{id}', 'UserController@get')->name('profile.get');
        Route::post('/profile/{id}/report', 'UserController@report')->name('profile.report');
        Route::post('/profile/update', 'UserController@rate')->name('profile.update');

        Route::get('auth/steam', 'SteamAuthController@redirectToSteam')->name('auth.steam');
        Route::get('auth/steam/handle', 'SteamAuthController@handle')->name('auth.steam.handle');

        Route::get('logout', 'Auth\LoginController@logout')->name('logout');

        Route::get('/checkout/stripe', 'CheckoutController@getStripe');
        Route::post('/checkout/stripe', 'CheckoutController@postStripe');
        Route::get('/checkout/g2a', 'CheckoutController@getG2A');
        Route::post('/checkout/g2a', 'CheckoutController@postG2A');
        Route::get('/checkout/webmoney', 'CheckoutController@getWebMoney');
        Route::get('/checkout/withdraw', function (){
           return view('checkout.withdraw');
        });
        Route::post('/checkout/withdraw', 'CheckoutController@withdraw');

        Route::get('/stats', 'StatsController@index');
    Route::group(['middleware' => ['bet']], function () {
        Route::get('/rooms/lobby/exit', 'LobbyController@leave');
        Route::get('/rooms/lobby/{game_id}', 'LobbyController@index');
        Route::get('/rooms/lobby/{game_id}/get', 'LobbyController@getIds');
        Route::get('/rooms/lobby/{game_id}/all', 'LobbyController@all');
    });
        Route::get('/rooms/lobby/{game_id}/place/{place_id}', 'LobbyController@set');
        Route::get('/rooms/lobby/{game_id}/place/{place_id}/set', 'LobbyController@setId');
        Route::post('/rooms/lobby/{game_id}/bet/{bet}', 'LobbyController@bet');
        Route::get('/rooms/lobby/{game_id}/start', 'LobbyController@start');
        Route::get('rooms/lobby/{game_id}/results', 'LobbyController@res');
    Route::group(['middleware' => ['lobby']], function () { 
    });
    });
});


