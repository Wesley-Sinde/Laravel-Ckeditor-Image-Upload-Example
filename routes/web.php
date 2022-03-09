<?php

use App\Http\Controllers\CkeditorController;

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


Route::get('ckeditor', [CkeditorController::class, 'index']);

Route::post('ckeditor/image_upload', [CkeditorController::class, 'upload'])->name('upload');