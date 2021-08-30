<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Parser;
use App\Http\Controllers\Controller;
use App\Services\ParserService;
use Illuminate\Http\Request;

/**
 *  php artisan make:controller Admin/ParserController -i
 *
 * создаем контроллер для парсера
 *
 * далее мы создаем сервис в корне /app/Services
 */
class ParserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Parser $parser)
    {
        /** задаем url который мы будем парсить */
        $url = 'https://news.yandex.ru/music.rss';

        /**
         * благодаря тому что мы зарегистрировали наш класс ParserService
         * мы темерь можем НЕ писать так
         *
         * $objService = new ParserService();
         * dd($objService->getDate($url))
         *
         * а просто определить параметр в __invoke и вызвать метод без
         * объявления данных
         */

        dd($parser->getDate($url));
    }
}
