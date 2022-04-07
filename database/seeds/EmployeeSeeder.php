<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataEmployee = base_path("_db/initial_data/employee.csv");

        $handleDataEmployee = fopen($dataEmployee, 'r');

        $count = 0;
        echo "start inserting data employee\n";

        while ($employee = fgetcsv($handleDataEmployee, 10000, ",")) {
            $name   = $employee[1];
            $username   = $employee[5];
            $nik   = $employee[2];
            $department   = $employee[4];
            $createdAt   = Carbon::now();
            $updatedAt   = Carbon::now();

            $createEmployee               = new \App\Models\Employees();
            $createEmployee->emp_name    = $name;
            $createEmployee->emp_username    = $username;
            $createEmployee->emp_password    = Hash::make('user123');
            $createEmployee->emp_nik    = $nik;
            if($department == 1){
                $createEmployee->emp_department_id    = 1;
            }elseif($department == 37){
                $createEmployee->emp_department_id    = 2;
            }elseif($department == 38){
                $createEmployee->emp_department_id    = 3;
            }elseif($department == 42){
                $createEmployee->emp_department_id    = 4;
            }elseif($department == 142){
                $createEmployee->emp_department_id    = 6;
            }elseif($department == 156){
                $createEmployee->emp_department_id    = 7;
            }elseif($department == 157){
                $createEmployee->emp_department_id    = 8;
            }elseif($department == 158){
                $createEmployee->emp_department_id    = 9;
            }elseif($department == 159){
                $createEmployee->emp_department_id    = 10;
            }elseif($department == 160){
                $createEmployee->emp_department_id    = 11;
            }else {
                $createEmployee->emp_department_id    = null;
            }
            $createEmployee->emp_is_active    = 1;
            $createEmployee->saveOrFail();
            $count += 1;
            echo "$count. inserting {$createEmployee->dept_name} \n";
        }

        return "finisih insert data";
    }
}
