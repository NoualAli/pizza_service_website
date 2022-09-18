<?php

namespace App\Http\Controllers\Auth\Library\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

trait LoginGoogle
{

    public function loginGoogle(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle(Request $request)
    {
        try {
            $user = Socialite::driver('google')->user();
            $saveUser = User::firstOrCreate([
                'email' => $user->getEmail(),
            ], [
                'email' => $user->getEmail(),
                'username' => $user->getName(),
                'password' => Hash::make($user->getName() . '@' . $user->getId())
            ]);
            if (!$saveUser->roles->count()) {
                $saveUser->assignRole('user');
            }
            Auth::loginUsingId($saveUser->id);
            return redirect()->route('backpack.account.info');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}