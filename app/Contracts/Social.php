<?php


namespace App\Contracts;


use Laravel\Socialite\Contracts\User;


interface Social
{
    public function saveUser(User $user): string;
}