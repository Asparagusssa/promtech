<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionService
{
    public function login(Request $request): array
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => "Неверный логин или пароль"
            ]);
        }

        $user = User::where('email', $request->email)->first();

        session()->regenerate();

        return [
            'success' => true,
            'token' => $user->createToken($request->email)->plainTextToken,
        ];
    }

    public function logout(Request $request): void
    {
        $request->user()->tokens()->delete();
    }
}
