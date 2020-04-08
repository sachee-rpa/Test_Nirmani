<?php

use Illuminate\Database\Seeder;

class MaterialsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('materials')->delete();
        
        \DB::table('materials')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Test Material 1',
                'brand_id' => 1,
                'unit_id' => 1,
                'market_rate' => 500.0,
                'remark' => 'Oil',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => NULL,
                'created_at' => '2020-02-27 16:43:33',
                'updated_at' => '2020-02-27 16:43:33',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Test Material 2',
                'brand_id' => 1,
                'unit_id' => 1,
                'market_rate' => 1000.0,
                'remark' => '11',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => NULL,
                'created_at' => '2020-02-27 16:45:33',
                'updated_at' => '2020-02-27 16:45:33',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}