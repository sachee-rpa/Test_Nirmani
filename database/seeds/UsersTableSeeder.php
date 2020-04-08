<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'sanjaya.amarasinha@gmail.com',
            'password' => bcrypt('123'),
            'super_admin' => true,
            'designation' => 'Super Admin'
        ]);

        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123'),
            'spares' => true,
            'designation' => 'Basic Admin'
        ]);
    }
}
