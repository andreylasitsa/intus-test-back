<?php

use App\Http\Controllers\LinkController;
use App\Http\Middleware\CorsMiddleware;
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


Route::middleware(CorsMiddleware::class)->group(function() {
    Route::post('/link', [LinkController::class, 'hash']);
    Route::get('/link', [LinkController::class, 'index']);
});


Route::get('/{hash}', [LinkController::class, 'redirect']);

