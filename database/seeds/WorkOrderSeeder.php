<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class WorkOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('form_work_orders')->insert([
            [
                'wo_name' => 'GS/F/3002-4DEPMMYYXX',
                'wo_issuer_id' => 1,
                'wo_spv_issuer_id' => 2,
                'wo_planner_id' => 3,
                'wo_pic_id' => 4,
                'wo_spv_pic_id' => 5,
                'wo_date_issuer_submit' => Carbon::create('2000', '01', '01'),
                'wo_date_spv_issuer_approve' => Carbon::create('2000', '01', '01'),
                'wo_date_planner_approve' => Carbon::create('2000', '01', '01'), 
                'wo_date_pic_plan' => Carbon::create('2000', '01', '01'),
                'wo_date_spv_pic_approve' => Carbon::create('2000', '01', '01'),
                'wo_date_pic_finish' => Carbon::create('2000', '01', '01'),
                'wo_category' => 'Breakdown',
                'wo_issuer_dept' => 1,
                'wo_location_id' => 1,
                'wo_location_detail' => 'Yard',
                'wo_tag_no' => '123',
                'wo_reffered_dept' => 1,
                'wo_reffered_division' => 'Civil engineering',
                'wo_description' => 'butuh cepat',
                'wo_c_emergency' => 1,
                'wo_c_ranking_cust' => 1,
                'wo_c_equipment_criteria' => 1,
                'wo_date_recomendation' => Carbon::create('2000', '01', '01'),
                'wo_date_revision' => Carbon::create('2000', '01', '01'),
                'wo_c_relevant_area' => 'Plan Produksi',
                'wo_c_cost' => 'PM',
                'wo_pic_action_plan' => 'memperbaiki kabel putus',
                'wo_pic_start_time' => '2021-01-01 01:28:22',
                'wo_pic_finish_time' => '2021-01-01 01:28:22',
                'wo_pic_duration' => '2 hours',
                'wo_pic_team' => '[4,5,6]',
                'wo_is_open' => 1,
                'wo_form_status' => 2,
            ]
        ]);
    }
}
