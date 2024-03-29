<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;

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
Route::resource('de',DemoController::class);

Route::get("/search",[DemoController::class ,"search"])->name("search");

Route::get('/',[DemoController::class,'index'])->name('root');

Route::get('/{shortCode}', [DemoController::class, 'redirectToURL'])->name("short_url_redirect");



