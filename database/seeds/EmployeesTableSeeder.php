<?php

use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('employees')->delete();
        
        \DB::table('employees')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Test Employee 1',
                'initial' => 'R.P.A.S.K.Rathnasekara',
                'nic_number' => '9007632568v',
                'employee_category_id' => 1,
                'designation' => '2',
                'join_date' => '2020-02-01',
                'day_rate' => 2500.0,
                'ot_rate' => 200.0,
                'remark' => '33',
                'file' => NULL,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => NULL,
                'created_at' => '2020-02-27 17:26:01',
                'updated_at' => '2020-02-27 17:27:56',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Test Employee 2',
                'initial' => 'M.A.Tharindu Shihan',
                'nic_number' => '9823659821v',
                'employee_category_id' => 2,
                'designation' => '2',
                'join_date' => '2020-02-12',
                'day_rate' => 3000.0,
                'ot_rate' => 300.0,
                'remark' => '44',
                'file' => NULL,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => NULL,
                'created_at' => '2020-02-27 17:27:44',
                'updated_at' => '2020-02-27 17:28:05',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}