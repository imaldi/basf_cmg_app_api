<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $attMaster = factory('App\Models\FormAttendanceMaster',20)->create();
        // $this->call([
        //     // LocationSeeder::class,
        //     // DepartmentSeeder::class,
        //     EmployeesSeeder::class,
        //     // GroupSeeder::class,
        //     // PermissionSeeder::class,
        //     // PrivilegeSeeder::class,
        //     // UserGroupSeeder::class,
        //     // Form5sMasterSeeder::class,
        //     // WorkOrderSeeder::class
        // ]);
    }
}
