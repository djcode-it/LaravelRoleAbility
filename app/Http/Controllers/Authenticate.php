<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Controller
{
    /**
     * @param Request $request
     */
    public function login(Request $request): void
    {
        Auth::login(\App\Models\User::findOrFail($request->id));
    }

    /**
     * @param Request $request
     */
    public function logout(Request $request): void
    {
        Auth::logout();
    }
}
