<?php

namespace App\Http\Controllers;

use App\Models\Ability;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class Management extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function CreateUser(Request $request): User
    {
        abort_if(
            !$request->name ||
            !$request->email ||
            !$request->password ||
            User::where('email', $request->email)->exists()
            , 403);

        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function GetUsers(Request $request): Collection
    {
        return User::all();
    }

    /**
     * @param Request $request
     * @return Collection
     */
    public function GetRoles(Request $request): Collection
    {
        return Role::all();
    }

    /**
     * @param Request $request
     * @return Collection
     */
    public function GetAbilities(Request $request): Collection
    {
        return Ability::all();
    }

    /**
     * @param Request $request
     * @return array
     */
    public function GetGates(Request $request): array
    {
        return Gate::abilities();
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

    /**
     * https://laravel.com/docs/8.x/eloquent-relationships#updating-many-to-many-relationships
     * @param Request $request
     * @return Collection
     */
    public function SyncRoleAbilities(Request $request): Collection
    {
        abort_if(!$request->sku || !Ability::whereIn('id', explode(',', $request->ids))->exists(), 403);

        $role = Role::where('sku', 'like', "%{$request->sku}%")->firstOrFail();

        $role->abilities()->sync(explode(',', $request->ids));

        return $role->abilities;
    }

    /**
     * https://laravel.com/docs/8.x/eloquent-relationships#updating-many-to-many-relationships
     * @param Request $request
     * @return Collection
     */
    public function AttachRoleAbilities(Request $request): Collection
    {
        abort_if(!$request->sku || !Ability::whereIn('id', explode(',', $request->ids))->exists(), 403);

        $role = Role::where('sku', 'like', "%{$request->sku}%")->firstOrFail();

        $role->abilities()->attach(explode(',', $request->ids));

        return $role->abilities;
    }

    /**
     * https://laravel.com/docs/8.x/eloquent-relationships#updating-many-to-many-relationships
     * @param Request $request
     * @return Collection
     */
    public function DetachRoleAbilities(Request $request): Collection
    {
        abort_if(!$request->sku || !Ability::whereIn('id', explode(',', $request->ids))->exists(), 403);

        $role = Role::where('sku', 'like', "%{$request->sku}%")->firstOrFail();

        $role->abilities()->detach(explode(',', $request->ids));

        return $role->abilities;
    }


    /**
     * https://laravel.com/docs/8.x/eloquent-relationships#updating-many-to-many-relationships
     * @param Request $request
     * @return Collection
     */
    public function SyncUserRole(Request $request): Collection
    {
        abort_if(!$request->name || !Role::whereIn('id', explode(',', $request->ids))->exists(), 403);

        $user = User::where('name', 'like', "%{$request->name}%")->firstOrFail();

        $user->roles()->sync(explode(',', $request->ids));

        return $user->roles;
    }

    /**
     * https://laravel.com/docs/8.x/eloquent-relationships#updating-many-to-many-relationships
     * @param Request $request
     * @return Collection
     */
    public function AttachUserRole(Request $request): Collection
    {
        abort_if(!$request->name || !Role::whereIn('id', explode(',', $request->ids))->exists(), 403);

        $user = User::where('name', 'like', "%{$request->name}%")->firstOrFail();

        $user->roles()->attach(explode(',', $request->ids));

        return $user->roles;
    }

    /**
     * https://laravel.com/docs/8.x/eloquent-relationships#updating-many-to-many-relationships
     * @param Request $request
     * @return Collection
     */
    public function DetachUserRole(Request $request): Collection
    {
        abort_if(!$request->name || !Role::whereIn('id', explode(',', $request->ids))->exists(), 403);

        $user = User::where('name', 'like', "%{$request->name}%")->firstOrFail();

        $user->roles()->detach(explode(',', $request->ids));

        return $user->roles;
    }
}
