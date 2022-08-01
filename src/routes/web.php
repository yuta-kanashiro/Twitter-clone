<?php

use Illuminate\Support\Facades\Route;
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

// ホーム画面表示（ツイート一覧画面）
Route::get('/', function () {
    return view('home');
});

Auth::routes();

// 後ほど使う可能性があるので残しています
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
