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
        $this->call([
            // LocationSeeder::class,
            // DepartmentSeeder::class,
            EmployeesSeeder::class,
            // GroupSeeder::class,
            // PermissionSeeder::class,
            // PrivilegeSeeder::class,
            // UserGroupSeeder::class,
            // WorkOrderSeeder::class
        ]);
    }
}
