<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function googleredirect ()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googlecallback()
    {
        $user = Socialite::driver('google')->user();
        if (User::where('email', $user->email)->exists()) {
            $auth_status = Auth::attempt([
                'email' => $user->email,
                'password' => '123456789'
            ]);

            if ($auth_status == 1) {
                return redirect('/');
            }
            else {
                abort('404');
            }
        }
        else {
            User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => bcrypt('123456789')
            ]);

            $auth_status = Auth::attempt([
                'email' => $user->email,
                'password' => '123456789'
            ]);

            if ($auth_status == 1) {
                return redirect('/');
            }
            else {
                abort('404');
            }

        }
    }
}
