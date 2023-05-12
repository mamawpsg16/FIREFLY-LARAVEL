<?php

namespace App\Models;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function permissionRoles()
    {
        return $this->hasMany(PermissionRole::class);
    }
}
