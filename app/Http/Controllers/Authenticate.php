<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Controller
{
    /**
     * @param Request $request
     * @return User
     */
    public function Login(Request $request): User
    {
        $user = \App\Models\User::findOrFail($request->id);

        $ability = 'update-post';

        $check = false;
        foreach ($user->roles as $role) {
            if ($role->abilities->contains('sku', $ability)) {
                $check = true;
                break;
            }
        }

        dd($check);

        Auth::login($user);
        return $user;
    }

    /**
     * @param Request $request
     */
    public function Logout(Request $request): void
    {
        Auth::logout();
    }
}
