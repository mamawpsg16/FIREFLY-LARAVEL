<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withPivot('permissions');
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

    public function permissionRoles()
    {
        return $this->hasMany(PermissionRole::class);
    }
}
