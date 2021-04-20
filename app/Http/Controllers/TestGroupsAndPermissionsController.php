<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\MEmployeeGroup;
use App\Models\EmployeeUserPermissions;

class TestGroupsAndPermissionsController extends Controller
{
    public function testCreateAGroup($groupArg){
        try{
            $group = MEmployeeGroup::create(['name' => $groupArg]);
            return response(['group_created' => $group],200);
        } catch(\Spatie\Permission\Exceptions\RoleAlreadyExists $e){
            return response()->json([
                'status'  => 400,
                'message' => 'Group has been created.',
            ]);
        }
    }

    public function testCreateAPermission($permissionArg){
        try{
            $permission = EmployeeUserPermissions::create(['name' => $permissionArg]);
            return response(['permission_created' => $permission],200);
        } catch(\Spatie\Permission\Exceptions\PermissionAlreadyExists $e){
            return response()->json([
                'status'  => 400,
                'message' => 'Permission has been created.',
            ]);
        }
    }

    public function testAssignPermissionToGroup(){
        $role = MEmployeeGroup::find(7);
        $permissionsOfRole = $role->permissions;
        // $permission = EmployeeUserPermissions::find(14);
        // $role->givePermissionTo($permission);
        // return response(['is_succes' => true],200);
        return response(['role' => $role],200);
    }

    public function getAllPermissions(){
        $permissions = EmployeeUserPermissions::all();
        return response(['permissions' => $permissions],200);
    }

    public function testAssignGroupToUser(){
        $user = Auth::user();
        // $role = Role::find(1);
        // $role = MEmployeeGroup::find(1);

        

        // $user->assignRole($role);
        // Tes Remove Role
        // $user->removeRole($role);
        return response(['user_roles' => $user],200);
        // return response(['role' => $role],200);
    }

    public function testDapatkanGroupUserDenganForEach(){
        $user = Auth::user();
        
        $groups = $user->roles;
        $groupUserId = 0;
        foreach($groups as $group){
            if($group->permissions
            ->where('name','view work order')->first() != null){
                $groupUserId = $group->id;
            }
        }

        $groupUser = MEmployeeGroup::find($groupUserId);
        $formsOfSpv = $groupUser->workOrderFormsOfSpv()->get();

        // return response(['user_roles' => $groupUser],200);
        return response(['spv_forms' => $formsOfSpv],200);
        
    }

    public function isUserHasGroup(){
        $user = Auth::user();
        $result = $user->hasAnyRole(Role::all());
        // $result = $user->hasAnyRole('Work Order - Issuer');
        
        // $result = $user->getPermissionsViaRoles();
        // $permissions = $user->getAllPermissions();
        // $result = $user->group;
        return response(['result' => $result],200);
    }
}
