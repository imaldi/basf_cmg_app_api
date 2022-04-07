<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class GeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $dataDepartment = base_path("_db/initial_data/department.csv");
        // $dataLocation = base_path("_db/initial_data/locations.csv");

        // $handleDataDepartment = fopen($dataDepartment, 'r');
        // $handleDataLocation = fopen($dataLocation, 'r');

        // $count = 0;
        // echo "start inserting data Department\n";

        // while ($department = fgetcsv($handleDataDepartment, 10000, ",")) {
        //     $id          = $department[0];
        //     $deptName   = $department[1];
        //     $isActive   = $department[2];
        //     $createdAt   = Carbon::now();
        //     $updatedAt   = Carbon::now();

        //     $createDepartment               = new \App\Models\MasterDepartment();
        //     $createDepartment->id           = $id;
        //     $createDepartment->dept_name    = $deptName;
        //     $createDepartment->is_active    = $isActive;
        //     $createDepartment->created_at   = $createdAt;
        //     $createDepartment->updated_at   = $updatedAt;
        //     $createDepartment->saveOrFail();
        //     $count += 1;
        //     echo "$count. inserting {$createDepartment->dept_name} \n";
        // }

        // insert data location
        // $count = 0;
        // echo "start inserting data Location\n";
        // while ($location = fgetcsv($handleDataLocation, 10000, ",")) {
        //     $id          = $location[0];
        //     $locationName   = $location[1];
        //     $idDepartment   = $location[2];
        //     $locationDescription   = $location[3];
        //     $createdAt   = Carbon::now();
        //     $updatedAt   = Carbon::now();
        //     $createLocation                       = new \App\Models\MasterLocation();
        //     $createLocation->id                   = $id;
        //     $createLocation->location_name        = $locationName;
        //     if($idDepartment){
        //         $createLocation->id_department        = $idDepartment;
        //     }else {
        //         $createLocation->id_department        = null;
        //     }
        //     if($locationDescription){
        //         $createLocation->location_description = $locationDescription;
        //     }else {
        //         $createLocation->location_description = null;
        //     }
        //     $createLocation->created_at           = $createdAt;
        //     $createLocation->updated_at           = $updatedAt;
        //     $createLocation->saveOrFail();
        //     $count += 1;
        //     echo "$count. inserting {$createLocation->location_name} \n";
        // }

        // return "finisih insert data";
    }
}
