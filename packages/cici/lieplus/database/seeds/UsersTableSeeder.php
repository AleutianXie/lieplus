<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->comment('插入全国省市县信息...');
        $this->command->info('插入全国省市县信息...');
        $this->command->question('插入全国省市县信息...');
        $this->command->error('插入全国省市县信息...');
        exit;
        DB::table('users')->insert([
            'name' => 'Aleutian Xie',
            'email' => 'aleutian.xie@cicisoft.cn',
            'password' => '$2y$10$MZiQ5tKtTSxY0J.oIXXfZe38oEpqrJtLnES5lTnyZ2fagcozIYZiu',
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())]);
    }
}
