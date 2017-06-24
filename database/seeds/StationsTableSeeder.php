<?php

use Illuminate\Database\Seeder;

class StationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('stations')->insert([
            'sn' => 'GZT' . date('Ymdhis', time()) . sprintf('%04d', mt_rand(0, 9999)),
            'lid' => 1,
            'rid' => 1,
            'status' => 1,
            'show' => 1,
            'creater' => 1,
            'created_at' => date('Y-m-d H:i:s', time()),
            'modifier' => 1,
            'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('stations')->insert([
            'sn' => 'GZT' . date('Ymdhis', time()) . sprintf('%04d', mt_rand(0, 9999)),
            'lid' => 1,
            'rid' => 10,
            'status' => 2,
            'show' => 1,
            'creater' => 1,
            'created_at' => date('Y-m-d H:i:s', time()),
            'modifier' => 1,
            'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('stations')->insert([
            'sn' => 'GZT' . date('Ymdhis', time()) . sprintf('%04d', mt_rand(0, 9999)),
            'lid' => 1,
            'rid' => 12,
            'status' => 3,
            'show' => 1,
            'creater' => 1,
            'created_at' => date('Y-m-d H:i:s', time()),
            'modifier' => 1,
            'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('stations')->insert([
            'sn' => 'GZT' . date('Ymdhis', time()) . sprintf('%04d', mt_rand(0, 9999)),
            'lid' => 1,
            'rid' => 14,
            'status' => 4,
            'show' => 1,
            'creater' => 1,
            'created_at' => date('Y-m-d H:i:s', time()),
            'modifier' => 1,
            'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('stations')->insert([
            'sn' => 'GZT' . date('Ymdhis', time()) . sprintf('%04d', mt_rand(0, 9999)),
            'lid' => 1,
            'rid' => 18,
            'status' => 5,
            'show' => 1,
            'creater' => 1,
            'created_at' => date('Y-m-d H:i:s', time()),
            'modifier' => 1,
            'updated_at' => date('Y-m-d H:i:s', time())]);
        DB::table('stations')->insert([
            'sn' => 'GZT' . date('Ymdhis', time()) . sprintf('%04d', mt_rand(0, 9999)),
            'lid' => 1,
            'rid' => 20,
            'status' => 6,
            'show' => 1,
            'creater' => 1,
            'created_at' => date('Y-m-d H:i:s', time()),
            'modifier' => 1,
            'updated_at' => date('Y-m-d H:i:s', time())]);
    }
}
