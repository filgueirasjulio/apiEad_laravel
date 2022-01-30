<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\AuthRequest;
use App\Http\Resources\UserResource;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function auth(AuthRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Usuário ou senha incorretos.'],
            ]);
        }
  
        $user->tokens()->delete(); //se estiver authenticado em outro dispositivo, será deslogado.
  
        $token = $user->createToken($request->device_name)->plainTextToken;
    
        return response()->json([
            'token' => $token
        ]);
    }

    public function logout()
    {
       auth()->user()->tokens()->delete();

       return response()->json(['logout realizado com sucesso!']);
    }

    public function me()
    {
        $user = auth()->user();

        return new UserResource($user);
    }
}
