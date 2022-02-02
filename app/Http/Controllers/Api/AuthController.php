<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\AuthRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
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

    public function forgot(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
                  ? response()->json(['status' => __($status)])
                  : response()->json(['status' => __($status)], 422);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:6|max:15'
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );
 
        return $status === Password::RESET_LINK_SENT
                  ? response()->json(['status' => __($status)])
                  : response()->json(['status' => __($status)], 422);
    }
}
