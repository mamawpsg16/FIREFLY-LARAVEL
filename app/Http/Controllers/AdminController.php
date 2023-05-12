<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\PermissionRole;
// use App\Http\Controllers\ModuleController as ModuleConfig;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::select('id','email')->get();
        // $users = User::select('id','email')->get()->toArray();
        // $roles = Role::select('id','name')->get()->toArray();
        // $permissions = Permission::select('id','name')->get()->toArray();
        return view('admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::select('id','email')->get()->toArray();
        $roles = Role::select('id','name')->get()->toArray();
        $permissions = Permission::select('id','name')->get()->toArray();
        $modules = Module::select('id','name')->get()->toArray();
        // $module_config = new ModuleConfig;
        // $modules = $module_config->modules();
        // dd($modules);
        return view('admin.create',compact('users','roles','permissions','modules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $keys = array_keys($request->all());
        $module_ids = Module::whereIn('name',$keys)->pluck('id')->toArray();
        $user = User::find($request->input('select_user'));
        $user->roles()->sync($request->input('select_role'));
        PermissionRole::where('role_id',$request->input('select_role'))->delete();
        foreach($module_ids as $module_id){
            $module = Module::where('id',$module_id)->pluck('name')->first();
            $permissionRole = new PermissionRole();
            $permissionRole->role_id = $request->input('select_role');
            $permissionRole->module_id = $module_id;
            $permissionRole->permissions = implode(',', $request->input($module));
            $permissionRole->save();
        }
        return redirect()->route('admin.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
