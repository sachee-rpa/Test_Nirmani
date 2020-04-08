<?php

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('customers')->delete();
        
        \DB::table('customers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Test Customer 1',
                'address' => 'Nittambuwa',
                'vat' => '14',
                'svat' => '15',
                'fixed_line' => '01123625365',
                'mobile' => '0722365985',
                'fax' => '0112365235',
                'email' => 'ex@gmail.com',
                'credit' => 1,
                'spare' => 10,
                'machinery' => 10,
                'service' => 10,             
                'remark' => NULL,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => NULL,
                'created_at' => '2020-02-27 16:59:01',
                'updated_at' => '2020-02-27 16:59:01',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Test Customer 2',
                'address' => 'Piliyandala',
                'vat' => '14',
                'svat' => '15',
                'fixed_line' => '0112365236',
                'mobile' => '0712563254',
                'fax' => '0112596358',
                'email' => 'sanjaya.amarasinha@gmail.com',
                'credit' => 1,
                'spare' => 10,
                'machinery' => 10,
                'service' => 10,
              
                'remark' => '22',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => NULL,
                'created_at' => '2020-02-27 17:16:28',
                'updated_at' => '2020-02-27 17:16:45',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}