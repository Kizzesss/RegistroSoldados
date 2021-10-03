<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoldadoController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

/*Route::get('/soldado', function () {
    return view('index');
});
Route::get('/soldado', [SoldadoController::class, 'create']);
*/

Route::resource('soldado', SoldadoController::class)->middleware('auth');
Auth::routes(['register'=>false, 'reset'=>false]);

Route::get('/home', [SoldadoController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'], function(){
    Route::get('/', [SoldadoController::class, 'index'])->name('home');
});