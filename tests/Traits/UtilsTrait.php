<?php

namespace Tests\Traits;

use App\Models\User;

Trait UtilsTrait {

    public function generateToken()
    {
        $user = User::factory()->create();
        $token =  $user->createToken('teste')->plainTextToken;

        return $token;
    }

    public function defaultHeaders()
    {
        $token = $this->generateToken();

        return  [
            'Authorization' => "Bearer {$token}",
        ];
    }
}