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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'Home@index');
Route::get('/registrasi', 'Registrasi@index');
Route::post('/simpanRegis', 'Registrasi@registrasi');
Route::get('/masukSuplier', 'Suplier@index');
Route::post('/masukSuplier', 'Suplier@masukSuplier');
Route::get('/suplierKeluar', 'Suplier@suplierKeluar');
Route::get('/masukAdmin', 'Admin@index');
Route::get('/adminGenerate', 'Admin@adminGenerate');
Route::post('/masukAdmin', 'Admin@masukAdmin');
