<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        exit;
        $this->call(RegionsTableSeeder::class);
//        $this->call(UsersTableSeeder::class);
//        $this->call(RolesTableSeeder::class);
//        $this->call(RegionsTableSeeder::class);
        // if (config('app.debug'))
        // {
        //     $this->call(ResumesTableSeeder::class);
        //     $this->call(JobsTableSeeder::class);
        //     $this->call(AssignCustomerTableSeeder::class);
        //     $this->call(LinesTableSeeder::class);
        //     $this->call(AssignLineTableSeeder::class);
        // }
    }
}
