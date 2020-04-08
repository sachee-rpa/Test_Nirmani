<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('machines')->insert([
            'name' => 'Escavater',
            'created_by' => '1',
            'updated_by' => '1'

        ]);

        DB::table('machines')->insert([
            'name' => 'JCB',
            'created_by' => '1',
            'updated_by' => '1'
        ]);

        /////////////////////////////////////////////////////

        DB::table('units')->insert([
            'name' => 'Kg',
            'created_by' => '1',
            'updated_by' => '1'

        ]);

        DB::table('units')->insert([
            'name' => 'm',
            'created_by' => '1',
            'updated_by' => '1'
        ]);

        /////////////////////////////////////////////////////////
        DB::table('currencies')->insert([
            'name' => 'USA',
            'created_by' => '1',
            'updated_by' => '1'

        ]);

        DB::table('currencies')->insert([
            'name' => 'England',
            'created_by' => '1',
            'updated_by' => '1'
        ]);
        ////////////////////////////////////////////////////////////
        DB::table('brands')->insert([
            'name' => 'Kubota',
            'created_by' => '1',
            'updated_by' => '1'

        ]);

        DB::table('brands')->insert([
            'name' => 'Bobcat',
            'created_by' => '1',
            'updated_by' => '1'
        ]);

        ////////////////////////////////////////////////////////////
        DB::table('countries')->insert([
            'name' => 'India',
            'created_by' => '1',
            'updated_by' => '1'
        ]);


        DB::table('countries')->insert([

            'name' => 'England',
            'created_by' => '1',
            'updated_by' => '1'
        ]);

        ////////////////////////////////////////////////////////////

        DB::table('brand_models')->insert([
            'brand_id' => '1',
            'name' => 'CX130D',
            'created_by' => '1',
            'updated_by' => '1'


        ]);

        DB::table('brand_models')->insert([
            'brand_id' => '2',
            'name' => 'CX145D SR',
            'created_by' => '1',
            'updated_by' => '1'
        ]);

        ////////////////////////////////////////////////////////////
        DB::table('currencies')->insert([

            'name' => 'USD',
            'created_by' => '1',
            'updated_by' => '1'
        ]);

        DB::table('currencies')->insert([

            'name' => 'LKR',
            'created_by' => '1',
            'updated_by' => '1'
        ]);

        ////////////////////////////////////////////////////////////



    }
}
