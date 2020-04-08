<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuppliersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('suppliers')->delete();
        
        DB::table('suppliers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Supplier 1',
                'address' => '341',
                'credit_period' => 2,
                'credit_limit' => 1500000,
                'country_id' => 1,
                'fixed_line' => '1',
                'mobile' => NULL,
                'fax' => NULL,
                'email' => 'sanjaya.amarasinha@gmail.com',
                'vat' => NULL,
                'svat' => NULL,
                'remark' => NULL,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => NULL,
                'created_at' => '2019-12-29 10:32:58',
                'updated_at' => '2019-12-29 10:32:58',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Supplier 2',
                'address' => '341',
                'credit_period' => 1,
                'credit_limit' => 12,
                'country_id' => 1,
                'fixed_line' => '13',
                'mobile' => NULL,
                'fax' => NULL,
                'email' => 'a@a.com',
                'vat' => NULL,
                'svat' => NULL,
                'remark' => NULL,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => NULL,
                'created_at' => '2019-12-29 10:33:21',
                'updated_at' => '2019-12-29 10:33:21',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}