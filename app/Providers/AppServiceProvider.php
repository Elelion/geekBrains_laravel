<?php

namespace App\Providers;

use App\Contracts\Parser;
use App\Contracts\Social;
use App\Services\ParserService;
use App\Services\SocialService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * регистрирует наши зависимости
     * ниже мы регистрируем наш класс
     *
     * сначала вызывается интерфейс (те что биндим),
     * вторым параметром указывается наш сервис (то НА что биндим)
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Parser::class, ParserService::class);
        $this->app->bind(Social::class, SocialService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * вызывает все что мы туда запишем после того как загрузятся все зависимости
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
