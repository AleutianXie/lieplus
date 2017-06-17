<?php

use Illuminate\Database\Seeder;

class LinesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //
        DB::table('lines')->insert([
            'sn' => 'LSX' . date('Ymdhis', time()) . sprintf('%4d', mt_rand(0, 9999)),
            'cid' => '1',
            'priority' => 1,
            'jid' => 1,
            'show' => 1,
            'creater' => 1,
            'created_at' => date('Y-m-d H:i:s', time()),
            'modifier' => 1,
            'updated_at' => date('Y-m-d H:i:s', time())]);
    }
}
