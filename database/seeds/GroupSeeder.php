<?php

use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_employee_groups')->insert([
            // [
            //     'name' => 'Super Admin',
            //     'e_group_is_active' => '1',
            // ],
            // [
            //     'name' => 'Admin',
            //     'e_group_is_active' => '1',
            // ],
            // [
            //     'name' => 'Work Order - Issuer',
            //     'e_group_is_active' => '1',
            // ],
            // [
            //     'name' => 'Work Order - SPV Issuer',
            //     'e_group_is_active' => '1',
            // ],
            // [
            //     'name' => 'Work Order - Planner',
            //     'e_group_is_active' => '1',
            // ],
            // [
            //     'name' => 'Work Order - PIC',
            //     'e_group_is_active' => '1',
            // ],
            // [
            //     'name' => 'Work Order - SPV PIC',
            //     'e_group_is_active' => '1',
            // ],
            // [
            //     'name' => 'Form 5s - PIC',
            //     'e_group_is_active' => '1',
            // ],
            // [
            //     'name' => 'Inspection - Ladder - SPV',
            //     'e_group_is_active' => '1',
            // ],
            // [
            //     'name' => 'Inspection - H2S - SPV',
            //     'e_group_is_active' => '1',
            // ],
            // [
            //     'name' => 'Inspection - Fume Hood - SPV',
            //     'e_group_is_active' => '1',
            // ],
            // [
            //     'name' => 'Inspection - Spill Kit - SPV',
            //     'e_group_is_active' => '1',
            // ],
            // [
            //     'name' => 'Inspection - Safety Harness - SPV',
            //     'e_group_is_active' => '1',
            // ],
            // [
            //     'name' => 'Inspection - SCBA - SPV',
            //     'e_group_is_active' => '1',
            // ],
            // [
            //     'name' => 'Inspection - Safety Shower - SPV',
            //     'e_group_is_active' => '1',
            // ],
            // [
            //     'name' => 'Inspection - Ladder',
            //     'e_group_is_active' => '1',
            // ],
            // [
            //     'name' => 'Inspection - H2S',
            //     'e_group_is_active' => '1',
            // ],
            // [
            //     'name' => 'Inspection - Fume Hood',
            //     'e_group_is_active' => '1',
            // ],
            // [
            //     'name' => 'Inspection - Spill Kit',
            //     'e_group_is_active' => '1',
            // ],
            // [
            //     'name' => 'Inspection - Safety Harness',
            //     'e_group_is_active' => '1',
            // ],
            // [
            //     'name' => 'Inspection - SCBA',
            //     'e_group_is_active' => '1',
            // ],
            // [
            //     'name' => 'Inspection - Safety Shower',
            //     'e_group_is_active' => '1',
            // ],



            [
                'name' => 'attendance admin',
                'e_group_is_active' => '1',
            ],



            // [
            //     'name' => '',
            //     'e_group_is_active' => '',
            // ],
        ]);
    }
}
