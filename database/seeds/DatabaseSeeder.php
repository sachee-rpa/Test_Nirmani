<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $this->call([UsersTableSeeder::class, TestTableSeeder::class]);
       
       $this->call(SuppliersTableSeeder::class);
        $this->call(SparePartsTableSeeder::class);
        $this->call(AdminDataTableSeeder::class);
        $this->call(MaterialsTableSeeder::class);
        $this->call(MachineriesTableSeeder::class);
        $this->call(EmployeeCategoriesTableSeeder::class);
        $this->call(EmployeesTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
    }
}