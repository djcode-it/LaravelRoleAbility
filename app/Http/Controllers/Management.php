<?php

namespace App\Http\Controllers;

use App\Models\Ability;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class Management extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function CreateUser(Request $request): User
    {
        abort_if(!$request->name || !$request->email || !$request->password, 403);

        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
    }

    /**
     * @param Request $request
     * @return Role
     */
    public function CreateRole(Request $request): Role
    {
        abort_if(!$request->sku || Role::where('sku', $request->sku)->first(), 403);

        return Role::create([
            'name' => ucwords(str_replace('-', ' ', $request->sku)),
            'sku' => $request->sku,
        ]);
    }

    /**
     * @param Request $request
     * @return Ability
     */
    public function CreateAbility(Request $request): Ability
    {
        abort_if(!$request->sku || Ability::where('sku', $request->sku)->first(), 403);

        return Ability::create([
            'name' => ucwords(str_replace('-', ' ', $request->sku)),
            'sku' => $request->sku,
        ]);
    }
}
