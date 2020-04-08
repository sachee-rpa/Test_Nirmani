<?php

use Illuminate\Database\Seeder;

class CustomerPosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('customer_pos')->delete();
        
        \DB::table('customer_pos')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '23121212',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => NULL,
                'created_at' => '2020-03-02 16:50:41',
                'updated_at' => '2020-03-02 16:50:41',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}