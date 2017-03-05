<?php

use Illuminate\Database\Seeder;

class LibrariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=0; $i < 20; $i++) {
            DB::table('libraries')->insert([
                'uid' => 1,
                'rid' => $i + 1,
                'type' => 1,
                'show' => 1,
                'creater' => 1,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time())]);
        }
    }
}
