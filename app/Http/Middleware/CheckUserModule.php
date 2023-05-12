<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Models\PermissionRole;

class CheckUserModule
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $user  = auth()->user();
        // echo '<pre>';
        // print_r($user);
        // echo '<pre>';
        // die('btich');
        if($user->roles){

            // $roles = $user->roles()->pluck('id');
            // $modules = Module::orderByDesc('id')->get()->toArray();
            // // request()->routeIs('roles.*')
            // $auth_user_modules = PermissionRole::whereIn('role_id', $roles)->pluck('module_id')->toArray();
            // $auth_module_names = Module::whereIn('id', $auth_user_modules)
            // ->pluck('name')
            // ->toArray();
            // $auth_module_names = array_map('strtolower', $auth_module_names);
            // dd($modules,$auth_module_names,$auth_user_modules,request()->route()->uri);
            

            // foreach($auth_module_names as $module){
            //     if(strpos(request()->route()->uri,$module) === 0){
            //         return $next($request);
            //     }
            // }
            // return abort(403);
        }
        // dd(in_array(request()->route()->uri,$modules),$modules,request()->route());
        // if(in_array(request()->route(),$modules)){
        //     dd('PASOK');
        // }
        // dd($roles,$modules,str_replace('/','',request()->getRequestUri()),request()->route());
        // // if(in_array($roles,array_column($modules,'id')))
      

       
    }
}
