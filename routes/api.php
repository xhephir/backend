<?php

use App\Http\Controllers\BookController;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|

Para crear varios archivos con artisan (carpeta backend) -m Migración f Factory --api Genera controlador con métodos
php artisan make:model Book -mf --api
*/

Route::apiResource('books', BookController::class);