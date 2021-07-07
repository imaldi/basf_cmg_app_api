<?php

use Illuminate\Database\Seeder;

class Form5sMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('form_5s_masters')->insert([

            [
                'form_5s_m_dept_id' => 1,
                'form_5s_m_area_id' => 1,
                'form_5s_m_pic_id' => 4,
            ],
            [
                'form_5s_m_dept_id' => 1,
                'form_5s_m_area_id' => 2,
                'form_5s_m_pic_id' => 4,
            ],
            [
                'form_5s_m_dept_id' => 1,
                'form_5s_m_area_id' => 3,
                'form_5s_m_pic_id' => 4,
            ],
            [
                'form_5s_m_dept_id' => 3,
                'form_5s_m_area_id' => 4,
                'form_5s_m_pic_id' => 4,
            ],
            [
                'form_5s_m_dept_id' => 3,
                'form_5s_m_area_id' => 5,
                'form_5s_m_pic_id' => 4,
            ],
            [
                'form_5s_m_dept_id' => 3,
                'form_5s_m_area_id' => 6,
                'form_5s_m_pic_id' => 4,
            ],

        ]);
    }
}
