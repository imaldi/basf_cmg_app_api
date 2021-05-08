<?php

namespace App\Http\Middleware;

use Closure;
use Auth;


class GroupCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$groups)
    // public function handle($request, Closure $next, $group)
    {
        $user = Auth::user();
        

        if(!$user->hasRole('Super Admin')) {
            
            foreach($groups as $group) {
                $groupExplode = explode('_',$group);
                $groupFinal = implode(' ', $groupExplode);
                // Check if user has the role This check will depend on how your roles are set up
                if($user->hasRole($groupFinal)){
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
        // return redirect('/profile');
        return redirect('failMiddleware/group');
        // return response(['fail_reason' => 'fail bitch'],200);


        // return redirect()->action([AuthController::class, 'failMiddleware']);
    }
}
