<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [];

    static public function getAkses($url)
    {
        $roleId = auth()->user()->roles_id;
        $roles = Role::select('roles.*', 'accesses.*', 'menus.*')
            ->leftJoin('accesses', 'accesses.roles_id', '=', 'roles.id')
            ->leftJoin('menus', 'accesses.menus_id', '=', 'menus.id')
            ->where('accesses.roles_id', $roleId)
            ->where('menus.url', $url)
            ->whereNull('roles.deleted_at')
            ->first();

        return $roles;
    }
}
