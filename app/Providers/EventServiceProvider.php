<?php

namespace App\Providers;

use App\Events\UserEvent;
use App\Listeners\UserListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use SocialiteProviders\Manager\SocialiteWasCalled;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [

        /**
         * событие корое происходит когда кто то регестрируется
         * laravel сам это отслеживает
         */
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        /**
         * говорим фрейму, что мы хотим наблюдать за UserEvent
         * в то время как UserEvent просто сохраняет в переменную в конструкторе
         * пользователя из user
         *
         * а UserListener - обновляет время в таблице
         *
         * все - связка готова!
         */
        UserEvent::class => [
            UserListener::class,
        ],

        /**
         * добавляем для авторизации через VK
         */
        SocialiteWasCalled::class => [
            // ... other providers
            'SocialiteProviders\\VKontakte\\VKontakteExtendSocialite@handle',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //1.53
    }
}
