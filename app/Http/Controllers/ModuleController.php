<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\PermissionRole;

class ModuleController extends Controller{
    public function index(){
        $auth_roles = auth()->user()->roles()->pluck('id');
        $modules_and_permissions = PermissionRole::select('module_id','permissions')->where('role_id', $auth_roles)->get()->toArray();
        $modules = Module::orderByDesc('id')->get()->toArray();

        return view('components.navbar.navbar',compact('modules','modules_and_permissions'));
    }
}
