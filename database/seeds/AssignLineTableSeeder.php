<?php

use Illuminate\Database\Seeder;

class AssignLineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('assignlines')->insert([
            'uid' => 1,
            'lid' => 1,
            'show' => 1,
            'creater' => 1,
            'modifier' => 1,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())]);
    }
}
