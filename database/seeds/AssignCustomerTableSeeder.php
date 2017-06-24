<?php

use Illuminate\Database\Seeder;

class AssignCustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('assigncustomers')->insert([
            'uid' => 1,
            'cid' => 1,
            'show' => 1,
            'creater' => 1,
            'modifier' => 1,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())]);

    }
}
