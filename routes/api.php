<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\form;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [AuthController::class, 'login']);
Route::post('/form', [form::class, 'store']);
Route::get('/oficinas', [form::class, 'oficinas'])->middleware('auth:api');
Route::post('/store-files', [form::class, 'storeFiles']);