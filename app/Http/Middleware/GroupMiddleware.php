<?php

namespace App\Http\Middleware;

use Closure;
use Auth;


class GroupMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$groups)
    {
        $user = Auth::user();

        if($user->emp_employee_group_id != 1) {
            
            foreach($groups as $group) {
                // Check if user has the role This check will depend on how your roles are set up
                if($user->emp_employee_group_id == $group){
                    // dd(count($groups));
                    // return redirect('api/work-order/get-all/'.$request->route('groupId'));
                    return $next($request);
                }
            }    
        } 
        // else {
        //     if($user->emp_employee_group_id == 2) {
        //         return $next($request);
        //     } else if($user->emp_employee_group_id == 3) {
        //         return $next($request);
        //     } else  {
        //         return redirect('/');
        //     }
            
        // }

        // return redirect('login');
        return redirect('failMiddleware/group');
    }
}
