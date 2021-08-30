<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Account\IndexController as AccountController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\UsersController as AdminUsers;
use App\Http\Controllers\Admin\ParserController;
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
 * middleware - прослойка между маршрутом и контроллером
 * те что бы попасть на маршрут, лараваель проверит некое условие
 * auth - говорит о том, что будет проверятся авторизация пользователя
 * те если такой залогинин то - ок
 * а если нет - то редирект на логин форму
 *
 * auth - только вторизованные пользователи
 */
Route::group(['middleware' => 'auth'], function () {
    Route::get('/account',  AccountController::class)->name('account');

    /**
     * подключаем наши ресурс контроллеры (см. в .../Controllers/Admin/...)
     *
     * as => admin - дает дополнительный префикс и на выходе будет запись типа
     * admin.news.index итп
     *
     * 'middleware' => 'admin' - подключаем обработчик наш middleware
     * те перед тем как выполниться этот роут - будет исполнена проверка на админа
     * из нашей middleware - admin
     */
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
        Route::get('/', IndexController::class)->name('index');
        Route::get('/parser', ParserController::class)->name('parser');
        Route::resource('categories',AdminCategoryController::class);
        Route::resource('news',AdminNewsController::class);
        Route::resource('users',AdminUsers::class);
    });
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

/** тот user что НЕ в папке admin */
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
    // dd($collect->sortBy('age'));

    /**/

    /** заталкиваем в сессию значение */
    session(['new_session' => 1]);

    /** или так */
    session()->put('key', 'val');

    /** проверяем есть ли сессия */
    if (session()->has('new_session')) {
        // dd(session()->all());
    }

    /** удалить сессию */
    session()->forget(['new_session']);
});


/** для авторизации и регистрации, прописывается автоматом после команды laravel/ui */
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
