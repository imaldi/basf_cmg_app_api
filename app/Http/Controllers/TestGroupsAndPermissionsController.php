<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\MEmployeeGroup;
use App\Models\EmployeeUserPermissions;
use App\Http\Resources\EmployeeResource;
use App\User;
use App\Http\Resources\EmployeeGroupResource;

class TestGroupsAndPermissionsController extends Controller
{
    public function testCreateAGroup($groupArg)
    {
        try {
            $group = MEmployeeGroup::create(['name' => $groupArg]);
            return response(['group_created' => $group], 200);
        } catch (\Spatie\Permission\Exceptions\RoleAlreadyExists $e) {
            return response()->json([
                'status'  => 400,
                'message' => 'Group has been created.',
            ]);
        }
    }

    public function testCreateAPermission($permissionArg)
    {
        try {
            $permissionExplode = explode('%20', $permissionArg);
            $permissionFinal = implode(' ', $permissionExplode);
            $permission = EmployeeUserPermissions::create(['name' => $permissionFinal]);
            return response(['permission_created' => $permission], 200);
        } catch (\Spatie\Permission\Exceptions\PermissionAlreadyExists $e) {
            return response()->json([
                'status'  => 400,
                'message' => 'Permission has been created.',
            ]);
        }
    }

    public function assignPermissionToUser(Request $request)
    {
        // try{
        $user_id = $request->input("user_id");
        $user = User::find($user_id);
        $permission_id = $request->input("permission_id");
        if($permission_id != null){
            $permission_to_give = EmployeeUserPermissions::find($permission_id);
            // $user->givePermissionTo($permission_to_give->name);
            // ini kalau mau hapus biar ga ribet buat baru
            $user->revokePermissionTo($permission_to_give->name);
            
        }


        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' =>  EmployeeResource::collection([$user])
        ], 200);
        // } catch (\Spatie\Permission\Exceptions\PermissionAlreadyExists $e) {

        // }

    }

    public function testAssignPermissionToGroup(Request $request)
    {
        $role = MEmployeeGroup::find($request->input('role_id'));

        // $user = User::find($user_id);
        $permission_id = $request->input("permission_id");
        if($permission_id != null){
            $permission_to_give = EmployeeUserPermissions::find($permission_id);
            // $role->givePermissionTo($permission_to_give->name);
            // ini kalau mau komen biar ga ribet buat baru
            $role->revokePermissionTo($permission_to_give->name);
            
        }


        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'role' =>  EmployeeGroupResource::collection([$role]),
            'permissions_of_role' => $role->permissions
        ], 200);
        // $permissionsOfRole = $role->permissions;
        // for ($x = 1; $x <= 63; $x++) {
        //     if (
        //         // $x != 21 ||
        //         // $x != 25 ||
        //         // $x != 30 ||
        //         // $x != 36 ||
        //         // $x != 37 ||
        //         // $x != 38 ||
        //         // $x != 39 ||
        //         // $x != 44 ||
        //         // $x != 45 ||
        //         // $x != 46 ||
        //         // $x != 47 ||
        //         // $x != 56 ||
        //         // $x != 57 ||
        //         // $x != 58 ||
        //         // $x != 59
        //         $x == 5 &&
        //         $x == 6 &&
        //         $x == 7 &&
        //         $x == 8
        //     ) {
        //         $permission = EmployeeUserPermissions::find($x);
        //         $role->givePermissionTo($permission);
        //     }
        // }

        // // return response(['is_succes' => true],200);
        // return response(['role' => $role], 200);
    }

    public function getAllPermissions()
    {
        $permissions = EmployeeUserPermissions::all();
        return response(['permissions' => $permissions], 200);
    }

    public function testAssignGroupToUser(Request $request)
    {

        $userId = $request->input('user_id');
        $groupId = $request->input('group_id');
        $user = User::find($userId);
        // $user = User::all()->where('id',)->first();
        $role = MEmployeeGroup::find($groupId);



        $user->assignRole($role);
        // Tes Remove Role
        // $user->removeRole($role);
        return response(['user_roles' => $user->roles], 200);
        // return response(['users' => $user],200);
        // return $user;
        // return response(['role' => $role],200);
    }

    public function tesRemovenGroupFromUser(Request $request)
    {

        $userId = $request->input('user_id');
        $groupId = $request->input('group_id');
        $user = User::find($userId);
        // $user = User::all()->where('id',)->first();
        $role = MEmployeeGroup::find($groupId);



        // $user->assignRole($role);
        // Tes Remove Role
        $user->removeRole($role);
        return response(['user_roles' => $user->roles], 200);
        // return response(['users' => $user],200);
        // return $user;
        // return response(['role' => $role],200);
    }

    public function testDapatkanGroupUserDenganForEach()
    {
        $user = Auth::user();

        $groups = $user->roles;
        foreach ($groups as $group) {
            if (
                $group->permissions
                ->where('name', 'view work order')->first() != null
            ) {
                $groupUserId = $group->id;
                $groupUser = MEmployeeGroup::find($groupUserId);
                $formsOfSpv = $groupUser->workOrderFormsOfSpv()->get();
                return response(['spv_forms' => $formsOfSpv], 200);
            }
        }



        // return response(['user_roles' => $groupUser],200);


    }

    public function isUserHasGroup()
    {
        $user = Auth::user();
        // $result = $user->hasAnyRole(Role::all());
        // $result = $user->hasAnyRole('Work Order - Issuer');

        // $result = $user->getPermissionsViaRoles();
        $result = $user->hasPermission('view work order');

        // $permissions = $user->getAllPermissions();
        // $result = $user->group;
        return response(['permissions' => $result], 200);
    }
}
