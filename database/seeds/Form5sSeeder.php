<?php

use Illuminate\Database\Seeder;

class Form5sSeeder extends Seeder{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employee_has_group')->insert([
            [
                'form_5s_m_dept_id' => '3',
                'form_5s_m_area_id' => '1',
                'form_5s_m_pic_id' => '3'
            ],
            [
                'role_id' => '4',
                'model_id' => '2',
            ],
            [
                'role_id' => '5',
                'model_id' => '3',
            ],
            [
                'role_id' => '6',
                'model_id' => '4',
            ],
            [
                'role_id' => '7',
                'model_id' => '5',
            ],
            [
                'role_id' => '8',
                'model_id' => '6',
            ],
            [
                'role_id' => '8',
                'model_id' => '7',
            ],
            
        ]);
    }
}