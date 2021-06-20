<?php

use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_locations')->insert([
            [
                'loc_name' => 'Production TTD Area',
                'loc_desc' => 'Production TTD Area',
                'loc_is_active' => 1,
                'loc_department_id' => 1,
            ],[
                'loc_name' => 'Warehouse Raw Material',
                'loc_desc' => 'Depan Container ENG (C1)',
                'loc_is_active' => 1,
                'loc_department_id' => 1,
            ],[
                'loc_name' => 'Finish Goods Warehouse',
                'loc_desc' => '(liquit) (C 12)',
                'loc_is_active' => 1,
                'loc_department_id' => 1,
            ],
            // [
            //     'loc_name' => 'Production Batch Process Lantai 1',
            //     'loc_desc' => 'Depan Production SO3 Area (C8)',
            //     'loc_is_active' => 1,
            //     'loc_department_id' => 1,
            // ],[
            //     'loc_name' => 'Production Batch Process',
            //     'loc_desc' => '(C11)',
            //     'loc_is_active' => 1,
            //     'loc_department_id' => 1,
            // ],[
            //     'loc_name' => 'Production S03 Area',
            //     'loc_desc' => 'Depan Filling OCP',
            //     'loc_is_active' => 1,
            //     'loc_department_id' => 1,
            // ],
            [
                'loc_name' => 'Production Batch Process Lantai 1',
                'loc_desc' => 'Depan Production SO3 Area (C8)',
                'loc_is_active' => 1,
                'loc_department_id' => 3,
            ],[
                'loc_name' => 'Production Batch Process',
                'loc_desc' => '(C11)',
                'loc_is_active' => 1,
                'loc_department_id' => 3,
            ],[
                'loc_name' => 'Production S03 Area',
                'loc_desc' => 'Depan Filling OCP',
                'loc_is_active' => 1,
                'loc_department_id' => 3,
            ],
            [
                'loc_name' => 'Raw Material Warehouse',
                'loc_desc' => 'Di samping Warehouse GMP (C1.2)',
                'loc_is_active' => 1,
                'loc_department_id' => 1,
            ],[
                'loc_name' => 'TBS',
                'loc_desc' => '(B 10)',
                'loc_is_active' => 1,
                'loc_department_id' => 1,
            ],[
                'loc_name' => 'Flammable Material Warehouse',
                'loc_desc' => '(C2)',
                'loc_is_active' => 1,
                'loc_department_id' => 1,
            ],[
                'loc_name' => 'Production Batch Area',
                'loc_desc' => 'Production Batch Area',
                'loc_is_active' => 1,
                'loc_department_id' => 1,
            ],[
                'loc_name' => 'Workshop Engineering',
                'loc_desc' => 'Workshop Engineering',
                'loc_is_active' => 1,
                'loc_department_id' => 1,
            ],[
                'loc_name' => 'Power House',
                'loc_desc' => 'Power House',
                'loc_is_active' => 1,
                'loc_department_id' => 1,
            ],[
                'loc_name' => 'Boiler',
                'loc_desc' => 'Boiler',
                'loc_is_active' => 1,
                'loc_department_id' => 1,
            ],[
                'loc_name' => 'Warehouse A8/C1.1/C1.2/C2/C3/C12',
                'loc_desc' => 'Warehouse A8/C1.1/C1.2/C2/C3/C12',
                'loc_is_active' => 1,
                'loc_department_id' => 1,
            ],[
                'loc_name' => 'QC Lab',
                'loc_desc' => 'QC Lab',
                'loc_is_active' => 1,
                'loc_department_id' => 1,
            ],[
                'loc_name' => 'Lab PM/ EMC/ EMD',
                'loc_desc' => 'Lab PM/ EMC/ EMD',
                'loc_is_active' => 1,
                'loc_department_id' => 1,
            ],[
                'loc_name' => 'WWTP',
                'loc_desc' => 'WWTP',
                'loc_is_active' => 1,
                'loc_department_id' => 1,
            ],[
                'loc_name' => 'WTP',
                'loc_desc' => 'WTP',
                'loc_is_active' => 1,
                'loc_department_id' => 1,
            ],[
                'loc_name' => 'Tank Farm',
                'loc_desc' => 'Tank Farm',
                'loc_is_active' => 1,
                'loc_department_id' => 1,
            ]
        ]);
    }
}
