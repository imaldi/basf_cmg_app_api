<?php

namespace App\Http\Middleware;

use Closure;
use Auth;


///Sepertinya tidak terpakai dikarenakan spatie
class PermissionCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        $user = Auth::user();
        $permissionExplode = explode('-',$permission);
        $permissionFinal = implode(' ', $permissionExplode);

        $permissionViaRoles = Auth::user()->hasPermission($permissionFinal);
        // $permissionViaRoles = Auth::user()->hasPermission($permission);

        if($permissionViaRoles){
            return $next($request);
        }

        return redirect('failMiddleware/'.$permission);
        // return response(['fail_reason' => 'fail bitch'],200);
        // return redirect()->action([AuthController::class, 'failMiddleware']);


}
}
