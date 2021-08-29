<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

/**
 * php artisan make:listener UserListener
 *
 * это слушатель / наблюдатель
 */
class UserListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        /**
         * instanceof - проверяет что $event->user принадлежит модели User
         *
         * логика:
         * просто обновляем время по полю и созраняем изменение
         */
        if (isset($event->user) && $event->user instanceof User) {
            $event->user->last_time_at = now();
            $event->user->save();
        }
    }
}
