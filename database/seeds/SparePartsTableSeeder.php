<?php

use Illuminate\Database\Seeder;

class SparePartsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('spare_parts')->delete();
        
        \DB::table('spare_parts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'brand_id' => 1,
                'brand_model_id' => 1,
                'machine_id' => 1,
                'part_number' => '2',
                'name' => 'PARTS 2',
                'market_rate' => 23.0,
                'remark' => NULL,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => NULL,
                'created_at' => '2020-01-07 22:05:24',
                'updated_at' => '2020-01-07 22:05:24',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'brand_id' => 1,
                'brand_model_id' => 1,
                'machine_id' => 2,
                'part_number' => 'Part Number5',
                'name' => 'PARTS 3',
                'market_rate' => 120.0,
                'remark' => NULL,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => NULL,
                'created_at' => '2020-01-07 22:33:55',
                'updated_at' => '2020-01-07 22:33:55',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}