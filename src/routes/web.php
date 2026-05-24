<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TodoController;
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
Route::middleware('auth')->group(function () {
    Route::get('/', [TodoController::class, 'index']);          // TODO一覧
    Route::post('/todos', [TodoController::class, 'store']);    // TODO作成
    Route::patch('/todos/{todo}', [TodoController::class, 'update']);   // TODO更新
    Route::delete('/todos/{todo}', [TodoController::class, 'destroy']); // TODO削除
    Route::get('/todos/search', [TodoController::class, 'search']);     // TODO検索

    Route::get('/categories', [CategoryController::class, 'index']);           // カテゴリ一覧
    Route::post('/categories', [CategoryController::class, 'store']);          // カテゴリ作成
    Route::patch('/categories/{category}', [CategoryController::class, 'update']); // カテゴリ更新
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']); // カテゴリ削除

    Route::post('/todos/{todo}/like', [TodoController::class, 'like']);   // いいね
    Route::delete('/todos/{todo}/like', [TodoController::class, 'unlike']); // いいね解除
});
