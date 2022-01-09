<?php

namespace App\Traits;

use App\Models\User;

trait GetUserAuth
{
    public function getUserAuth()
    {
       //return auth()->user();

       return User::first();
    }
}