<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Str;

trait BasicTrait
{
    public function getUserAuth()
    {
       //return auth()->user();

       return User::first();
    }
    
    public static function booted()
    {
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (String) Str::uuid();
        });
    }
}