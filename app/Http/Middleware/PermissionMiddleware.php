<?php

namespace App\Http\Middleware;

use Closure;
use Auth;


class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$permissions)
    {
        $user = Auth::user();
        // $group = $user->group()->first();
        // $forms = $group->workOrderForms()->get();
        // $userPermission = 
        //     $group->permissions()->get()
        //     ->where('id',$permission)->first();

        // if($user->emp_employee_group_id != 1) {
            
            foreach($permissions as $permission) {
                // $userPermission = 
                //     $group->permissions()->get()
                //     ->where('id',$permission)->first();
                // $isUserHasPermission = Auth::user()->hasPermission($permission);
                $permissionViaRoles = Auth::user()->getAllPermissions();
                
                foreach($permissionViaRoles as $rolePermission){
                    if($rolePermission->name == $permission){
                    return $next($request);

                    }
                }
                // Check if user has the role This check will depend on how your roles are set up
                // if($isUserHasPermission){
                //     // if($userPermission->id == $permission){
                //     // dd(count($groups));
                //     // return redirect('api/work-order/get-all/'.$request->route('groupId'));
                //     return $next($request);
                // }
            }    
        // } 
        // else {
        //     if($user->emp_employee_group_id == 2) {
        //         return $next($request);
        //     } else if($user->emp_employee_group_id == 3) {
        //         return $next($request);
        //     } else  {
        //         return redirect('/');
        //     }
            
        // }

        return redirect('failMiddleware/permission');
        // return $next($request);
    }
}
