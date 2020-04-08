<?php

use Illuminate\Database\Seeder;

class EmployeeCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('employee_categories')->delete();
        
        \DB::table('employee_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Test Employee category 1',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => NULL,
                'created_at' => '2020-02-27 17:17:24',
                'updated_at' => '2020-02-27 17:17:24',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Test Employee category 2',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => NULL,
                'created_at' => '2020-02-27 17:17:45',
                'updated_at' => '2020-02-27 17:17:45',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}