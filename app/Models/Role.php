<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

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

    static public function getRole()
    {
        $data = Role::orderBy('name', 'asc');
        return $data;
    }

    static public function getTableAkses($id)
    {
        $result = Role::select('menus.name as menu', 'roles.name as role', 'accesses.*', 'accesses.id as id_akses')
            ->leftJoin('accesses', 'roles.id', '=', 'accesses.roles_id')
            ->leftJoin('menus', 'menus.id', '=', 'accesses.menus_id')
            ->where('roles_id', $id)
            ->get();

        return $result;
    }
}
