<?php

use App\Http\Controllers\Api\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/terbaru', [MainController::class, 'terbaru']);
Route::get('/popular', [MainController::class, 'popular']);
Route::get('/berwarna/{page}', [MainController::class, 'berwarna']);

Route::get('/genre', [MainController::class, 'genre']);
Route::get('/genre/{genre}/{page}', [MainController::class, 'listgenre']);

Route::get('/theme', [MainController::class, 'theme']);
Route::get('/theme/{theme}/{page}', [MainController::class, 'listtheme']);

Route::get('/jenis', [MainController::class, 'jenis']);
Route::get('/jenis/{jenis}/{page}', [MainController::class, 'listjenis']);

Route::get('/detail/{id}', [MainController::class, 'detail']);

Route::get('/baca/{id}', [MainController::class, 'baca']);

Route::get('/search/{id}', [MainController::class, 'search']);