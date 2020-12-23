<?php

use Illuminate\Support\Facades\DB;
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

//Route::get('/', function () {
//    $imagesPath = storage_path('public/images/'); // путь к папке с картинками
//    $files = []; // массив файлов
//
//    foreach (glob($imagesPath . "*.{jpg,png,gif}", GLOB_BRACE) as $filename) { // ищет все картинки через glob
//        $files[] = $filename;
//    }
//
//    return view('main', compact('files'));
//});


