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
    return view('login');
});

Route::controller(App\Http\Controllers\OAuthController::class)
    ->prefix('/auth')
    ->name('oauth.')
    ->group(function () {
        Route::get('/redirect', 'redirect')->name('login');

        Route::get('/callback', 'callback')->name('callback');
    });

Route::get('/protected', function () {
    echo 'this page should be protected by login' ;
    echo '<br><pre>' ;
    print_r(Auth::user()) ;
    echo '</pre>' ;
    echo '<a href="/logout">Logout</a>';
})->middleware('keycloak-web');

