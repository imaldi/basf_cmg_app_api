<?php

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_departments')->insert([
            [
                'dept_name' => 'All department',
                'dept_is_active' => 1,
            ],[
                'dept_name' => 'Technical Service',
                'dept_is_active' => 1,
            ],[
                'dept_name' => 'Production',
                'dept_is_active' => 1,
            ],[
                'dept_name' => 'QA/QC',
                'dept_is_active' => 1,
            ],[
                'dept_name' => 'Warehouse',
                'dept_is_active' => 1,
            ],[
                'dept_name' => 'Engineering',
                'dept_is_active' => 1,
            ],[
                'dept_name' => 'HR',
                'dept_is_active' => 1,
            ],[
                'dept_name' => 'EHS',
                'dept_is_active' => 1,
            ],[
                'dept_name' => 'SCM',
                'dept_is_active' => 1,
            ],
        ]);
    }
}
