<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;

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
    Route::get('/', IndexController::class)->name('index');
    Route::resource('categories',AdminCategoryController::class);
    Route::resource('news',AdminNewsController::class);
});

Route::group(['prefix' => 'news'], function () {
    Route::get('info', [NewsController::class, 'info'])->name('info');
    Route::get('news', [NewsController::class, 'news'])->name('news');

    /**
     * {news} - аналогично {id} тк laravel сам подставит id из модели news
     */
    Route::get('/show/{news?}', [NewsController::class, 'show'])
        ->where('news', '\d+')
        ->name('news.show');
});

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('feedback', [UserController::class, 'feedback'])->name('feedback');
    Route::post('check', [UserController::class, 'check'])->name('check');
});

Route::get('collection', function () {
    $collect = collect([
        ['name' => 'Anna', 'age' => 20, 'work' => 'IT'],
        ['name' => 'Mike', 'age' => 28, 'work' => 'IT'],
        ['name' => 'Kate', 'age' => 25, 'work' => 'Education'],
        ['name' => 'Karl', 'age' => 20, 'work' => 'Marketing'],
        ['name' => 'Liza', 'age' => 32, 'work' => 'Ads'],
    ]);

    /**
     * map - пройти по коллекции и что то сделать
     * $collect->map(fn($people) => $people['work'])
     *
     * max/min - получить мин или мах значения выбранного поля
     * average - среднее значение
     * $collect->max('age')
     *
     * sortBy - сортировка
     * $collect->sortBy('age')
     */
    dd($collect->sortBy('age'));
});
