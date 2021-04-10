<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');

        \App\Models\MasterEmployee::create([
            'emp_name'	=> 'Aldi Irsan Majid',
            'emp_email'	=> 'aldiirsanmajid@gmail.com',
            'emp_username' => 'aim2u',
            'emp_password'	=> app('hash')->make('secret')
    ]);
    }
}
