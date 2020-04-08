<?php

use Illuminate\Database\Seeder;

class MachineriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('machineries')->delete();
        
        \DB::table('machineries')->insert(array (
            0 => 
            array (
                'id' => 1,
                'brand_id' => 2,
                'brand_model_id' => 2,
                'machine_id' => 1,
                'name' => 'test mashinery 1',
                'market_rate' => 500.0,
                'remark' => NULL,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => NULL,
                'created_at' => '2020-02-27 16:53:03',
                'updated_at' => '2020-02-27 16:53:10',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'brand_id' => 1,
                'brand_model_id' => 1,
                'machine_id' => 1,
                'name' => 'test mashinery 2',
                'market_rate' => 400.0,
                'remark' => '22',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => NULL,
                'created_at' => '2020-02-27 16:54:56',
                'updated_at' => '2020-02-27 16:54:56',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}