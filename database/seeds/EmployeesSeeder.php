<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_employees')->insert([
            // [
            //     'emp_name'	=> 'wo issuer',
            //     'emp_email'	=> 'wo_issuer@gmail.com',
            //     'emp_username' => 'wo issuer',
            //     'password'	=> app('hash')->make('secret')
            // ],
            // [
            //     'emp_name'	=> 'wo issuer spv',
            //     'emp_email'	=> 'wo_issuer_spv@gmail.com',
            //     'emp_username' => 'wo issuer_spv',
            //     'password'	=> app('hash')->make('secret')
            // ],
            // [
            //     'emp_name'	=> 'wo planner',
            //     'emp_email'	=> 'wo_planner@gmail.com',
            //     'emp_username' => 'wo planner',
            //     'password'	=> app('hash')->make('secret')
            // ],
            // [
            //     'emp_name'	=> 'wo pic',
            //     'emp_email'	=> 'wo_pic@gmail.com',
            //     'emp_username' => 'wo pic',
            //     'password'	=> app('hash')->make('secret')
            // ],
            // [
            //     'emp_name'	=> 'wo pic spv',
            //     'emp_email'	=> 'wo_pic_spv@gmail.com',
            //     'emp_username' => 'wo pic_spv',
            //     'password'	=> app('hash')->make('secret')
            // ],
            // [
            //     'emp_name'	=> '5s pic',
            //     'emp_email'	=> 'form5sPic@gmail.com',
            //     'emp_username' => '5s pic',
            //     'password'	=> app('hash')->make('secret')
            // ],
            // [
            //     'emp_name'	=> '5s pic 2',
            //     'emp_email'	=> 'form5sPic@gmail.com',
            //     'emp_username' => '5s pic 2',
            //     'password'	=> app('hash')->make('secret')
            // ],
            // [
            //     'emp_name'	=> 'inspection',
            //     'emp_email'	=> 'inspection@gmail.com',
            //     'emp_username' => 'inspection',
            //     'password'	=> app('hash')->make('secret')
            // ],
            // [
            //         'emp_name'	=> 'inspection spv',
            //         'emp_email'	=> 'inspection_spv@gmail.com',
            //         'emp_username' => 'inspection spv',
            //         'password'	=> app('hash')->make('secret')
            //     ],
            // [
            //     'emp_name'	=> 'attendance',
            //     'emp_email'	=> 'attendance@gmail.com',
            //     'emp_username' => 'attendance',
            //     'password'	=> app('hash')->make('secret')
            // ],
        ]);
    }
}
