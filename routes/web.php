<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;

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

Route::get('/', [NewsController::class, 'index'])->name('index');

/**
 * подключаем наши ресурс контроллеры (см. в .../Controllers/Admin/...)
 *
 * as => admin - дает дополнительный префикс и на выходе будет запись типа
 * admin.news.index итп
 */
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('categories',AdminCategoryController::class);
    Route::resource('news',AdminNewsController::class);
});

Route::group(['prefix' => 'news'], function () {
    Route::get('info', [NewsController::class, 'info'])->name('info');
    Route::get('news', [NewsController::class, 'news'])->name('news');
    Route::get('/show/{id?}/{type}', [NewsController::class, 'show'])
        ->where('id', '\d+')
        ->name('news.show');
});
