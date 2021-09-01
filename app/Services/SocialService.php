<?php


namespace App\Services;

use App\Contracts\Social;
use Laravel\Socialite\Contracts\User;
use App\Models\User as Model;
use Illuminate\Support\Facades\Auth;

class SocialService implements Social
{
    public function saveUser(User $user): string
    {
        $currentUser = Model::where('email', $user->getEmail()->first());

        if ($currentUser) {
            $currentUser->name = $user->getName();
            $currentUser->avatar = $user->getAvatar();
            $currentUser->save();

            /** авторизуем, если такой пользователь есть */
            Auth::loginUsingId($currentUser->id);

            return route('account');
        } else {
            // register now
        }

        throw new \Exception('Пользователь НЕ найден');
    }
}