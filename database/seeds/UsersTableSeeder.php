<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
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
            'name'	=> 'Aldi Irsan Majid',
            'email'	=> 'aldiirsanmajid@gmail.com',
            'password'	=> Hash::make('secret')
    ]);
    }
}
