<?php

use Illuminate\Database\Seeder;

class UserGroupSeeder extends Seeder{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employee_has_groups')->insert([
            [
                'role_id' => '3',
                'model_id' => '1',
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
            [
                'role_id' => '9',
                'model_id' => '8',
            ],
            [
                'role_id' => '10',
                'model_id' => '8',
            ],
            [
                'role_id' => '11',
                'model_id' => '8',
            ],
            [
                'role_id' => '12',
                'model_id' => '8',
            ],
            [
                'role_id' => '13',
                'model_id' => '8',
            ],
            [
                'role_id' => '14',
                'model_id' => '8',
            ],
            [
                'role_id' => '15',
                'model_id' => '8',
            ],
            [
                'role_id' => '16',
                'model_id' => '8',
            ],
            [
                'role_id' => '17',
                'model_id' => '8',
            ],
            [
                'role_id' => '18',
                'model_id' => '8',
            ],
            [
                'role_id' => '19',
                'model_id' => '8',
            ],
            [
                'role_id' => '20',
                'model_id' => '8',
            ],
            [
                'role_id' => '21',
                'model_id' => '8',
            ],
            [
                'role_id' => '22',
                'model_id' => '8',
            ],
        ]);
    }
}